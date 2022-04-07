<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\UnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends BackendBaseController
{
    protected $panel = 'Unit';    //for section/module
    protected $folder = 'backend.unit.';   // for view file
    protected  $base_route = 'backend.unit.';  // for route method
    protected  $title;
    protected $model;

    function __construct()
    {
        $this->model = new Unit();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->title = 'List';
        $data['rows'] = $this->model->get();
        return view($this->__loadDataToView($this->folder .'index'),compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->title = 'Create';
        return view($this->__loadDataToView($this->folder .'create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $data['row'] = $this->model->create($request->all());
        if ($data['row']){
            $request->session()->flash('success_message', $this->panel . ' created successfully!');
        } else {
            $request->session()->flash('error_message', $this->panel . ' creation failed!');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['row'] = $this->model->find($id);
        if (!$data['row']){
            request()->session()->flash('error_message', $this->panel . ' record not found!');
        }
        $this->title = 'Edit';
        return view($this->__loadDataToView($this->folder .'edit'),compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        $data['row'] = $this->model->find($id);
        $request->request->add(['updated_by' => auth()->user()->id]);
        if ($data['row']->update($request->all())){
            $request->session()->flash('success_message', $this->panel . ' updated successfully!');
        } else {
            $request->session()->flash('error_message', $this->panel . ' update failed!');
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
        $data['row'] = $this->model->find($id);
        if ($data['row']->delete())   {
            request()->session()->flash('success_message', $this->panel . ' deleted successfully!');
        } else {
            request()->session()->flash('error_message', $this->panel . ' delete failed!');
        }
        return redirect()->route($this->base_route . 'index');
    }

    public function trash()
    {
        $this->title = 'Trash List';
        //listing page
        $data['rows'] = $this->model->onlyTrashed()->orderby('deleted_at','desc')->get();

        return view($this->__loadDataToView($this->folder . 'trash'),compact('data'));

    }

    public function restore($id)
    {
        $data['row'] = $this->model->where('id', $id)->withTrashed()->first();

        if ($data['row']->restore()){
            request()->session()->flash('success_message', $this->panel . ' restored successfully!');
        } else {
            request()->session()->flash('error_message', $this->panel . ' restore failed!');
        }
        return redirect() -> route($this->base_route . 'index');
    }

    public function forceDelete($id)
    {

        $data['row'] = $this->model->where('id', $id)->withTrashed()->first();

        if ($data['row']->forceDelete()){
            request()->session()->flash('success_message', $this->panel . ' permanently deleted successfully!');
        } else {
            request()->session()->flash('error_message', $this->panel . ' delete failed!');
        }
        return redirect() -> route($this->base_route . 'trash');
    }

}
