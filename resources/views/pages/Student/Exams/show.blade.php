@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
    @section('title')
         {{trans('Students_trans.Take_a_test')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('Students_trans.Take_a_test')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{trans('Students_trans.Take_a_test')}}</li>
                </ol>
            </div>
        </div>
    </div>
    @section('PageTitle')
    {{trans('Students_trans.Take_a_test')}}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('show-question', ['quizz_id' => $quizz_id, 'student_id' => $student_id])

@endsection
@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection