<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helpers;
use App\Models\Member;

class MemberController extends Controller
{
    public function index(){
        $members = Member::simplePaginate();
        return view('admin.member.index', compact('members'));
    }

    public function create(){
        return view('admin.member.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member = new Member();
        $member->name = $request->name;
        $member->content = $request->content;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = Helpers::uploadImage($image, 'frontend/member/', 'public');

            $member->image = $imagePath;
        }

        $member->save();
        return redirect()->route('admin.members.index')->with('success', 'Member added successfully');
    }


    public function edit(Member $member){
        return view('admin.member.edit', compact('member'));
    }

    public function update(Request $request, Member $member){
        $request->validate([
            'name' => 'required|max:255',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member->name = $request->name;
        $member->content = $request->content;

        $previous_image = $member->image;

        if($request->hasFile('image')){

            if(file_exists('storage/'.$previous_image)){
                unlink('storage/'.$previous_image);
            }

            $image = $request->file('image');
            $imagePath = Helpers::uploadImage($image, 'frontend/member/', 'public');

            $member->image = $imagePath;
        }else{
            $member->image = $previous_image;
        }

        $member->save();
        return redirect()->route('admin.members.index')->with('success', 'Member updated successfully');
    }


    public function delete(Member $member)
    {
        if(file_exists('storage/'.$member->image)){
            unlink('storage/'.$member->image);
        }
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member delete successfully!');
    }
}
