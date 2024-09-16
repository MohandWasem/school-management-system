@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('Students_trans.List_Students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.List_Students')}}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('Students_trans.List_Students') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('Students_trans.List_Students') }}</li>
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
                        <a href="{{route('Students.create')}}" class="btn btn-success btn-sm" role="button"
                            aria-pressed="true">{{trans('Students_trans.add_Students')}}</a><br><br>
                        <div class="table-respon    sive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('Students_trans.name')}}</th>
                                    <th>{{trans('Students_trans.email')}}</th>
                                    <th>{{trans('Students_trans.gender')}}</th>
                                    <th>{{trans('Students_trans.Grade')}}</th>
                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                    <th>{{trans('Students_trans.section')}}</th>
                                    <th>{{trans('Students_trans.Processes')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Students as $student)
                                    <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{$student->Name}}</td>
                                    <td>{{$student->email}}</td>
                                    <td>{{$student->genders->Name}}</td>
                                    <td>{{$student->grades->Name}}</td>
                                    <td>{{$student->classrooms->Name_classroom}}</td>
                                    <td>{{$student->sections->Name_Section}}</td>
                                        <td>
                                            <div class="dropdown show">
                                                <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{trans('Students_trans.Processes')}}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <a class="dropdown-item" href="{{route('Students.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  عرض بيانات الطالب</a>
                                                    <a class="dropdown-item" href="{{route('Students.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  {{trans('Students_trans.Edit')}}</a>
                                                    <a class="dropdown-item" href="{{route('FeeInvoice.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i> {{trans('Students_trans.add_studty_fee')}} </a>
                                                    <a class="dropdown-item" href="{{route('ReceiptStudent.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp; {{trans('Students_trans.receipt_student')}} </a>
                                                    <a class="dropdown-item" href="{{route('ProcessingFee.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;  {{trans('Students_trans.processing_fee')}} </a>
                                                    <a class="dropdown-item" href="{{route('PaymentStudent.show',$student->id)}}"><i style="color:goldenrod" class="fas fa-donate"></i>&nbsp; &nbsp; {{trans('Students_trans.PaymentStudent')}}</a>
                                                    <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="##Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @include('pages.Student.delete')
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
