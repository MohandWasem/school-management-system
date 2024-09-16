@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{ trans('Students_trans.list_matreial') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('Students_trans.list_matreial') }}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('Students_trans.list_matreial') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Teacher_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.list_matreial') }}</li>
            </ol>
        </div>
    </div>
</div>
@endsection
@section('content')
    <!-- row -->
<div class="row">
<div class="col-md-12 mb-30">
<div class="card card-statistics h-100">
    <div class="card-body">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a href="{{route('subjects.create')}}" class="btn btn-success btn-sm" role="button"
                        aria-pressed="true">  {{ trans('Students_trans.add_matreial') }}</a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50"
                                style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{ trans('Students_trans.name_matreial') }}</th>
                                <th> {{ trans('Students_trans.name_grade') }}</th>
                                <th> {{ trans('Students_trans.name_classroom') }}</th>
                                <th> {{ trans('Students_trans.name_teacher') }}</th>
                                <th>{{ trans('Students_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$subject->Name}}</td>
                                <td>{{$subject->grade->Name}}</td>
                                <td>{{$subject->classroom->Name_classroom}}</td>
                                <td>{{$subject->teacher->Name}}</td>
                                    <td>
                                        <a href="{{route('subjects.edit',$subject->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true" title="تعديل"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject{{ $subject->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="delete_subject{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route('subjects.destroy','test')}}" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel"> {{ trans('Students_trans.delete_matreial') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p> {{ trans('classroom_trans.Warning_class') }} {{$subject->Name}}</p>
                                                <input type="hidden" name="id"  value="{{$subject->id}}">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('classroom_trans.Close') }}</button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ trans('classroom_trans.submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
