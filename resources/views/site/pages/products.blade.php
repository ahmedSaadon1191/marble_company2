@extends('site.layouts.app')

@section('content')




<!-- start layout -->
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000" style="height: 700px">
            <img src="{{ asset('site/assets/img/gallary1.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="phragraph_productslider">
                    <img class="qutes1" src="img/qutes2.svg" alt="">



                    <img class="qutes2" src="img/qutes2.svg" alt="">
                </p>
            </div>
        </div>




        @if ($sliders)
        @foreach ($sliders as $slider)
        <div class="carousel-item" style="height: 700px">
            <img src="{{ asset('admin/img/productslider/'. $slider->image) }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <p class="phragraph_productslider">
                    <img class="qutes1" src="img/qutes2.svg" alt="">
                    {{ $slider->description }}
                    <img class="qutes2" src="img/qutes2.svg" alt="">
                </p>
            </div>
        </div>
        @endforeach
        @endif








    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
    .carousel-indicators {
        margin-bottom: 20px;
    }

    .carousel-indicators .active {
        opacity: 1;
        background-color: burlywood;
        height: 10px;
        margin-left: 3px;
    }

    .phragraph_productslider {
        position: absolute;
        z-index: 20;
        width: 45%;
        text-align: left;
        left: 110px;
        bottom: 20px;
        direction: ltr;
        font-size: 20px;
        color: #2f3548;
        font-weight: 700;
    }
</style>



<!-- start product imgs -->
<div class="container-fluid productimegs">
    <div class="row">


        @if ($single_product_imgs_code)
        @foreach ($single_product_imgs_code as $img)
        <div class="col-lg-2 col-md-4 col-sm-6">
            <img src="{{ asset('/assets/images/' .$img->max_img ) }}" alt="" style="height: 220px">
        </div>
        @endforeach

        @endif

    </div>
</div>
<!-- end product imgs -->














<!-- strat form search -->
<div class="container form_product_search">
    <form action="">
        <div class="row">
            <div class="col-lg-6">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="col-form-label">search for color</label>
                    </div>
                    <div class="col-auto inputcontent">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Color....</option>
                            <option value="1">red</option>
                            <option value="2">blue</option>
                            <option value="3">black</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label class="col-form-label">search for </label>
                    </div>
                    <div class="col-auto inputcontent">
                        <input type="text" class="form-control" placeholder="# sampel Number">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row search_result">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <img src="img/resultserach1.jpg" alt="">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
            <img src="img/resultserach2.jpg" alt="">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <img src="img/resultserach3.jpg" alt="">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <img src="img/resultserach1.jpg" alt="">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <img src="img/resultserach2.jpg" alt="">
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <img src="img/resultserach3.jpg" alt="">
        </div>
        <div class="col-md-12 text-center">
            <a href="#" class="but1">more</a>
        </div>
    </div>
</div>
<!-- end form search -->


<!-- start detailes -->

<!-- end detailes -->


  <!-- start top products -->
  <div class="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <h1 class="head2">top products</h1>
                <div class="owl-carousel owl-theme">

                    @foreach ($top_products as $product)
                        {{-- {{ $product->productImage[0]->tiny_img }} --}}

                        <div class="item">
                            <div class="content-img">
                                @if ($product && $product->count() > 0)
                                    <img src="{{ asset('/assets/images/'.$product->productImage[0]->tiny_img) }}" alt="">
                                @endif
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>

<!-- end top products -->
<!-- end top products -->


<!-- end layout -->
@endsection
