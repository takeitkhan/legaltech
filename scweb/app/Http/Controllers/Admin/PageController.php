<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Models\Page;
use App\Models\Contact;
use Cache;

class PageController extends Controller
{
    public function home()
    {
        $data['home_page'] = Page::where('page_name', 'home')->first();
        return view('admin.pages.home.index', $data);
    }

    public function about(Request $request)
    {
        $data['about_page'] = Page::where('page_name', 'about')->first();
        return view('admin.pages.about.index', $data);
    }


    public function update(Request $request)
    {
        //FIXME Validation
        $home_page = Page::where('page_name', 'home')->first();
        
        //FIXME
        $imagePath = null;
        
        if($request->hasFile('hero_image')){

            if(file_exists('storage/'.$home_page->hero_image)){
                unlink('storage/'.$home_page->hero_image);
            }

            $image = $request->file('hero_image');
            $imagePath = Helpers::uploadImage($image, 'frontend/home/', 'public');
            
        }else{
            $imagePath = $home_page->hero_image;
        }

        if($request->page_name == 'home'){            
            Page::updateOrCreate(
                ['page_name' => $request->page_name],
                [
                    'hero_title' => $request->hero_title,
                    'hero_subtitle' => $request->hero_subtitle,
                    'statistic_one_number' => $request->statistic_one_number,
                    'statistic_one_title' => $request->statistic_one_title,
                    'statistic_two_number' => $request->statistic_two_number,
                    'statistic_two_title' => $request->statistic_two_title,
                    'statistic_three_number' => $request->statistic_three_number,
                    'statistic_three_title' => $request->statistic_three_title,
                    'statistic_four_number' => $request->statistic_four_number,
                    'statistic_four_title' => $request->statistic_four_title,
                    'hero_image' => $imagePath
                ]
            );
        }else if($request->page_name == 'about'){
            Page::updateOrCreate(
                ['page_name' => $request->page_name],
                [
                    'description' => $request->description,                   
                ]
            );
        }
            
        Cache::forget('home_page');
        Cache::forget('about_page');

        return back()->with('success','Update successfully!');

    }

    public function contact_list()
    {
        $data['contacts'] = Contact::orderBy('id', 'DESC')->simplePaginate();
        return view('admin.pages.contact.list', $data);
    }

    public function is_replied(Request $request)
    {
        Contact::where('id', $request->id)->update(['is_replied' => $request->value ? 0 : 1]);
        return back()->with('success','Update successfully!');
    }
    //End
}
