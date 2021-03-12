@extends('site.layouts.app')

@section('content')
<!-- start layout -->
<div class="aboutimg1" style="background-image: url({{ asset('/assets/images/'.$aboutUs->first()->logo) }})">
    <img class="overlayimg" src="{{ asset('site/assets/img/aboutoverlay.svg') }}" alt="">
    <h1>
        <span>A</span> bout <br>
        Us <span>..</span>
    </h1>
    <p>
        <img class="qutes1" src="{{ asset('site/assets/img/qutes2.svg') }}" alt="">
        {{ $aboutUs->last()->descreption }}
        <img class="qutes2" src="img/qutes2.svg" alt="">
    </p>
    <div class="overlay">
    </div>
</div>

@if ($aboutUs && $aboutUs->count() > 0)
<div class="aboutimg2 row" style="background-image: url({{ asset('/assets/images/'.$aboutUs->last()->logo) }})">
    <div class="col-lg-5 text-center">
        <img class="aboutlogowhie" src="img/aboutlogowhit.svg" alt="">
    </div>
    <div class="col-lg-7">
        <p>
            <img class="qutes1" src="img/qutes2.svg" alt="">
            {{ $aboutUs->last()->descreption }}
            <img class="qutes2" src="img/qutes2.svg" alt="">
        </p>
    </div>
    <div class="overlay">
    </div>
</div>
@endif

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
<!-- end layout -->

@endsection
