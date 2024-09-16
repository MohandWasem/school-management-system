@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('Students_trans.List_of_attendance_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
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
    <form method="post" action="{{ route('Attendance.store') }}">

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
                    <td>{{ $student->Email }}</td>
                    <td>{{ $student->genders->Name }}</td>
                    <td>{{ $student->grades->Name }}</td>
                    <td>{{ $student->classrooms->Name_classroom }}</td>
                    <td>{{ $student->sections->Name_Section }}</td>
                    <td>

                            @php
                                // الحصول على سجل الحضور للتاريخ الحالي
                                $attendance = $student->attendance()->where('Attendance_date', date('Y-m-d'))->first();
                            @endphp

                            @if($attendance)
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendances[{{ $student->id }}]" disabled
                                        {{ $attendance->Attendance_status == 1 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="1">
                                    <span class="text-success">{{ trans('Students_trans.Attendance') }}</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendances[{{ $student->id }}]" disabled
                                        {{ $attendance->Attendance_status == 0 ? 'checked' : '' }}
                                        class="leading-tight" type="radio" value="0">
                                    <span class="text-danger">{{ trans('Students_trans.absence') }}</span>
                                </label>
                            @else
                                <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                    <input name="attendances[{{ $student->id }}]"
                                        class="leading-tight" type="radio" value="1">
                                    <span class="text-success">{{ trans('Students_trans.Attendance') }}</span>
                                </label>

                                <label class="ml-4 block text-gray-500 font-semibold">
                                    <input name="attendances[{{ $student->id }}]"
                                        class="leading-tight" type="radio" value="0">
                                    <span class="text-danger">{{ trans('Students_trans.absence') }}</span>
                                </label>
                            @endif



                        <input type="hidden" name="student_id[]" value="{{ $student->id }}">
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
