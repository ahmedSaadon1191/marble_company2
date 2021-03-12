<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangePasswordRequest;

class adminsController extends Controller
{
    public function index()
    {
        $admin = User::all();
        return view('admin.pages.admin.index',compact('admin'));
    }

    public function edit($id)
    {
        $admin = User::find($id);
        return view('admin.pages.admin.edit',compact('admin'));
    }

    public function update(Request $request,$id)
    {
        $admin = User::find($id);
        try
        {
            if (!$admin)
            {
                session()->flash('Delete_Succesfully');
                toastr()->error(trans('messages.Delete'));
                return redirect()->route('admin.index');
            }else
            {
            DB::beginTransaction();
            $update = $admin->update(
                    [
                        'name'  => $request->name,
                        'email' => $request->email,
                    ]);


                    // CHECK LOGO
                    if ($request->hasFile('logo'))
                    {
                        Storage::disk('public')->delete('/assets/images/',$admin->logo);
                        $photo =  $request->logo->store('admin','public');
                        $admin->update(['logo' => $photo]);
                    }
                DB::commit();

                toastr()->success(trans('messages.success'));
                return redirect()->route('admin.index');
            }
        } catch (\Throwable $th)
        {
            DB::rollback();
            return $th;

            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('admin.index');
        }
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        if (!$admin)
        {
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('admin.index');
        }else
        {
            $admin->delete();
            toastr()->success(trans('messages.success'));
            return redirect()->route('admin.index');
        }

    }

    public function softDelete()
    {
        $admin = User::onlyTrashed()->get();
        return view('admin.pages.admin.softDelete',compact('admin'));
    }

    public function restore($id)
    {
        $admin = User::withTrashed()->find($id);
        // return $admin;
        try
        {
            if (!$admin)
            {
                session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
                return redirect()->route('admin.index');

            }else
            {
                $admin->restore();
                toastr()->success(trans('messages.success'));
                return redirect()->route('admin.index');
            }

        } catch (\Throwable $th)
        {
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('admin.index');
        }
    }

    public function profile()
    {
        $admin = auth()->user();
        return view('admin.pages.admin.profile',compact('admin'));
    }

    public function profileUpdate(Request $request)
    {

        $admin_id= auth()->user()->id;
        $admin = auth()->user();
        // return $admin->password;
        try
        {
            DB::beginTransaction();
            $update = $admin->update(
                    [
                        'name'  => $request->name,
                        'email' => $request->email,
                    ]);


                    // CHECK LOGO
                    if ($request->hasFile('logo'))
                    {
                        Storage::disk('public')->delete('/assets/images/',$admin->logo);
                        $photo =  $request->logo->store('admin','public');
                        $admin->update(['logo' => $photo]);
                    }
                DB::commit();
                    toastr()->success(trans('messages.success'));
                    return \redirect()->route('admin.index');

        } catch (\Throwable $th)
        {
            DB::rollback();
            return $th;
            session()->flash('Delete_Succesfully');
            toastr()->error(trans('messages.Delete'));
             return \redirect()->route('admin.index');
        }
    }

    public function setting()
    {
        $admin = auth()->user();
        return view('admin.pages.admin.changePassword',compact('admin'));
    }

    public function changePasswordUpdate(ChangePasswordRequest $request)
    {
    //   return $request;
      $admin_id= auth()->user()->id;
      $admin = auth()->user();

     try
     {
        $update = $admin->update(
            [
                'password' => \bcrypt($request->new_password)
            ]);
            toastr()->success(trans('messages.success'));
            return \redirect()->route('admin.index');


     } catch (\Throwable $th)
     {
        session()->flash('Delete_Succesfully');
        toastr()->error(trans('messages.Delete'));
          return \redirect()->route('admin.index');
     }
    }


}
