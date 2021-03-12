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

                    <div class="text-center">
                        <img src="{{ asset('assets/images/'. auth()->user()->logo) }}" alt="" style="height: 100px; width:100px">
                    </div><br><br>
                    <br><br>

                    <form action="{{ route('admin.profile.update',auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">
                                       اسم المدير
                                    :</label>
                                <input id="Name" type="text" name="name" class="form-control" value="{{ $admin->name }}">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">
                                       ايميل المدير
                                 :</label>
                                <input type="email" class="form-control" name="email" required value="{{ $admin->email }}">
                            </div>

                            <div class="col-sm-12">
                                <label for=""> تعديل صورة المدير</label>
                                <input type="file" name="logo" class="form-control">
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
