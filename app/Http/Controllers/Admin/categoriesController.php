<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class categoriesController extends Controller
{


    public function index()
    {
        $categories = Category::all();

        return view('admin.pages.category.index', compact('categories'));
    }


    public function store(Request $request)
    {

        if (Category::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->withErrors('اسم الحقل موجود بالفعل ');
        }

        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar',
            'name_en' => 'required|unique:categories,name->en',
        ]);
        try {
            $category = Category::create([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],

                'created_at' => Carbon::now(),
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function update(Request $request, $id)
    {
        if (Category::where('name->ar', $request->name_ar)->orWhere('name->en', $request->name_en)->exists()) {

            return redirect()->back()->withErrors('اسم الحقل موجود بالفعل ');
        }

        $request->validate([
            'name_ar' => 'required|unique:categories,name->ar',
            'name_en' => 'required|unique:categories,name->en',
        ]);
        try {
            $category = Category::findOrFail($request->id)->update([
                'name' => ["en" => $request->name_en, "ar" => $request->name_ar],

                'created_at' => Carbon::now(),
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('Categories.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy($id)
    {
        $data = Category::find($id);

        // return $id;
        try
        {
            if (!$data)
            {
                return redirect()->route('Categories.index');

            }else
            {
                $data->delete();
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('Categories.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('Categories.index');
        }
    }


    public function softDelete()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.pages.category.softDelete',compact('categories'));
    }

    public function restore($id)
    {
        $data = Category::withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                return redirect()->route('Categories.index')->withErrors(['error' => $e->getMessage()]);

            }else
            {
                $data->restore();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Categories.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('Categories.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function forceDelete($id)
    {
        $data = Category::withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                return redirect()->route('Categories.index')->withErrors(['error' => $e->getMessage()]);

            }else
            {
                Storage::disk('public')->delete('/assets/images/',$data->logo);
                $data->forceDelete();
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('Categories.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            return redirect()->route('Categories.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

}
