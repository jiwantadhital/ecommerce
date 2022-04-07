<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CategoryRequest;
use App\Http\Requests\Backend\ProductRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\Unit;
use GuzzleHttp\Psr7\Request;
use Intervention\Image\Facades\Image;

class ProductController extends BackendBaseController
{
    protected $panel = 'Product';  //for section/module
    protected $folder = 'backend.product.';  //for view file
    protected $base_route = 'backend.product.';  //for for route method
    protected $folder_name = 'product';
    protected $title;
    protected $model;
    function __construct(){
        parent::__construct();
        $this->model = new Product();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->title = 'List';
//        $data['rows'] = $this->model->where('status',1)->get();
        $data['rows'] = $this->model->get();
        return view($this->__loadDataToView($this->folder . 'index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Create';
        $data['units'] = Unit::pluck('name','id');
        $data['categories'] = Category::pluck('name','id');
        $data['subcategories'] = SubCategory::pluck('name','id');
        $data['attributes'] = Attribute::all();
        return view($this->__loadDataToView($this->folder . 'create'),compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
//        dd($request);
        $request->request->add(['stock' => $request->input('quantity')]);
        $request->request->add(['created_by' => auth()->user()->id]);

        $data['row'] = $this->model->create($request->all());
        if ($data['row']){
            //for multiple image upload
            $imageFiles = $request->file('product_image');
            $image_title = $request->input('image_title');
            $imageArray['product_id'] = $data['row']->id;

            for ($i = 0; $i < count($imageFiles); $i++){
                $image      = $imageFiles[$i];
                $image_name = rand(6785, 9814).'_'.$image->getClientOriginalName();
                $image->move($this->image_path, $image_name);
                if (count(config('image_dimension.'.$this->folder_name.'.images')) > 0) {
                    foreach (config('image_dimension.'.$this->folder_name.'.images') as $dimension) {
                        // open and resize an image file
                        $img = Image::make($this->image_path.$image_name)->resize($dimension['width'], $dimension['height']);
                        // save the same file as jpg with default quality
                        $img->save($this->image_path.$dimension['width'].'_'.$dimension['height'].'_'.$image_name);
                    }
                }
                $imageArray['image_name'] = $image_name;
                $imageArray['image_title'] = $image_title[$i];
                $imageArray['status'] = 1;
                ProductImage::create($imageArray);
            }

            $attribute_value = $request->input('attribute_value');
            $attribute_id = $request->input('attribute_id');
            $attributeArray['product_id'] = $data['row']->id;
            $attributeArray['status'] = 1;

            for ($i = 0; $i < count($attribute_id); $i++) {
                $attributeArray['attribute_id'] = $attribute_id[$i];
                $attributeArray['attribute_value'] = $attribute_value[$i];
                ProductAttribute::create($attributeArray);
            }
            $request->session()->flash('success_message', $this->panel . ' created successfully');
        } else{
            $request->session()->flash('error_message', $this->panel . ' creation failed');
        }
        return redirect()->route($this->base_route . 'index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data['row'] = $this->model->find($id);
        if (!$data['row']){
            request()->session()->flash('error_message', $this->panel . ' record not found');
            return redirect()->route($this->base_route . 'index');
        }
        $this->title = 'View';
        return view($this->__loadDataToView($this->folder . 'show'),compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['row'] = $this->model->find($id);


        if ($data['row']){
            request()->session()->flash('error_message', $this->panel . ' record not found');
        }
        $this->title = 'Edit';
        return view($this->__loadDataToView($this->folder . 'edit'),compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data['row'] = $this->model->find($id);
        if ($request->hasFile('image_file')) {
            $image = $this->uploadImage($request,'image_file');
            $request->request->add(['image' => $image]);
            if ($image){
                $this->deleteImage($data['row']->image);
            }
        }
        $request->request->add(['updated_by' => auth()->user()->id]);
        if ($data['row']->update($request->all())){
            $request->session()->flash('success_message', $this->panel . ' updated successfully');
        } else{
            $request->session()->flash('error_message', $this->panel . ' update failed');
        }
        return redirect()->route($this->base_route . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data['row'] = $this->model->find($id);
        if ($data['row']->delete()){
            request()->session()->flash('success_message', $this->panel . ' deleted successfully');
        } else{
            request()->session()->flash('error_message', $this->panel . ' deletation failed');
        }
        return redirect()->route($this->base_route . 'index');
    }

    function  getAllAttribute (){
       $data =  Attribute::pluck('name','id');
       return json_encode($data);
    }

    public function changeStatusById(Request $request, $id,$value)
    {
        $data['row'] = $this->model->find($id);
        $request->request->add(['updated_by' => auth()->user()->id]);
        $request->request->add(['status' => $value]);
        if ($data['row']->update($request->all())){
            $request->session()->flash('success_message', $this->panel . ' updated successfully');
        } else{
            $request->session()->flash('error_message', $this->panel . ' update failed');
        }
        return redirect()->route($this->base_route . 'index');
    }
}
