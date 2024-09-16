@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Students_trans.Student_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->

    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ trans('Students_trans.Student_details') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Students_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ trans('Students_trans.Student_details') }}</li>
                </ol>
            </div>
        </div>
    </div>
@section('PageTitle')
    {{trans('Students_trans.Student_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
<div class="row">
<div class="col-md-12 mb-30">
<div class="card card-statistics h-100">
    <div class="card-body">
        <div class="card-body">
            <div class="tab nav-border">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                            role="tab" aria-controls="home-02"
                            aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                            role="tab" aria-controls="profile-02"
                            aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                            aria-labelledby="home-02-tab">
                        <table class="table table-striped table-hover" style="text-align:center">
                            <tbody>
                            <tr>
                                <th scope="row">{{trans('Students_trans.name')}}</th>
                                <td>{{ $Student->Name }}</td>
                                <th scope="row">{{trans('Students_trans.email')}}</th>
                                <td>{{$Student->email}}</td>
                                <th scope="row">{{trans('Students_trans.gender')}}</th>
                                <td>{{$Student->genders->Name}}</td>
                                <th scope="row">{{trans('Students_trans.Nationality')}}</th>
                                <td>{{$Student->nationalities->Name}}</td>
                            </tr>

                            <tr>
                                <th scope="row">{{trans('Students_trans.Grade')}}</th>
                                <td>{{ $Student->grades->Name }}</td>
                                <th scope="row">{{trans('Students_trans.classrooms')}}</th>
                                <td>{{$Student->classrooms->Name_classroom}}</td>
                                <th scope="row">{{trans('Students_trans.section')}}</th>
                                <td>{{$Student->sections->Name_Section}}</td>
                                <th scope="row">{{trans('Students_trans.Date_of_Birth')}}</th>
                                <td>{{ $Student->Date_Birth}}</td>
                            </tr>

                            <tr>
                                <th scope="row">{{trans('Students_trans.parent')}}</th>
                                <td>{{ $Student->parents->Name_Father}}</td>
                                <th scope="row">{{trans('Students_trans.academic_year')}}</th>
                                <td>{{ $Student->academic_year }}</td>
                                <th scope="row"></th>
                                <td></td>
                                <th scope="row"></th>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>


                    <div class="tab-pane fade" id="profile-02" role="tabpanel"
                            aria-labelledby="profile-02-tab">
                        <div class="card card-statistics">
                            <div class="card-body">
                                <form method="post" action="{{route('Upload_attachment')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label
                                                for="academic_year">{{trans('Students_trans.Attachments')}}
                                                : <span class="text-danger">*</span></label>
                                            <input type="file" accept="image/*" name="photos[]" multiple required>
                                            <input type="hidden" name="student_name" value="{{$Student->Name}}">
                                            <input type="hidden" name="student_id" value="{{$Student->id}}">
                                        </div>
                                    </div>
                                    <br><br>
                                    <button type="submit" class="button button-border x-small">
                                            {{trans('Students_trans.submit')}}
                                    </button>
                                </form>
                            </div>
                            <br>
                            <table class="table center-aligned-table mb-0 table table-hover"
                                    style="text-align:center">
                                <thead>
                                <tr class="table-secondary">
                                    <th scope="col">#</th>
                                    <th scope="col">{{trans('Students_trans.filename')}}</th>
                                    <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                    <th scope="col">{{trans('Students_trans.Processes')}}</th> 
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($Student->Attachments as $attachment)
                                    <tr style='text-align:center;vertical-align:middle'>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$attachment->file_name}}</td>
                                        <td>{{$attachment->created_at->diffForHumans()}}</td>
                                        <td colspan="2">
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('Open_attachment', ['studentsname' => $attachment->student->Name, 'filename' => $attachment->file_name]) }}" role="button">
                                                <i class="fas fa-eye"></i>&nbsp;{{trans('Students_trans.open')}}
                                            </a>
                                            {{-- <a class="btn btn-outline-info btn-sm"
                                                href="{{route('Download_attachment')}}/{{$attachment->student->Name}}/{{ $attachment->file_name }}"
                                                href="{{ url('Download_attachment/' . $attachment->student->Name . '/' . $attachment->file_name)}}"
                                                role="button"><i class="fas fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}</a> --}}

                                            <a class="btn btn-outline-info btn-sm"
                                              href="{{ url('Download_attachment/' . urlencode($attachment->student->Name) . '/' . urlencode($attachment->file_name)) }}"
                                              role="button"><i class="fas fa-download"></i>&nbsp; {{ trans('Students_trans.Download') }}</a>
                                              
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#Delete_img{{ $attachment->id }}"
                                                    title="{{ trans('Grades_trans.Delete') }}">{{trans('Students_trans.delete')}}
                                            </button>

                                        </td>
                                    </tr>
                                    @include('pages.Student.Delete_img')
                                @endforeach
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
@endsection
