<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\Contact;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.home');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function services()
    {
        return view('frontend.pages.services');
    }

    public function blogs()
    {
        $data['categories'] = BlogCategory::orderBy('title', 'ASC')->get();

        $query = BlogPost::with('category')
            ->where('published', 1)
            ->orderBy('created_at', 'DESC');

        /**
         * If the request has title then we will filter the blogs by category
         * Slug receive as title frontend security purpose
         */
        if(request()->has('title')){
            $slug = request()->title;
            $category_id = BlogCategory::where('slug', $slug)->first()->id;
            $query = $query->where('category_id', $category_id);
        }        

        $data['blogs'] = $query->simplePaginate(10);

        return view('frontend.pages.blogs.index', $data);
    }

    public function blog_view($slug)
    {
        $data['categories'] = BlogCategory::orderBy('title', 'ASC')->get();

        $data['blog'] = BlogPost::with('category')
        ->where('slug', $slug)
        ->first();

    return view('frontend.pages.blogs.single-view', $data);
    }

    public function team()
    {
        return view('frontend.pages.team');
    }

    public function contact_submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:11|max:14',
            'details' => 'required',
            'accept' => 'required',
        ]);

        if($validated['accept'] != 'on'){
            return redirect()->back()->with('error', 'Please accept our terms and conditions');
        }

        Contact::create($validated);

        return redirect()->back()->with('success', 'We received your message. We will contact with you very soon!');
    }


    //End
}
