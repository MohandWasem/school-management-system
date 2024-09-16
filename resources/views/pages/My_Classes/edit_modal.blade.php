<!-- edit_modal_cladss -->
<div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('classroom_trans.edit_class') }}</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- edit_form -->
               <form action="{{ route('Classrooms.update') }}" method="post">
                   {{ method_field('patch') }}
                   @csrf
                   <div class="row">
                       <div class="col">
                           <label for="Name"
                                  class="mr-sm-2">{{ trans('classroom_trans.Name_class_ar') }}
                               :</label>
                           <input id="Name" type="text" name="Name" class="form-control" value="{{ $My_Class->getTranslation('Name_classroom', 'ar') }}"
                                  required>
                           <input id="id" type="hidden" name="id" class="form-control" value="{{ $My_Class->id }}">
                       </div>
                       <div class="col">
                           <label for="Name_en" class="mr-sm-2">{{ trans('classroom_trans.Name_class_en') }}
                               :</label>
                           <input type="text" class="form-control" value="{{ $My_Class->getTranslation('Name_classroom', 'en') }}" name="Name_en" required>
                       </div>
                   </div><br>
                   <div class="form-group">
                       <label for="exampleFormControlTextarea1"> {{ trans('classroom_trans.Name_Grade') }}   :</label>
                       <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="Grade_id">
                           <option value="{{ $My_Class->Grades->id }}" selected> {{ $My_Class->Grades->Name }} </option>
                           @foreach ($Grades as $Grade)
                           @if ($Grade->id !== $My_Class->Grades->id)
                           <option value="{{ $Grade->id }}"> {{ $Grade->Name }} </option>
                           @endif
                           @endforeach
                       </select>

                   </div>
                   <br><br>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Grades_trans.close') }}</button>
                       <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                   </div>
               </form>

           </div>
       </div>
   </div>
</div>