@extends('backend.layouts.master')
@section('title',$title)
@section('main-content')

    {!! Form::open(['route'=>$base_route.'store','method'=>'post','files' => true]) !!}
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#basic" data-toggle="tab">Basic Form</a></li>
                <li class="nav-item"><a class="nav-link" href="#meta" data-toggle="tab">Meta</a></li>
                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>
                <li class="nav-item"><a class="nav-link" href="#attributes" data-toggle="tab">Attributes</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="basic">
                   {{--basic form--}}
                    @include($folder. 'includes.basic')
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="meta">
                    @include($folder. 'includes.meta')

                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="images">
                    @include($folder. 'includes.images')

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="attributes">
                    @include($folder. 'includes.attributes')

                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
        <div class="card-footer">
            {!! Form::submit('Save',['class'=>'btn btn-success']) !!}
        </div>
    {!! Form::close() !!}
    <!-- /.card-footer-->
@endsection
@section('js')
    @include($folder . 'includes.add_row_script')
    @include($folder . 'includes.script')
@endsection
