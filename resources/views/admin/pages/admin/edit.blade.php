  <!-- edit_modal_Grade -->
  <div class="modal fade" id="edit{{ $value->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                   id="exampleModalLabel">
                  تعديل بيانات المدير {{ $value->name }}
               </h5>
               <button type="button" class="close" data-dismiss="modal"
                       aria-label="Close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <!-- Edit_Form -->
               <form action="{{ route('admin.update',$value->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="text-center">
                    <img src="{{ asset('assets/images/'. $value->logo) }}" alt="" style="height: 100px; width:100px">
                </div><br><br>

                <div class="row">
                    <div class="col">
                        <label for="Name" class="mr-sm-2">
                              اسم المدير
                            :</label>
                        <input id="Name" type="text" name="name" class="form-control" value="{{ $value->name }}">
                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">
                               ايميل المدير
                         :</label>
                        <input type="email" class="form-control" name="email" required value="{{ $value->email }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for=""> تعديل الصورة الشخصية</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <br><br>
                 </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary"
                                 data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                         <button type="submit"
                                 class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                     </div>
             </form>

           </div>
       </div>
   </div>
</div>
