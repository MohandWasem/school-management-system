@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{ trans('Students_trans.add_online_courses') }} 
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{ trans('Students_trans.add_online_courses') }} 
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{ trans('Students_trans.add_online_courses') }} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Sections_trans.Home') }}</a></li>
                <li class="breadcrumb-item active"> {{ trans('Students_trans.add_online_courses') }} </li>
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('onlineClasses.store') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">{{ trans('Students_trans.Grade') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Grade_id" required>
                                    <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach ($Grades as $Grade)
                                        <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                <select class="custom-select mr-sm-2" name="section_id">

                                </select>
                            </div>
                        </div>
                    </div><br>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> {{ trans('Students_trans.course_address') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic" type="text" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  {{ trans('Students_trans.course_start') }} : <span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>  {{ trans('Students_trans.course_duration') }}  : <span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="text" required>
                            </div>
                        </div>

                    </div>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

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
                url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
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
                url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
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