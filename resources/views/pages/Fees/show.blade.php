@extends('layouts.master')
@section('css')
    
@section('title')
{{trans('sidebar_trans.fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('sidebar_trans.fees')}}
@stop
<!-- breadcrumb -->

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('sidebar_trans.fees')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('classroom_trans.home') }}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.fees')}}</li>
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
                                <a href="{{route('Fees.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true"> {{trans('accounts_trans.Add_new_fees')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('accounts_trans.name')}}</th>
                                            <th>{{trans('accounts_trans.amount')}}</th>
                                            <th>{{trans('accounts_trans.grade')}} </th>
                                            <th>{{trans('accounts_trans.my_classes')}} </th>
                                            <th>{{trans('accounts_trans.academic_year')}}</th>
                                            <th>{{trans('accounts_trans.Type_of_fees')}}</th>
                                            <th>{{trans('accounts_trans.notes')}}</th>
                                            <th>{{trans('accounts_trans.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee->Name}}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{$fee->grade->Name}}</td>
                                            <td>{{$fee->classroom->Name_classroom}}</td>
                                            <td>{{$fee->academic_year}}</td>
                                            <td>{{$fee->Fee_type==1 ? trans('accounts_trans.study_fees') : trans('accounts_trans.Bus_fees')}}</td>
                                            <td>{{$fee->notes}}</td>
                                                <td>
                                                    <a href="{{route('Fees.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" title="{{ trans('grades_trans.Edit') }}" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="#" class="btn btn-warning btn-sm" title="{{ trans('grades_trans.Show') }}" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>

                                                </td>
                                            </tr>
                                        @include('pages.Fees.Delete')
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