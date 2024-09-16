<!--موديل إضافة قسم -->
<div class="modal fade" id="add" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
               id="exampleModalLabel">
               <!--كلمة إضافة قسم جوه الموديل-->
               {{ trans('Sections_trans.add_section') }}</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">
           <form action="{{ route('Sections.store') }}" method="POST">
               {{ csrf_field() }}
               <div class="row">
                   <!--إضافة اسم القسم بالعربي input-->
                   <div class="col">
                       <input type="text" name="Name_Section_Ar" class="form-control"
                              placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                   </div>
                   <!--إضافة اسم القسم بالانجليزي input-->
                   <div class="col">
                       <input type="text" name="Name_Section_En" class="form-control"
                              placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                   </div>
               </div>
               <br>
               <div class="col">
                    <!--اسم المرحلة-->
                   <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                   <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())"> <!--ajaxبتاع اسم المرحلة اللي اليوزر هختارها عشان هستدعيه بال idخزن في الكونسول ال-->
                       <option value="" selected="true" disabled="disabled">{{ trans('Sections_trans.Select_Grade') }} </option><!--حدد المرحلة-->
                       @foreach ($List_Grades as $list_Grade)
                           <option value="{{ $list_Grade->id }}"> {{ $list_Grade->Name }} </option>
                       @endforeach
                   </select>
               </div>
               <br>
               <!--اسم الصف-->
               <div class="col">
                   <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                   <select name="Classroom_id" class="custom-select"> <!--ajaxهستدعيه بال-->
                        <!--optionعشان املى ال-->
                   </select>
               </div><br>
                <!--اسم المعلم-->
               <div class="col">
                   <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                   <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                       @foreach($Teachers as $teacher)
                           <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                       @endforeach
                   </select>
               </div>
       </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-secondary"
                   data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
           <button type="submit"
                   class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
       </div>
       </form>
   </div>
</div>
</div>

@section('js')
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
            $.each(data, function (key, value) {
                classroomSelect.append(`<option value="${key}">${value}</option>`);
            });
        }
    });
    </script>
@endsection