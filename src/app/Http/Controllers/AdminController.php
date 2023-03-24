<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputData;
use App\Models\Content;
use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        $contents = Content::all();
        return view('admin.index', compact('languages', 'contents'));
    }
    public function content_change(Request $request)
    {
        $contents = Content::find($request->content_id);
        $contents->fill(['is_modal' => $request->content_display, 'name'=> $request->content_name])->save();
        return redirect("webapp/admin/home");
    }

    public function language_change(Request $request)
    {
        $languages = Language::find($request->language_id);
        $languages->fill(['is_modal' => $request->language_display, 'name'=> $request->language_name])->save();
        return redirect("webapp/admin/home");
    }
    public function content_add(Request $request)
    {
        $contents = new Content();
        $contents->fill(['is_modal' => $request->content_display, 'name'=> $request->content_name])->save();
        return redirect("webapp/admin/home");
    }
    public function language_add(Request $request)
    {
        $languages = new Language();
        $languages->fill(['is_modal' => $request->language_display, 'name'=> $request->language_name])->save();
        return redirect("webapp/admin/home");
    }
    
    // ==================================================
    
    public function user_index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }
    public function user_add(Request $request)
    {
        $user = new User();
        $user->fill(['name' => $request->user_name, 'email'=> $request->user_email, 'is_admin'=>$request->is_admin_new, 'password'=>Hash::make('password')])->save();
        return redirect("webapp/admin/home/user");
    }

}
