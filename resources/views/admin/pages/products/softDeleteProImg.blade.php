@extends('admin.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Grades_trans.title_page') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Grades')}}
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



                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الصورة</th>
                                <th> اسم الون</th>
                                <th>صورة اللون</th>
                                <th>صورة للاعمال السابقة</th>
                                <th>  اسم المنتج</th>
                                <th>الاجرائات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($proImg as $value)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $value->code_img }}</td>
                                    <td>{{ $value->color_name }}</td>
                                    <td>
                                        <img style="height:90px; width:100px;" src="{{ asset('/assets/images/'.$value->tiny_img) }}"
                                    </td>
                                    <td>
                                        <img style="height:90px; width:100px;" src="{{ asset('/assets/images/'.$value->max_img) }}"
                                    </td>

                                    <td>
                                        {{ $value->products->getTranslation('name','ar') }}
                                    </td>

                                    <td>

                                       <div class="row">
                                           <div class="col-sm-3">
                                            <form action="{{ route('proImg.restore',$value->id) }}" method="post">
                                                @csrf

                                                <input type="submit" value="Restore" class="btn btn-info btn-sm">


                                            </form>
                                           </div>

                                           <div class="col-sm-3">
                                            <form action="{{ route('proImg.forceDelete',$value->id) }}" method="post">
                                                @csrf

                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                           </div>
                                       </div>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        {{-- @include('admin.pages.proImg.create') --}}

    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
