@extends('site.layouts.appHome')

@section('content')
      <!-- start layout -->


        <!-- start slider -->
        <div class="slider">
            <div class="div-logo">
                <img class="img1" src="{{ asset('site/assets/img/backgroundslider.svg') }}" alt="">
                <img class="img2" src="{{ asset('site/assets/img/logo-white.svg') }}" alt="">
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/images/'.$aboutUsHomeFirst->logo) }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/images/'.$aboutUsHomeLast->logo) }}" class="d-block w-100" alt="...">
                </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"> <i class="fas fa-chevron-left"></i> </span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"  data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    <!-- end slider -->

    <!-- start detailes -->
        <div class="detailes">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        {{-- <h1 class="head1">solidity <span>and</span></h1>
                        <h1 class="head1">magnificence !</h1> --}}

                        @if ($aboutUsHomeFirst && $aboutUsHomeFirst->count() > 0)
                            <h1 class="head1"><span>{{ $aboutUsHomeFirst->title }}</span> !</h1>
                        @endif


                        <p class="paragraph">
                            <img class="qutes1" src="{{ asset('/assets/images/qutes1.svg') }}" alt="">
                               @if ($aboutUsHomeFirst && $aboutUsHomeFirst->count() > 0)
                                    {{ $aboutUsHomeFirst->descreption }}
                               @endif
                            <img class="qutes2" src="{{ asset('site/assets/img/qutes1.svg') }}" alt="">
                        </p>
                    </div>


                    <div class="col-lg-6">
                        <div class="content-img" style="height: 100%; width:100%;">

                            @if ($aboutUsHomeFirst && $aboutUsHomeFirst->count() > 0)
                            <img src="{{ asset('site/assets/img/details1.svg') }}" alt="" style="border-radius: 30%">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="detailes">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-img">
                            @if ($aboutUsHomeLast && $aboutUsHomeLast->count() > 0)
                                <img src="{{ asset('assets/images/'.$aboutUsHomeLast->logo) }}" alt="">
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-6">
                            @if ($aboutUsHomeLast && $aboutUsHomeLast->count() > 0)
                                {{ $aboutUsHomeLast->title}}
                            @endif
                        <p class="paragraph">
                            <img class="qutes1" src="{{ asset('site/assets/img/qutes1.svg') }}" alt="">
                            @if ($aboutUsHomeLast && $aboutUsHomeLast->count() > 0)
                                {{ $aboutUsHomeLast->descreption}}
                            @endif

                            <img class="qutes2" src="{{ asset('site/assets/img/qutes1.svg') }}" alt="">
                        </p>
                        <a href="{{ route('galaries') }}">
                            <button class="but1">explore...</button>
                        </a>
                    </div>

                </div>
            </div>
        </div>
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


<!-- end layout -->
@endsection
