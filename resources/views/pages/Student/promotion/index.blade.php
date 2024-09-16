@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('Students_trans.Students_Promotions')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.Students_Promotions')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif 
                        <h6 style="color: red;font-family: Cairo">{{trans('grades_trans.old_grades')}}</h6><br> 
                        <form method="post" action="{{ route('Promotion.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                    <select class="custom-select mr-sm-2" name="Grade_id" required>
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($Grades as $Grade)
                                            <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id" required>
    
                                    </select>
                                </div>
    
                                <div class="form-group col">
                                    <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id" required>
    
                                    </select>
                                </div>
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                <option value="{{ $year}}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br><h6 style="color: red;font-family: Cairo"> {{trans('grades_trans.new_grades')}}</h6><br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                    <select class="custom-select mr-sm-2" name="Grade_id_new" >
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($Grades as $Grade)
                                            <option value="{{$Grade->id}}">{{$Grade->Name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="Classroom_id">{{trans('Students_trans.classrooms')}}: <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="Classroom_id_new" >
    
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label for="section_id">:{{trans('Students_trans.section')}} </label>
                                    <select class="custom-select mr-sm-2" name="section_id_new" >
    
                                    </select>
                                </div>
    
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                                        <select class="custom-select mr-sm-2" name="academic_year_new">
                                            <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                                <option value="{{ $year}}">{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{trans('Students_trans.submit')}}</button>
                        </form>
                </div>
            </div>
        </div>
                    <div class="card-body">
                        <div class="col-xl-12 mb-30">
                            <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <h6 style="color: red;font-family: Cairo"> {{trans('Students_trans.Students of old stages and classes')}}</h6><br> 
                                        <table id="students-table" class="table table-hover table-sm table-bordered p-0"
                                            data-page-length="50" style="text-align: center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{trans('Students_trans.name')}}</th>
                                                    <th>{{trans('Students_trans.email')}}</th>
                                                    <th>{{trans('Students_trans.gender')}}</th>
                                                    <th>{{trans('Students_trans.Grade')}}</th>
                                                    <th>{{trans('Students_trans.classrooms')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="students-table-body">
                                                <!-- Data will be dynamically added here -->
                                            </tbody>
                                        </table>
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
            {{------------- مراحل الدراسيه قديمة ---------------}}
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

        {{----------------- مراحل الدراسيه جديده ---------------}}

        <script>
            $(document).ready(function () {
             $('select[name="Grade_id_new"]').on('change', function () {
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
                 var classroomSelect = $('select[name="Classroom_id_new"]');
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
            $('select[name="Classroom_id_new"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id_new"]').empty();
                            $('select[name="section_id_new"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
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
