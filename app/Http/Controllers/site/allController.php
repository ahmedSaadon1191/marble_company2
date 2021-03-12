<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\AboutHome;
use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\Product;
use App\Models\ProductImg;
use App\ProductSlidern;
use Illuminate\Support\Facades\App;

class allController extends Controller
{
    public function home()
    {
        $aboutUsHomeFirst = AboutHome::get()->first();
        $aboutUsHomeLast = AboutHome::get()->last();
        $aboutUs = AboutHome::all();
        $top_products = Product::with('productImage')->where('top_product', 1)->take(5)->get();
        // return $top_products
        $contactUs = ContactUs::all();
        //    return $contactUs;
        // return Translatable::getLocales();

        return view('site.pages.home', compact('aboutUsHomeFirst', 'aboutUsHomeLast', 'top_products', 'contactUs','aboutUs'));
    }

    public function aboutUs()
    {
        $aboutUs = AboutUs::all();
        $contactUs = ContactUs::all();
        $top_products = Product::with('productImage')->where('top_product', 1)->take(5)->get();

        // return $aboutUs;
        return view('site.pages.aboutUs', compact('aboutUs', 'contactUs', 'top_products'));
    }

    public function products($id)
    {
        $sliders = ProductSlidern::all();
        $aboutUs = AboutUs::all();
        $contactUs = ContactUs::all();
        if ($id) {
            $singleproduct = Product::find($id);

            $single_product_imgs_code = $singleproduct->productImage;

        }
        $top_products = Product::with('productImage')->where('top_product', 1)->take(5)->get();
        //  return $topproducts = Product::with('productImage')->where('top_product', 1)->take(5)->get();

        return view('site.pages.products', compact('sliders', 'aboutUs', 'contactUs', 'single_product_imgs_code', 'top_products'));
    }

    public function galaries()
    {
        $aboutUs = AboutUs::all();
        $contactUs = ContactUs::all();
        $allproductImgs_code = ProductImg::inRandomOrder()->get();

        return view('site.pages.galaries', compact('aboutUs', 'contactUs', 'allproductImgs_code'));
    }

    public function contactUs()
    {
        $aboutUs = AboutUs::all();
        $contactUs = ContactUs::all();

        // return $aboutUs;
        return view('site.pages.contactUs', compact('aboutUs', 'contactUs'));
    }
}
