@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('Students_trans.add_question')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.add_question')}}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('Students_trans.add_question')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Teacher_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.add_question')}}</li>
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

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('Questions.store') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title"> {{trans('Students_trans.name_question')}}</label>
                                        <input type="text" name="title" id="input-name"
                                               class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('Students_trans.answers')}}</label>
                                        <textarea name="answers" class="form-control" id="exampleFormControlTextarea1"
                                                  rows="4"></textarea>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title"> {{trans('Students_trans.answer_correct')}}</label>
                                        <input type="text" name="right_answer" id="input-name"
                                               class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id"> {{trans('Students_trans.name_quizz')}} : <span
                                                    class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="quizze_id">
                                                <option selected disabled>{{trans('Students_trans.choose_quizz')}}</option>
                                                @foreach($quizzes as $quizze)
                                                    <option value="{{ $quizze->id }}">{{ $quizze->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Degree')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled>{{trans('Students_trans.choose_degree')}}</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit"> {{trans('Students_trans.save_data')}}</button>
                            </form>
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
