@extends('layouts.master')
@section('css')
    
@section('title')
    {{trans('accounts_trans.edit_fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  {{trans('accounts_trans.edit_fees')}} 
@stop
<!-- breadcrumb -->
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

                    <form action="{{route('Fees.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4"> {{trans('accounts_trans.name_er')}}</label>
                                <input type="text" value="{{$fee->getTranslation('Name','ar')}}" name="name_ar" class="form-control">
                                <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4"> {{trans('accounts_trans.name_en')}}</label>
                                <input type="text" value="{{$fee->getTranslation('Name','en')}}" name="name_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('accounts_trans.amount')}}</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{trans('accounts_trans.grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fee->Grade_id ? 'selected' : ""}}>{{ $Grade->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{trans('accounts_trans.my_classes')}}</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    <option value="{{$fee->Classroom_id}}">{{$fee->classroom->Name_classroom}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('accounts_trans.academic_year')}}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('accounts_trans.Type_of_fees')}}</label>
                                <select class="custom-select mr-sm-2" name="Fee_type">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    <option value="1" @if($fee->Fee_type == 1) selected @endif>{{trans('accounts_trans.study_fees')}}</option>
                                    <option value="2" @if($fee->Fee_type == 2) selected @endif>{{trans('accounts_trans.Bus_fees')}} </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('accounts_trans.notes')}}</label>
                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                                 rows="4">{{$fee->notes}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('accounts_trans.submit')}}</button>

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
@endsection
