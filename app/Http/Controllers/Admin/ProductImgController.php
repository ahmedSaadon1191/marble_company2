<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\ProductImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductImgRequest;

class ProductImgController extends Controller
{


    public function store(ProductImgRequest $request)
    {

        $product = Product::latest()->first()->id;
        // return $request;


        try
        {
            // return $request;
            $ProductImg = ProductImg::create(
            [
                'code_img'      => $request->code_img,
                'color_name'    => ["ar" => $request->color_name_ar, "en" => $request->color_name_en],
                'product_id'    => $product,
                'created_at'    => Carbon::now(),

            ]);



            if ($request->hasFile('tiny_img'))
            {

                $photo                  =  $request->tiny_img->store('tinyImg','public');
                $ProductImg->tiny_img   = $photo;
                $ProductImg->save();
            }

            if ($request->hasFile('max_img'))
            {

                $photo                  =  $request->max_img->store('MaxImg','public');
                $ProductImg->max_img   = $photo;
                $ProductImg->save();
            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }





    public function product_main_imgs()
    {
        return view('admin.pages.products.img_product');
    }

    public function createNewProImg($id)
    {
        $product = Product::find($id);
        return view('admin.pages.products.createImgPro2',compact('product'));
    }

    public function storeNewProImg2(ProductImgRequest $request,$id)
    {
        $product = Product::find($id);
        // return $product;
        // return $product;

        try
        {
            // return $request;
            $ProductImg = ProductImg::create(
            [
                'code_img'      => $request->code_img,
                'color_name'    => ["ar" => $request->color_name_ar, "en" => $request->color_name_en],
                'product_id'    => $product->id,
                'created_at'    => Carbon::now(),

            ]);



            if ($request->hasFile('tiny_img'))
            {

                $photo                  =  $request->tiny_img->store('tinyImg','public');
                $ProductImg->tiny_img   = $photo;
                $ProductImg->save();
            }

            if ($request->hasFile('max_img'))
            {

                $photo                  =  $request->max_img->store('MaxImg','public');
                $ProductImg->max_img   = $photo;
                $ProductImg->save();
            }

            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->route('edit_product_main_imgs',$product->id)->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function editproduct_main_imgs($id)
    {

        $productImgs = ProductImg::with('products')->where('product_id', $id)->get();


        return view('admin.pages.products.edit_img_product', compact('productImgs','id'));

    }

    public function updateproduct_main_imgs(ProductImgRequest $request, $id)
    {
        // return $request;
        // $request->validate(
        //     [
        //         'code_img' => 'required',
        //         'color_name' => 'required',
        //         'tiny_img' => 'nullable',
        //         'max_img' => 'nullable',
        //     ]);

                try
                {
                    $data = ProductImg::with('products')->find($id);


                   if (!$data)
                   {

                   }else
                   {


                    if ($request->hasFile('tiny_img'))
                    {

                        Storage::disk('public')->delete('/assets/images/',$data->tiny_img);
                        $data->tiny_img = $request->tiny_img->store('aboutUs','public');
                        $data->save();
                        $data->update(['tiny_img' => $request->tiny_img->store('tinyImg','public')]);
                    }

                    if ($request->hasFile('max_img'))
                    {
                        Storage::disk('public')->delete('/assets/images/',$data->max_img);
                        $photo =  $request->max_img->store('MaxImg','public');
                        $data->update(['max_img' => $photo]);
                    }

                    $data->update(
                        [
                            'code_img' => $request->code_img,
                            'color_name'    => ["ar" => $request->color_name_ar, "en" => $request->color_name_en],
                            'product_id' => $request->product_id,
                            'created_at' => Carbon::now(),
                        ]);
                        return redirect()->back();
                   }

                } catch (\Throwable $th)
                {
                    return $th;
                }

    }


    public function destroy(ProductImg $productImg)
    {
        //
    }

    public function allProductImg($id)
    {
        $productcontent = Product::find($id);

        $productImgs = ProductImg::where('product_id', $id)->get();
        // return $productImgs;

        return view('admin.pages.gallery_admin.index', compact('productImgs'));
    }

    public function deleteRow($id)
    {
        $proImg = ProductImg::find($id);

        if (!$proImg)
        {
            return response()->json(
                [
                    'status' => false,
                    'msg' => 'هذا الحقل غير موجود',
                ]);
        }else
        {
            $proImg->delete();
            return response()->json(
                [
                    'status' => true,
                    'msg' => 'تم الحزف بنجاح'
                ]);
        }
        // return $proImg;
    }

    public function softDelete()
    {
        $proImg = ProductImg::onlyTrashed()->get();
        return view('admin.pages.products.softDeleteProImg',compact('proImg'));
    }

    public function restore($id)
    {
        $data = ProductImg::withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            }else
            {
                $data->restore();
                toastr()->success(trans('messages.success'));
                return redirect()->back();
            }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('product_main_imgs')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function forceDelete($id)
    {
        $data = ProductImg::withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);

            }else
            {
                Storage::disk('public')->delete('/assets/images/',$data->logo);
                $data->forceDelete();
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('aboutUs.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    //productslider

    // public function productslider()
    // {
    //     return view();
    // }
}
