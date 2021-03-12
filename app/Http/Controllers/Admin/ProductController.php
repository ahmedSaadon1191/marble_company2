<?php
namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsReques;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {

        $products = Product::all();
        // $productImgs = ProductImg::all();

        return view('admin.pages.products.products', compact('products'));

    }

    public function create()
    {
        // $colors = Color::all();
        $categories = Category::all();

        return view('admin.pages.products.create', compact('categories'));
    }

    public function store(ProductsReques $request)
    {

        if (Product::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->withErrors('اسم الحقل موجود بالفعل ');
        }

        $request->validate(
            [
                'name_ar' => 'required|unique:categories,name->ar',
                'name_en' => 'required|unique:categories,name->en',
            ]);

        try {
            $product = Product::create(
                [
                    'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                    'created_at' => Carbon::now(),
                    'top_product' => $request->top_product,
                ]);

            $product->categories()->attach($request->category_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('product_main_imgs');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {

        $product = Product::with('categories')->find($id);
        $categories = Category::all();

        return view('admin.pages.products.edit', compact('product', 'categories'));

    }

    public function update(ProductsReques $request, $id)
    {

        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar',
            'name_en' => 'required|unique:categories,name->en',
        ]);

        try {
            $product = Product::find($request->id)->update([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],
                'created_at' => Carbon::now(),
                'top_product' => $request->top_product,
            ]);
            $post = Product::findOrFail($request->id);
            $postId = $post->id;

            $post->categories()->sync($request->category_id);

            toastr()->success(trans('messages.success'));
            return redirect()->route('edit_product_main_imgs', $postId); //product_id
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }



    public function softDelete()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.pages.products.softDelete',compact('products'));
    }

    public function destroy($id)
    {
        $product = Product::with('productImage')->find($id);
        // return $product;
        try
        {
                if (!$product)
                {
                    return redirect()->back()->withErrors(['error' => $e->getMessage()]);
                }else
                {
                    $deleteImages = $product->productImage()->delete();
                    $delete = $product->delete();
                    session()->flash('Delete_Succesfully');
                    toastr()->error(trans('messages.Delete'));
                    return redirect()->back();
                }

        } catch (\Throwable $th)
        {
            // return $th;
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function restore($id)
    {
        $data = Product::with('productImage')->withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                return redirect()->route('products.index')->withErrors(['error' => $e->getMessage()]);

            }else
            {
                $data->productImage()->restore();
                $data->restore();
                toastr()->success(trans('messages.success'));
                return redirect()->route('products.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('products.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function forceDelete($id)
    {
        $product = Product::onlyTrashed()->with('productImage')->find($id);

        // return $product;

        foreach ($product->productImage as $pro)
        {
            if (isset($pro) && $pro->count() > 0)
            {
                Storage::disk('public')->delete('/assets/images/',$product->productImage->tiny_img);
                Storage::disk('public')->delete('/assets/images/',$product->productImage->max_img);
            }
        }

        $product->productImage()->forceDelete();
        $product->forceDelete();
        return \redirect()->back()->with(['success' => 'تم حزف الاوردر بنجاح']);
    }

    
}
