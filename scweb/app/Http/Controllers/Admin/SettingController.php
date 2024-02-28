<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Helpers\Helpers;
use Cache;

class SettingController extends Controller
{
    public function settings()
    {
        $data['settings'] = Setting::select('id', 'key', 'value')->get();

        return view('admin.pages.settings.index', $data);
    }

    public function update_settings(Request $request)
    {
        $settings = Setting::updateOrCreate(
            ['key' => 'site_name'],
            ['value' => $request->site_name]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'copyright'],
            ['value' => $request->copyright]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'footer_address'],
            ['value' => $request->footer_address]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'facebook_link'],
            ['value' => $request->facebook_link]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'instagram_link'],
            ['value' => $request->instagram_link]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'linkedin_link'],
            ['value' => $request->linkedin_link]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'twitter_link'],
            ['value' => $request->twitter_link]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'meta_keywords'],
            ['value' => $request->meta_keywords]
        );

        $settings = Setting::updateOrCreate(
            ['key' => 'meta_description'],
            ['value' => $request->meta_description]
        );

        if($request->hasFile('site_logo')){
            
            $previous_logo = Setting::where('key', 'site_logo')->first()->value ?? 'def.png';

            if(file_exists('storage/'.$previous_logo)){
                unlink('storage/'.$previous_logo);
            }

            $image = $request->file('site_logo');
            $imagePath = Helpers::uploadImage($image, 'backend/setting', 'public');
            $settings = Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $imagePath]
            );
        }

        if($request->hasFile('favicon')){
            
            $previous_logo = Setting::where('key', 'favicon')->first()->value ?? 'def.png';

            if(file_exists('storage/'.$previous_logo)){
                unlink('storage/'.$previous_logo);
            }

            $image = $request->file('favicon');
            $imagePath = Helpers::uploadImage($image, 'backend/setting', 'public');
            $settings = Setting::updateOrCreate(
                ['key' => 'favicon'],
                ['value' => $imagePath]
            );
        }

        Cache::forget('settings');

        return back()->with('success', 'Update successfully!');
    }
    //End
}
