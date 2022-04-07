@extends('backend.layouts.master')
@section('title',$title)
@section('main-content')
    <div class="card-header">
        <h3 class="card-title">{{$title}}
            <a href="{{route($base_route.'index')}}" class="btn btn-success">
                <i class="fas fa-list"></i>
                List
            </a>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#basic" data-toggle="tab">Basic View</a></li>
            <li class="nav-item"><a class="nav-link" href="#meta" data-toggle="tab">Meta View</a></li>
            <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images View</a></li>
            <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">Attributes View</a></li>
        </ul>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        @include('backend.includes.flash_message')
        <div class="tab-content">
            <div class="active tab-pane" id="basic">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>category</th>
                            <td>{{$data['row']->category->name}}</td>
                        </tr>
                        <tr>
                            <th>Subcategory</th>
                            <td>{{$data['row']->subcategory->name}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$data['row']->title}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$data['row']->slug}}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{$data['row']->price}}</td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{$data['row']->discount}}</td>
                        </tr>
                        <tr>
                            <th>Stock</th>
                            <td>{{$data['row']->stock}}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{$data['row']->quantity}}</td>
                        </tr>
                        <tr>
                            <th>Unit</th>
                            <td>{{$data['row']->unit->name}}</td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td>{{$data['row']->short_description}}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{$data['row']->description}}</td>
                        </tr>

                        <tr>
                            <th>specification</th>
                            <td>{{$data['row']->specification}}</td>
                        </tr>
                        <tr>
                            <th>specification</th>
                            <td>{{$data['row']->specification}}</td>
                        </tr>
                        <tr>
                            <th>Feature Product</th>
                            <td>
                                @if($data['row']->feature_product == 1)
                                    <span class="text text-success">Active</span>
                                @else
                                    <span class="text text-danger">De Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Flash Product</th>
                            <td>
                                @if($data['row']->flash_product == 1)
                                    <span class="text text-success">Active</span>
                                @else
                                    <span class="text text-danger">De Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($data['row']->status == 1)
                                    <span class="text text-success">Active</span>
                                @else
                                    <span class="text text-danger">De Active</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created By</th>
                            <td>{{$data['row']->createdBy->name}}</td>
                        </tr>
                        @if (!empty($data['row']->updated_by))
                            <tr>
                                <th>Updated By</th>
                                <td>{{$data['row']->updatedBy->name}}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Created At</th>
                            <td>{{$data['row']->created_at}}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{$data['row']->updated_at}}</td>
                        </tr>
                    </table>
                </div>
                {{--basic view--}}
{{--                @include($folder. 'includes.basic_view')--}}
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="meta">
{{--                @include($folder. 'includes.meta_view')--}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Meta Title</th>
                            <td>{{$data['row']->meta_title}}</td>
                        </tr>
                        <tr>
                            <th>Meta Keyword</th>
                            <td>{{$data['row']->meta_keyword}}</td>
                        </tr>
                        <tr>
                            <th>Meta Description</th>
                            <td>{{$data['row']->meta_description}}</td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="images">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>

                        </tr>
                        @foreach($data['row']->images as $image)
                        <tr>
                            <td>{{$image->image_title}}</td>
                            <td><img src="{{asset('images/product/200_100_' . $image->image_name)}}" alt=""/></td>
                           <td> @if($image->status == 1)
                                   <span class="text text-success"><a href="" title="Click to De Active">Active</a></span>
                               @else
                                   <span class="text text-danger"><a href="" title="Click to Active">De-Active</a></span>
                               @endif
                           </td>
                        </tr>
                            @endforeach
                    </table>
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="attributes">
{{--                @include($folder. 'includes.attributes_view')--}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Status</th>

                        </tr>
                        @foreach($data['row']->attributes as $attribute)
                            <tr>
                                <td>{{$attribute->attribute->name  }}</td>
                                <td>{{$attribute->attribute_value}}</td>
                                <td> @if($attribute->status == 1)
                                        <span class="text text-success"><a href="" title="Click to De Active">Active</a></span>
                                    @else
                                        <span class="text text-danger"><a href="" title="Click to Active">De-Active</a></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div><!-- /.card-body -->

    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
@endsection
