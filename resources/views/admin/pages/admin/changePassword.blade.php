@extends('admin.layouts.master')
@section('css')
    @toastr_css
@section('title')
    تعديل بيات المديرالشخصية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    تعديل بيانات  {{ auth()->user()->name }}
@stop
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


                    <form action="{{ route('admin.changePassword.update',auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf


                            <div class="col-md-12" style="margin-top: 50px">
                                <h3 class="text-center">تعديل كلمة السر</h3>
                            </div>




                            {{--  ADMIN ID   --}}
                            <input type="hidden" name="admin_id"  value="{{ $admin->id }}" >

                            {{--  ADMIN OLD PASSWORD   --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> كلمة السر القديمة </label>
                                    <input type="text" name="old_password" class="form-control" placeholder="ادخل كلمة السر القديمة">
                                    @error("old_password")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            {{--  ADMIN NEW PASSWORD   --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> كلمة السر الجديدة </label>
                                    <input type="text" name="new_password" class="form-control" placeholder="ادخل  كلمة السر الجديدة">
                                    @error("new_password")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            {{--  ADMIN CONFERM NEW PASSWORD   --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for=""> تاكيد كلمة السر الجديدة </label>
                                    <input type="text" name="confirm_password" class="form-control" placeholder="ادخل كلمة السر الجديدة مرة اخري">
                                    @error("confirm_password")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <br><br><br>
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

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
