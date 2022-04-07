@extends('backend.layouts.master')
@section('title',$title )
@section('main-content')
    <div class="card-header">
        <h3 class="card-title">{{$title}}
            <a href="{{route($base_route . 'create')}}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</a>
            <a href="{{route($base_route . 'index')}}" class="btn btn-primary"><i class="fas fa-list-alt"></i> list</a>

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
    <div class="card-body">
        @include('backend.includes.flash_message')
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @forelse($data['rows'] as $index => $row)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$row->title}}</td>
                                <td>
                                    @if($row->status == 1)
                                        <span class="text text-success"><a href="{{route($base_route . 'changeStatus',$row->id,'0')}}" title="Click to De Active">Active</a></span>
                                    @else
                                        <span class="text text-danger"><a href="{{route($base_route . 'changeStatus',$row->id,'1')}}" title="Click to Active">De-Active</a></span>
                                    @endif
                                </td>
                                <td>{{$row->created_at}}</td>
                                <td>
                                    <a href="{{route($base_route . 'edit',$row->id)}}" class="btn btn-info">Edit</a>
                                    {!! Form::open(['route' => [$base_route . 'destroy',$row->id],'method' => 'delete']) !!}
                                    {!! Form::submit('Delete ',['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    <a href="{{route($base_route . 'show',$row->id)}}" class="btn btn-info">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text text-danger">
                                <td colspan="5">{{$panel}} not found</td>
                            </tr>
                        @endforelse
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
@endsection
