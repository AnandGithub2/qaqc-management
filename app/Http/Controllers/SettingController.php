<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {

        $setting = Setting::first();

        return view(
            'settings.index',
            compact('setting')
        );

    }



    public function store(Request $request)
    {

        $request->validate([

            'company_name'=>'required'

        ]);


        $setting = Setting::first();

        if(!$setting){

            $setting = new Setting();

        }


        $setting->company_name = $request->company_name;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->website = $request->website;
        $setting->gst_number = $request->gst_number;
        $setting->address = $request->address;
        $setting->city = $request->city;
        $setting->state = $request->state;
        $setting->country = $request->country;
        $setting->pincode = $request->pincode;
        $setting->footer_text = $request->footer_text;

        if($request->hasFile('company_logo')){

            $logo = $request
                ->file('company_logo')
                ->store('logos','public');

            $setting->company_logo = $logo;

        }

        $setting->save();

        return back()->with(
            'success',
            'Settings Saved Successfully'
        );

    }

}