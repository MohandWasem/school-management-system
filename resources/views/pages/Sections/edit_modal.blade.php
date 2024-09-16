<!--تعديل قسم جديد -->
<div class="modal fade"
id="edit{{ $list_Sections->id }}"
tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title"
               style="font-family: 'Cairo', sans-serif;"
               id="exampleModalLabel">
               {{ trans('Sections_trans.edit_Section') }}
           </h5>
           <button type="button" class="close"
                   data-dismiss="modal"
                   aria-label="Close">
           <span
               aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">

           <form
               action="{{ route('Sections.update', $list_Sections->id) }}"
               method="POST">
               {{ method_field('patch') }}
               {{ csrf_field() }}
               <div class="row">
                   <div class="col">
                       <input type="text"
                              name="Name_Section_Ar"
                              class="form-control"
                              value="{{ $list_Sections->getTranslation('Name_Section', 'ar') }}">
                   </div>

                   <div class="col">
                       <input type="text"
                              name="Name_Section_En"
                              class="form-control"
                              value="{{ $list_Sections->getTranslation('Name_Section', 'en') }}">
                       <input id="id"
                              type="hidden"
                              name="id"
                              class="form-control"
                              value="{{ $list_Sections->id }}">
                   </div>

               </div>
               <br>


               <div class="col">
                   <label for="inputName"
                          class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                   <select name="Grade_id"
                           class="custom-select"
                           onclick="console.log($(this).val())">
                       <!--placeholder-->
                       <option
                           value="{{ $Grade->id }}">
                           {{ $Grade->Name }}
                       </option>
                       @foreach ($List_Grades as $list_Grade)
                           <option
                               value="{{ $list_Grade->id }}">
                               {{ $list_Grade->Name }}
                           </option>
                       @endforeach
                   </select>
               </div>
               <br>

               <div class="col">
                   <label for="inputName"
                          class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                   <select name="Classroom_id"
                           class="custom-select">
                       <option
                           value="{{ $list_Sections->classrooms->id }}">
                           {{ $list_Sections->classrooms->Name_classroom }}
                       </option>
                   </select>
               </div>
               <br>
               <!-- edit_modal_Grade -->
               <div class="col">
                   <div class="form-check">
                       @if ($list_Sections->Status === 1)
                           <input type="checkbox" checkedclass="form-check-input" name="Status" id="exampleCheck1" checked>
                       @else
                           <input type="checkbox"class="form-check-input"name="Status"id="exampleCheck1">
                       @endif
                       <label
                           class="form-check-label"
                           for="exampleCheck1">{{ trans('Sections_trans.Status') }}</label><br>

                           <div class="col">
                               <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label>
                               <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                   {{-- @foreach($list_Sections->teachers as $teacher)
                                       <option selected value="{{$teacher['id']}}">{{$teacher['Name']}}</option>
                                   @endforeach

                                   @foreach($Teachers as $teacher)
                                       <option value="{{$teacher->id}}">{{$teacher->Name}}</option>
                                   @endforeach --}}
                                   @foreach($Teachers as $teacher)
                                   <option value="{{ $teacher->id }}" 
                                       {{ in_array($teacher->id, $list_Sections->teachers->pluck('id')->toArray()) ? 'selected' : '' }}>
                                       {{ $teacher->Name }}
                                   </option>
                               @endforeach
                               </select>
                           </div>
                   </div>
               </div>
       </div>
       <div class="modal-footer">
           <button type="button"
                   class="btn btn-secondary"
                   data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
           <button type="submit"
                   class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
       </div>
       </form>
   </div>
</div>
</div>
