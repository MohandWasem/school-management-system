@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('Students_trans.online_courses')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
 {{trans('Students_trans.online_courses')}}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('Students_trans.online_courses')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Sections_trans.Home') }}</a></li>
                <li class="breadcrumb-item active"> {{trans('Students_trans.online_courses')}}</li>
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
                                <a href="{{route('onlineClasses.create')}}" class="btn btn-success" role="button" aria-pressed="true">  {{ trans('Students_trans.add_online_courses') }} </a>
                                <a href="{{route('offlineClasse.create')}}" class="btn btn-warning" role="button" aria-pressed="true">  {{ trans('Students_trans.online_courses_indirect') }} </a>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name_grade')}}</th>
                                            <th>{{trans('Students_trans.name_classroom')}}</th>
                                            <th>{{trans('Students_trans.name_section')}}</th>
                                            <th>{{trans('Students_trans.name_teacher')}}</th>
                                            <th> {{trans('Students_trans.course_address')}}</th>
                                            <th> {{trans('Students_trans.start_date')}}</th>
                                            <th> {{trans('Students_trans.course_start')}}</th>
                                            <th> {{trans('Students_trans.course_link')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grade->Name}}</td>
                                            <td>{{ $online_classe->classroom->Name_classroom }}</td>
                                            <td>{{$online_classe->section->Name_Section}}</td>
                                            <td>{{$online_classe->created_by}}</td>
                                            <td>{{$online_classe->topic}}</td>
                                            <td>{{$online_classe->start_at}}</td>
                                            <td>{{$online_classe->duration}}</td>
                                            <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">{{trans('Students_trans.add_now')}}</a></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                            </td>
                                            </tr>
                                        @include('pages.online_classes.delete')
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
