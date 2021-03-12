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
   المنتجات الغير مفعلة
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
                                <th>اسم المنتج بالعربي</th>
                                <th>اسم المنتج بالانجليزية</th>
                                <th> اهمية المنتج</th>
                                <th>الاجرائات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($products as $value)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $value->getTranslation('name','ar') }}</td>
                                    <td>{{ $value->getTranslation('name','en') }}</td>
                                    <td>{{ $value->status() }}</td>

                                    <td>

                                       <div class="row">
                                           <div class="col-sm-3">
                                            <form action="{{ route('products.restore',$value->id) }}" method="post">
                                                @csrf

                                                <input type="submit" value="Restore" class="btn btn-info btn-sm">


                                            </form>
                                           </div>

                                           <div class="col-sm-3">
                                            <form action="{{ route('products.forceDelete',$value->id) }}" method="post">
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


        {{-- @include('admin.pages.products.create') --}}

    </div>

    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
