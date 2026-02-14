<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view ('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        $category = Category::find($request->category_id);
        $contact['category_content'] = $category ? $category->content : '未選択';
        $contact['category_id'] = $request->category_id;
        $contact['fullname'] = $request->last_name . ' ' . $request->first_name;
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        return view('confirm', compact('contact'));
    }

    public function store(Request $request)
    {
        $contact = $request->only([
            'category_id',
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'detail'
        ]);
        $contact['tel'] = $request->tel1 . $request->tel2 . $request->tel3;
        Contact::create($contact);
        return redirect('/thanks');
    }
}
