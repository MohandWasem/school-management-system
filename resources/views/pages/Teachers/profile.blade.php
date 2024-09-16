@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
    {{trans('sidebar_trans.profile_teacher')}}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('sidebar_trans.profile_teacher')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Teacher_trans.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{trans('sidebar_trans.profile_teacher')}}</li>
                </ol>
            </div>
        </div>
    </div>
@section('PageTitle')
    {{trans('sidebar_trans.profile_teacher')}}
@stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->



    <div class="card-body">

        <section style="background-color: #eee;">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{URL::asset('assets/images/teacher.png')}}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 style="font-family: Cairo" class="my-3">{{$information->Name}}</h5>
                            <p class="text-muted mb-1">{{$information->email}}</p>
                            <p class="text-muted mb-4">{{trans('Teacher_trans.teacher')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{route('profile.update',$information->id)}}" method="post">
                                @csrf
                                {{method_field('patch')}}
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">  {{trans('Teacher_trans.account_name_ar')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="Name_ar"
                                                   value="{{ $information->getTranslation('Name', 'ar') }}"
                                                   class="form-control">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"> {{trans('Teacher_trans.account_name_en')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="text" name="Name_en"
                                                   value="{{ $information->getTranslation('Name', 'en') }}"
                                                   class="form-control">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0"> {{trans('Teacher_trans.account_password')}}</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">
                                            <input type="password" id="password" class="form-control" name="password">
                                        </p><br><br>
                                        <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                               id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1"> {{trans('Teacher_trans.account_password_show')}}</label>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success"> {{trans('Teacher_trans.edit_info')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection