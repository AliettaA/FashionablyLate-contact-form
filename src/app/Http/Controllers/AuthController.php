<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function login()
    {
        return view('auth.login');
    }

    public function admin(Request $request)
    {
        $query = Contact::query()->with('category');
        if ($request->filled('keyword')) {
        $query->where(function($q) use ($request) {
            $q->where('last_name', 'like', '%' . $request->keyword . '%')
            ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
            ->orWhere('email', 'like', '%' . $request->keyword . '%')
            ->orWhere(\Illuminate\Support\Facades\DB::raw('CONCAT(last_name, first_name)'), 'like', '%' . str_replace([' ', '　'], '', $request->keyword) . '%');
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }


    public function export(Request $request)
    {
        // 1. 検索条件を再現（indexと同じクエリを作る）
        $query = Contact::query()->with('category');

        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('last_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                    ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        }
        if ($request->filled('gender')) $query->where('gender', $request->gender);
        if ($request->filled('category_id')) $query->where('category_id', $request->category_id);
        if ($request->filled('date')) $query->whereDate('created_at', $request->date);

        $contacts = $query->get(); // 全件取得

        // 2. CSVデータの作成
        $csvHeader = ['お名前', '性別', 'メールアドレス', 'お問い合わせの種類', 'お問い合わせ内容'];
        $csvData = [];

        foreach ($contacts as $contact) {
            $gender = $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他');
            $csvData[] = [
                $contact->last_name . ' ' . $contact->first_name,
                $gender,
                $contact->email,
                $contact->category->content,
                $contact->detail,
            ];
        }

        // 3. レスポンス生成（ダウンロード実行）
        $response = new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $csvHeader);
            foreach ($csvData as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_' . date('Ymd') . '.csv"',
        ]);

        return $response;
    }

    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('success', 'お問い合わせを削除しました');
    }
}