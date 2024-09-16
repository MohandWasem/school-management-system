@extends('layouts.master')
@section('css')
    @section('title')
    {{trans('Parent_trans.show_results')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
    {{trans('Parent_trans.show_results')}}
    @stop
    <!-- breadcrumb -->

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('Parent_trans.show_results')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{trans('Parent_trans.show_results')}}</li>
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>{{trans('Students_trans.name_quizz')}}</th>
                                            <th>{{trans('Students_trans.Degree')}}</th>
                                            <th> {{trans('Students_trans.Date_test')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($degrees as $degree)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$degree->student->Name}}</td>
                                                <td>{{$degree->quizz->Name}}</td>
                                                <td>{{$degree->score}}</td>
                                                <td>{{$degree->date}}</td>
                                            </tr>
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

@endsection