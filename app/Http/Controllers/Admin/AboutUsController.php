<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUsRequest;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AboutUsController extends Controller
{
    public function index()
    {
        // return LaravelLocalization::getCurrentLocale();
        $aboutUs = AboutUs::all();
        return view('admin.pages.aboutUs.index',compact('aboutUs'));
    }

    public function store(AboutUsRequest $request)
    {

        try
        {
            DB::beginTransaction();

                $create = AboutUs::create(
                    [
                        'descreption'           => ["en" => $request->descreption_en, "ar"  => $request->descreption_ar],
                    ]);

                // CHECK LOGO
                if ($request->hasFile('logo'))
                {
                    $photo =  $request->logo->store('aboutUs','public');
                    $create->logo = $photo;
                    $create->save();
                }
            DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->route('aboutUs.index');
        } catch (\Throwable $th)
        {
            DB::rollback();
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('aboutUs.index');
        }
    }

    public function update(AboutUsRequest $request,$id)
    {
        $data = AboutUs::find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('aboutUs.index');

            }else
            {
                DB::beginTransaction();
                    $update = $data->update(
                        [
                            'descreption'           => ["en" => $request->descreption_en, "ar"  => $request->descreption_ar],
                        ]);

                    // CHECK LOGO
                    if ($request->hasFile('logo'))
                    {
                        Storage::disk('public')->delete('/assets/images/',$data->logo);
                        $photo =  $request->logo->store('aboutUs','public');
                        $data->update(['logo' => $photo]);
                    }
                DB::commit();

                toastr()->success(trans('messages.success'));
                return redirect()->route('aboutUs.index');
            }

        } catch (\Throwable $th)
        {
            DB::rollback();
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('aboutUs.index');
        }
    }

    public function destroy($id)
    {
        $data = AboutUs::find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('aboutUs.index');

            }else
            {
                $data->delete();
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('aboutUs.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('aboutUs.index');
        }
    }

    public function softDelete()
    {
        $aboutUs = AboutUs::onlyTrashed()->get();
        return view('admin.pages.aboutUs.softDelete',compact('aboutUs'));
    }

    public function restore($id)
    {
        $data = AboutUs::withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
                return redirect()->route('aboutUs.index');

            }else
            {
                $data->restore();
                toastr()->success(trans('messages.success'));
                return redirect()->route('aboutUs.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('aboutUs.index');
        }
    }

    public function forceDelete($id)
    {
        $data = AboutUs::withTrashed()->find($id);
        // return $data;
        try
        {
            if (!$data)
            {
                session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
                return redirect()->route('aboutUs.index');

            }else
            {
                Storage::disk('public')->delete('/assets/images/',$data->logo);
                $data->forceDelete();
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('aboutUs.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('aboutUs.index');
        }
    }
}
