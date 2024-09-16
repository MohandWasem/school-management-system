@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('Students_trans.List_Students_promotion')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.List_Students_promotion')}}
@stop
<!-- breadcrumb -->

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('Students_trans.List_Students_promotion') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.List_Students_promotion') }}</li>
            </ol>
        </div>
    </div>
</div>
@endsection
@section('content')
    <!-- row -->
<div class="row">
<div class="col-md-12 mb-30">
<div class="card-body">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                    {{trans('Students_trans.All_back_down')}}
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                            data-page-length="50"
                            style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-info" style="font-size: 16px; font-weight: bold; text-align: center;">#</th>
                            <th class="alert-info" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.name')}}</th>
                            <th class="alert-danger" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Previous_educational_stage')}}</th>
                            <th class="alert-danger" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.academic_year')}}</th>
                            <th class="alert-danger" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Previous_school_grade')}}</th>
                            <th class="alert-danger" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Previous_academic_department')}}</th>
                            <th class="alert-success" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Current_academic_stage')}}</th>
                            <th class="alert-success" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Current_academic_year')}}</th>
                            <th class="alert-success" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Current_academic_grade')}}</th>
                            <th class="alert-success" style="font-size: 16px; font-weight: bold; text-align: center;">{{trans('Students_trans.Current_academic_department')}}</th>
                            <th style="font-size: 20px; font-weight: bold; text-align: center; vertical-align: middle;" >{{trans('Students_trans.Processes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promotions as $promotion)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{$promotion->student->Name}}</td>
                                <td>{{$promotion->f_grade->Name}}</td>
                                <td>{{$promotion->academic_year}}</td>
                                <td>{{$promotion->f_classroom->Name_classroom}}</td>
                                <td>{{$promotion->f_section->Name_Section}}</td>
                                <td>{{$promotion->t_grade->Name}}</td>
                                <td>{{$promotion->academic_year_new}}</td>
                                <td>{{$promotion->t_classroom->Name_classroom}}</td>
                                <td>{{$promotion->t_section->Name_Section}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">{{trans('Students_trans.Return_the_student')}}</button>
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{trans('Students_trans.Student_graduation')}}</button>
                                </td>
                            </tr>
                        @include('pages.Student.promotion.Delete_all')
                        @include('pages.Student.promotion.Delete_one')
                        @endforeach
                    </table>
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
