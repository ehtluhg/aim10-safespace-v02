<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        return view('admin.settings.index', compact('settings'));
    }

    public function home()
    {
        $settings = Setting::find(1);
        return view('/home', compact('settings'));
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'website_name' => 'required|max:255',
            'website_logo' => 'nullable',
            'website_favicon' => 'nullable',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErros($validator);
        }

        $settings = Setting::where('id', '1')->first();
        if ($settings) {
            $settings->website_name = $request->website_name;

            if ($request->hasfile('website_logo')) {
                $destination = 'uploads/settings/' . $settings->logo;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('website_logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $settings->logo = $filename;
            }

            if ($request->hasfile('website_favicon')) {
                $destination = 'uploads/settings/' . $settings->favicon;
                if (File::exists($destination)) {
                    File::delete($destination);
                }

                $file = $request->file('website_favicon');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $settings->favicon = $filename;
            }

            $settings->description = $request->description;
            $settings->save();

            return redirect('admin/settings')->with('message', 'Settings Updated Successfully!');
        } else {
            $settings = new Setting;
            $settings->website_name = $request->website_name;

            if ($request->hasfile('website_logo')) {
                $file = $request->file('website_logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $settings->logo = $filename;
            }

            if ($request->hasfile('website_favicon')) {
                $file = $request->file('website_favicon');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move('uploads/settings/', $filename);
                $settings->favicon = $filename;
            }

            $settings->description = $request->description;
            $settings->save();

            return redirect('admin/settings')->with('message', 'Settings Added Successfully!');
        }
    }
}
