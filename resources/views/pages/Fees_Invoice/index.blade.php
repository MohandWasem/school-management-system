@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('accounts_trans.fee_invoices')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{trans('accounts_trans.fee_invoices')}}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{trans('accounts_trans.fee_invoices')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Grades_trans.home') }}</a></li>
                <li class="breadcrumb-item active"> {{trans('accounts_trans.fee_invoices')}}</li>
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
                                            <th>{{trans('accounts_trans.name_student')}}</th>
                                            <th> {{trans('accounts_trans.Type_of_fees')}}</th>
                                            <th>{{trans('accounts_trans.amount')}}</th>
                                            <th> {{trans('Students_trans.Grade')}}</th>
                                            <th> {{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('accounts_trans.desc')}}</th>
                                            <th>{{trans('accounts_trans.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Fee_invoices as $Fee_invoice)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$Fee_invoice->student->Name}}</td>
                                            <td>{{$Fee_invoice->Fee->Name}}</td>
                                            <td>{{ number_format($Fee_invoice->amount, 2) }}</td>
                                            <td>{{$Fee_invoice->Grade->Name}}</td>
                                            <td>{{$Fee_invoice->Classroom->Name_classroom}}</td>
                                            <td>{{$Fee_invoice->notes}}</td>
                                                <td>
                                                    <a href="{{route('FeeInvoice.edit',$Fee_invoice->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$Fee_invoice->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.Fees_invoice.Delete')
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
