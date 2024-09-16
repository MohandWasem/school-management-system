@extends('layouts.master')
@section('css')
    
@section('title')
{{trans('Students_trans.add_quizz')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{trans('Students_trans.add_quizz')}}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('Students_trans.add_quizz')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Teacher_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.add_quizz')}}</li>
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
                            <form action="{{route('Quizz.store')}}" method="post" autocomplete="off">
                                @csrf                                
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title"> {{trans('Students_trans.add_ar_quizz')}}</label>
                                        <input type="text" name="Name_ar" class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="title"> {{trans('Students_trans.add_en_quizz')}}</label>
                                        <input type="text" name="Name_en" class="form-control" required>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id"> {{trans('Students_trans.name_matreial')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="subject_id" required>
                                                <option selected disabled>  {{trans('Students_trans.choose_subject')}}</option>
                                                @foreach($subjects as $subject)
                                                    <option  value="{{ $subject->id }}">{{ $subject->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Grade_id" required>
                                                <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                                @foreach($grades as $grade)
                                                    <option  value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="Classroom_id">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                            <select class="custom-select mr-sm-2" name="section_id">
                                                
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"  onclick="disableSubmitButton()" type="submit" > {{trans('Students_trans.save_data')}}</button>
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

    <script>
        $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('Get_classroom') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        updateClassroomOptions(data);
                    },
                    error: function () {
                        console.log('AJAX load did not work');
                    }
                });
            }
        });
    
        function updateClassroomOptions(data) {
            var classroomSelect = $('select[name="Classroom_id"]');
            classroomSelect.empty();
            classroomSelect.append('<option selected disabled>{{trans('Parent_trans.Choose')}}...</option>');
            $.each(data, function (key, value) {
                classroomSelect.append('<option value="' + key + '">' + value + '</option>');
            });
        }
    });
    
    </script>

    <script>
    $(document).ready(function () {
        $('select[name="Classroom_id"]').on('change', function () {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Section') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="section_id"]').empty();
                        $('select[name="section_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
    </script>
@endsection
