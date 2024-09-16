@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('classroom_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('classroom_trans.title_page') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('classroom_trans.home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('sidebar_trans.Classrooms_list') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
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
            <button type="button" class="button x-small" data-toggle="modal" data-target="#add">
                {{ trans('classroom_trans.add_class') }}
            </button>
                <button type="button" class="button x-small" id="btn_delete_all">
                    {{ trans('classroom_trans.delete_checkbox') }}
                </button>
            <br><br>
                <form action="{{ route('Filter_Classes') }}" method="POST">
                    {{ csrf_field() }}
                    <select class="selectpicker" data-style="btn-info" name="Grade_id" required  onchange="this.form.submit()">
                        <option value="" selected disabled>{{ trans('classroom_trans.Search_By_Grade') }}</option>
                        @foreach ($Grades as $Grade)
                            <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                        @endforeach
                    </select>
                </form>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                            <th>#</th>
                            <th>{{ trans('classroom_trans.Name_class') }}</th>
                            <th>{{ trans('classroom_trans.Name_Grade') }}</th>
                            <th>{{ trans('classroom_trans.Processes') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                    @if (isset($details))

                        <?php $List_Classes = $details; ?>
                    @else

                        <?php $List_Classes = $My_Classes; ?>
                    @endif

                        <?php $i = 0; ?>
                        @foreach ($List_Classes as $My_Class)
                            <tr>
                                <td> <input class="box1" type="checkbox" value="{{ $My_Class->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $My_Class->Name_classroom  }}</td>
                                <td>{{ $My_Class->Grades->Name }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $My_Class->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                        class="fa fa-trash"></i></button>
                                </td>
                            </tr>


                            @include('pages.My_Classes.edit_modal')

                            @include('pages.My_Classes.delete_model')
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>




    </div>

    <!-- add_modal_class -->
    @include('pages.My_Classes.add_model')

<!-- حذف مجموعة صفوف -->
@include('pages.My_Classes.delete_all')



</div>

</div>

<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        // عند النقر على زر حذف الكل
        $("#btn_delete_all").click(function() {
            var selectedItems = [];

            // البحث عن جميع عناصر الإدخال (checkbox) المحددة في الجدول
            $("#datatable input[type=checkbox]:checked").each(function() {
                selectedItems.push(this.value);
            });

            // عرض النموذج (modal) فقط إذا كان هناك عناصر محددة
            if (selectedItems.length > 0) {
                $('#delete_all').modal('show');
                $('input[id="delete_all_id"]').val(selectedItems.join(',')); // تحويل المصفوفة إلى سلسلة مفصولة بفواصل
            }
        });
    });
</script>

@endsection
