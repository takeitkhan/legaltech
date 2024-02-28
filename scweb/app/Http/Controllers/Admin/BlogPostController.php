<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::orderBy('created_at', 'DESC')
            ->with('category')->paginate();

        return view('admin.blog.post.index', compact('blogPosts'));
    }

    public function create()
    {
        $blogCategories = \App\Models\BlogCategory::orderBy('id', 'DESC')->get();
        return view('admin.blog.post.create', compact('blogCategories'));
    }

    public function edit($id)
    {
        $post = BlogPost::find($id);
        $blogCategories = \App\Models\BlogCategory::orderBy('id', 'DESC')->get();
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found');
        }
        return view('admin.blog.post.edit', compact('post', 'blogCategories'));
    }

    public function store(Request $request)
    {        
        $request->validate([
            'title' => 'required|unique:blog_posts,slug',
            'category_id' => 'required'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title')),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'published' => $request->published == 'on' ? 1 : 0,
            'publish_date' => date('Y-m-d H:i:s', strtotime($request->publish_date)),
            'admin_id' => auth('admin')->user()->id,
            'featured_image_caption' => $request->featured_image_caption,
        ];

        $imagePath = null;        
        if($request->hasFile('featured_image')){           
            $image = $request->file('featured_image');
            $imagePath = Helpers::uploadImage($image, 'frontend/blog/', 'public');

            $data['featured_image'] = $imagePath;            
        }
  
        $meta = [
            'meta_title' => $request->meta_title ?? "",
            'meta_description' => $request->meta_description ?? "",
            'meta_keywords' => $request->meta_keywords ?? ""
        ];

        $data['meta'] = json_encode($meta);

        BlogPost::create($data);

        return redirect()->route('admin.blog.posts.index')->with('success', 'Post created successfully');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|unique:blog_posts,title,' . $id,
            'category_id' => 'required'
        ]);

        // dd($request->all());

        $blogPost = BlogPost::find($id);
        if (!$blogPost) {
            return redirect()->route('admin.blog.posts.index')->with('error', 'Blog post not found');
        }

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->input('title')),            
            'category_id' => $request->category_id,
            'body' => $request->body,
            'excerpt' => $request->excerpt,            
            'featured_image_caption' => $request->featured_image_caption,
            'published' => $request->published == 'on' ? 1 : 0,
            'publish_date' => date('Y-m-d H:i:s', strtotime($request->publish_date)),
        ];

        $imagePath = null;        
        if($request->hasFile('featured_image')){   

            if(file_exists('storage/'.$blogPost->featured_image)){
                unlink('storage/'.$blogPost->featured_image);
            }

            $image = $request->file('featured_image');
            $imagePath = Helpers::uploadImage($image, 'frontend/blog/', 'public');

            $data['featured_image'] = $imagePath;            
        }else{
            $data['featured_image'] = $blogPost->featured_image;  
        }

        $meta = [
            'meta_title' => $request->meta_title ?? "",
            'meta_description' => $request->meta_description ?? "",
            'meta_keywords' => $request->meta_keywords ?? "",
            'meta_image' => $blogPost->meta_image() ?? ""
        ];

        if ($request->hasFile('meta_image')) {
            if ($blogPost->meta_image() && file_exists(public_path('/images/blog/meta/' . $blogPost->meta_image()))) {
                unlink(public_path('/images/blog/meta/' . $blogPost->meta_image()));
            }
            $image = $request->file('meta_image');
            $name = 'meta_image-' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/blog/meta/');
            $image->move($destinationPath, $name);
            $meta['meta_image'] = $name;
        }

        $data['meta'] = json_encode($meta);
        $blogPost->update($data);
        //todo: add tags
        // $post->tags()->sync(
        //     $this->collectTags(request('tags'))
        // );

        return redirect()->route('admin.blog.posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Tags incoming from the request.
     *
     * @param  array  $incomingTags
     * @return array
     */
    private function collectTags($incomingTags)
    {
        $allTags = BlogPost::all();

        return collect($incomingTags)->map(function ($incomingTag) use ($allTags) {
            $tag = $allTags->where('id', $incomingTag['id'])->first();

            if (!$tag) {
                $tag = BlogPost::create([
                    'id' => $id = Str::uuid(),
                    'name' => $incomingTag['name'],
                    'slug' => Str::slug($incomingTag['name']),
                ]);
            }

            return (string) $tag->id;
        })->toArray();
    }

    public function delete($id)
    {
       $blog = BlogPost::find($id);

        if(file_exists('storage/'.$blog->featured_image)){
            unlink('storage/'.$blog->featured_image);
        }
        $blog->delete();

        return redirect()->route('admin.blog.posts.index')->with('success', 'Post delete successfully');
        
    }
}