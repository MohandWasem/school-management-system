@extends('layouts.master')
@section('css')
    
@section('title')
    {{ trans('Sections_trans.title_page') }}:  {{trans('Students_trans.List_of_attendance_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}:  {{trans('Students_trans.List_of_attendance_students')}}
@stop
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{ trans('Sections_trans.title_page') }}:  {{trans('Students_trans.List_of_attendance_students')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Grades_trans.home') }}</a></li>
                <li class="breadcrumb-item active">  {{trans('Students_trans.List_of_attendance_students')}}</li>
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
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="accordion gray plus-icon round">
                
                @foreach ($Grades as $Grade)
                    <div class="acd-group">
                        <a href="#" class="acd-heading">{{ $Grade->Name }}</a>
                        <div class="acd-des">
                            <div class="row">
                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <div class="d-block d-md-flex justify-content-between">
                                                <div class="d-block">
                                                </div>
                                            </div>
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0">
                                                    <thead>
                                                    <tr class="text-dark">
                                                        <th>#</th>
                                                        <th>{{ trans('Sections_trans.Name_Section') }}</th>
                                                        <th>{{ trans('Sections_trans.Name_Class') }}</th><!--اسم المرحلة-->
                                                        <th>{{ trans('Sections_trans.Status') }}</th> <!--الحالة-->
                                                        <th>{{ trans('Sections_trans.Processes') }}</th><!--عمليات-->
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i = 0; ?>
                                                    @foreach ($Grade->Sections as $list_Sections)
                                                        <tr>
                                                            <?php $i++; ?>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ $list_Sections->Name_Section }}</td>
                                                            <td>{{ $list_Sections->Classrooms->Name_classroom }}</td>
                                                            <td>
                                                                <label class="badge badge-{{$list_Sections->Status == 1 ? 'success':'danger'}}">{{$list_Sections->Status == 1 ? trans('Students_trans.active') : trans('Students_trans.no_active')}}</label>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('Attendance.show',$list_Sections->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"> {{trans('Students_trans.List_Students')}}</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>


    </div>
</div>
</div>
        <!-- row closed -->
        @endsection
        @section('js')
            {{-- @toastr_js
            @toastr_render --}}
            <script>
                $(document).ready(function () {
                    $('select[name="Grade_id"]').on('change', function () {
                        var Grade_id = $(this).val();
                        if (Grade_id) {
                            $.ajax({
                                url: "{{ URL::to('classes') }}/" + Grade_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('select[name="Class_id"]').empty();
                                    $.each(data, function (key, value) {
                                        $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                    });
                                },
                            });
                        } else {
                            console.log('AJAX load did not work');
                        }
                    });
                });

            </script>

@endsection
