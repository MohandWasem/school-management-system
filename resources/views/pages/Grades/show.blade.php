@extends('layouts.master')
@section('css')

@section('title')
{{ trans('sidebar_trans.Grades') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('sidebar_trans.Grades_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Grades_trans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('sidebar_trans.Grades_list') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">   
    <div class="col-xl-12 mb-30">   
      <div class="card card-statistics h-100"> 
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <button type="button" class="button x-small" data-toggle="modal" data-target="#add">
                {{ trans('Grades_trans.add_Grade') }}
            </button>
            <br><br>
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('grades_trans.Name')}}</th>
                    <th>{{trans('grades_trans.Notes')}}</th>
                    <th>{{trans('grades_trans.Processes')}}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Grades as $Grade)
                    
                <tr>
                    <td>{{$id++}}</td>
                    <td>{{$Grade->Name}}</td>
                    <td>{{$Grade->Notes}}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#edit{{ $Grade->id }}"
                        title="{{trans('grades_trans.Edit')}}"><i class="fa fa-edit"></i></button>

                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#delete{{ $Grade->id }}"
                        title="{{trans('grades_trans.Delete')}}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>

                @include('pages.Grades.edit_model')
                @include('pages.Grades.delete_model')
                @empty
                    
                @endforelse
               
            
         </table>
        </div>
        </div>
      </div>   
    </div>
    @include('pages.Grades.add_model')
</div> 

<!-- row closed -->
@endsection
@section('js')

@endsection
