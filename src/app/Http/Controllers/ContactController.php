<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view ('index', compact('categories'));
    }

    public function confirm(Request $request)
    {
        $contact = $request->all();
        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '未選択';
        $contact['fullname'] = $request->first_name . ' ' . $request->last_name;
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        // Contact::create($request->all());
        return redirect('/thanks');

    }

    public function register()
    {
        return view('auth.register');
    }
}

