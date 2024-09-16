@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('Students_trans.List_of_attendance_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('Students_trans.List_of_attendance_students')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Teacher_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{trans('Students_trans.List_of_attendance_students')}}</li>
                </ol>
            </div>
        </div>
    </div>
@section('PageTitle')
{{trans('Students_trans.List_of_attendance_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif



    <h5 style="font-family: 'Cairo', sans-serif;color: red">  {{trans('Students_trans.Today_date')}} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{route('attendance.create')}}">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->Name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->genders->Name }}</td>
                    <td>{{ $student->grades->Name }}</td>
                    <td>{{ $student->classrooms->Name_classroom }}</td>
                    <td>{{ $student->sections->Name_Section }}</td>
                    <td>

                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendances[{{ $student->id }}]"
                                @foreach ($student->attendance()->where('Attendance_date', date('Y-m-d'))->get() as $attendance)
                                {{ $attendance->Attendance_status == 1 ? 'checked' : '' }}
                                @endforeach
                                class="leading-tight"
                                 type="radio" value="1">
                            <span class="text-success">{{ trans('Students_trans.Attendance') }}</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendances[{{ $student->id }}]"
                                @foreach ($student->attendance()->where('Attendance_date', date('Y-m-d'))->get() as $attendance)
                                {{ $attendance->Attendance_status == 0 ? 'checked' : '' }}
                                @endforeach
                                class="leading-tight" type="radio" value="0">
                            <span class="text-danger">{{ trans('Students_trans.absence') }}</span>
                        </label>
                           

                        <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                        <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->Section_id }}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
