<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    public function index()
    {
        // $contacts = Contact::with('category')->paginate(7);

        // return view('admin', compact('contacts'));
        return view ('index');
    }

    // 削除処理
    // public function destroy(Request $request)
    // {
    //     Contact::find($request->id)->delete();
    //     return redirect('/admin');
    // }
}
