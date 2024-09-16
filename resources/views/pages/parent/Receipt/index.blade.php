@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        {{trans('Students_trans.receipt_students')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
    {{trans('Students_trans.receipt_students')}}
    @stop
    <!-- breadcrumb -->

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('Students_trans.receipt_students')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Grades_trans.home') }}</a></li>
                <li class="breadcrumb-item active"> {{trans('Students_trans.receipt_students')}}</li>
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
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('accounts_trans.name')}}</th>
                                            <th>{{trans('accounts_trans.amount')}}</th>
                                            <th>{{trans('accounts_trans.desc')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($receipt_students as $receipt_student)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$receipt_student->student->Name}}</td>
                                                <td>{{ number_format($receipt_student->Debait, 2) }}</td>
                                                <td>{{$receipt_student->description}}</td>
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
    @toastr_js
    @toastr_render
@endsection