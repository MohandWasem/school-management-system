<!-- delete_modal_class -->
<div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                   {{ trans('classroom_trans.delete_class') }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <form action="{{ route('Classrooms.destroy') }}" method="post">
                   {{ method_field('Delete') }}
                   @csrf
                   {{ trans('classroom_trans.Warning_Grade') }}
                   <input id="id" type="hidden" name="id" class="form-control" value="{{ $My_Class->id }}">
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('classroom_trans.Close') }}</button>
                       <button type="submit" class="btn btn-danger">{{ trans('classroom_trans.submit') }}</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
</div>