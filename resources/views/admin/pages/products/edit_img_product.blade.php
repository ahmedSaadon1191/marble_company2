@extends('admin.layouts.master')
@section('css')
@toastr_css
@section('title')
صور لون المنتج
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
اضافه صور ولون المنتج
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
    <div class="error">{{ $errors->first('name') }}</div>
    @endif



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


                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title">
                        اضافه صور و كود و لون المنتج جديد
                    </h5>

                </div>
                <div class="modal-body">


                    @foreach ($productImgs as $pro)

                    <form action="{{ route('update_product_main_imgs',$pro->id) }}" method="POST" enctype="multipart/form-data" class="productImgRow{{ $pro->id }}">

                        @csrf

{



                        <input type="hidden" name="id" value="{{ $pro->id }}">
                        <input type="hidden" name="product_id" value="{{ $pro->product_id }}">

                        <div class="row">

                            {{-- IMG CODE  --}}
                            <div class="form-group col-2">
                                <label>كود المنتج:</label>
                                <input type="number" class="form-control" placeholder="ادخل كود المنتج" id="phone"
                                    name="code_img" required autocomplete="off" value="{{ $pro->code_img }}">
                            </div>

                            {{-- IMG COLOR AR --}}
                            <div class="form-group col-2">
                                <label> لون المنتج بالعربي</label>
                                <input name="color_name_ar" class="form-control" type="text" required
                                    placeholder="ادخل لون المنتج" value="{{ $pro->getTranslation('color_name','ar') }}">
                            </div>

                            {{-- IMG COLOR EN --}}
                            <div class="form-group col-2">
                                <label> لون المنتج بالانجليزية</label>
                                <input name="color_name_en" class="form-control" type="text" required
                                    placeholder="ادخل لون المنتج" value="{{ $pro->getTranslation('color_name','en') }}">
                            </div>

                            {{-- IMG COLOR PHOTO --}}
                            <div class="form-group col-md-2">


                                <img style="height:90px; width:100px;" src="{{ asset('/assets/images/'.$pro->tiny_img) }}"

                                <br>
                                <label style="display: block; margin-bottom:5px">صوره منتج</label>
                                <input type="file" name="tiny_img">
                                <a href="">
                                </a>
                            </div>

                            {{-- PREVIOUS WORK FOR THIS COLOR --}}
                            <div class="form-group col-2">
                                <img style="height:90px; width:100px;" src="{{ asset('/assets/images/'.$pro->max_img) }}"
                                    alt="">
                                <br>
                                <label style="display: block; margin-bottom:5px">صوره لمعرض الاعمال </label>
                                <input type="file" name="max_img">
                                <a href="">
                                </a>

                            </div>

                            {{-- SUBMIT BUTTON --}}
                            <div class="form-group col-2">
                                <button type="submit" class="btn btn-success ">تعديل صور المنتج</button>
                            </div>




                        </div>
                    </form>


                    <button type="submit" class="btn btn-danger deleteRow" id="{{ $pro->id }}" style="display: inline-block"> حزف بيانات الصورة </button>

                    @endforeach
                </div>

               @if ($productImgs && $productImgs->count() > 0)
                    <a href="{{ route('createNewProImg',$productImgs[0]->product_id) }}">
                        <button type="submit" class="btn btn-warning" style="float: left"> اضافة صورة جديدة </button>
                    </a>
                @else
                    <a href="{{ route('createNewProImg',$id) }}">
                        <button type="submit" class="btn btn-warning" style="float: left"> اضافة صورة جديدة </button>
                    </a>
               @endif







            </div>
        </div>
    </div>
</div>



<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function()
        {
            $('.deleteRow').on('click',function(e)
            {
                e.preventDefault();

                var btnId = $(this).attr('id');
                alert("تم الحزف بنجاح قم بتحديث الصفحة");

                if(btnId)
                 {
                     $.ajax(
                         {
                             url:"{{ url('/admin/deleteRow/product/') }}/" + btnId,
                             type:"GET",
                             dataType:"json",
                             success:function(data)
                             {
                                if (data.status == true)
                                {
                                    data.msg.show();
                                    $('.productImgRow'+btnId).remove();

                                }
                             }
                         });
                 }else
                 {
                     alert('Error');
                 }

            });
        });
    </script>



@endsection
