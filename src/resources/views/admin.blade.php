@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<main>
    <!-- header -->
    <div class="admin__content">
        <div class="admin__heading">
            <h2>Admin</h2>
        </div>
        <!-- search-bar -->
        <form class="search-form" action="/search" method="get">
            <div class="search-form__inner">
                <div class="input__name">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder=" 名前やメールアドレスを入力してください">
                </div>
                <div class="input__gender">
                    <select name="gender" class="select__gender">
                        <option value="">性別</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="input__kinds">
                    <select name="category_id" class="select__kinds">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input__date">
                    <input type="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="search-form__button">
                    <button type="submit">検索</button>
                </div>
                <div class="search-form__reset">
                    <a href="/reset">リセット</a>
                </div>
            </div>
        </form>
        <!-- pagination -->
        <div class="tool-bar">
            <div class="export__button">
                <a href="{{ url('/admin/export') . '?' . http_build_query(request()->query()) }}" class="export__button-submit">
                    エクスポート
                </a>
            </div>
            <div class="pagination">
                <div class="custom__pagination">
                    {{ $contacts->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        <!-- contact-table -->
        <div class="contact-table">
            <table class="contact-table__inner">
                {{-- ヘッダー行：class指定を修正 --}}
                <tr class="contact-table__title">
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th> {{-- 詳細ボタン用の列を確保 --}}
                </tr>

                @foreach ($contacts as $contact)
                <tr class="contact-table__row">
                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>

                    {{-- ★重要：ボタンは必ず <td> の中に入れる --}}
                    <td>
                        <button class="detail-button" onclick="openModal('{{ $contact->id }}')">詳細</button>

                        {{-- ★重要：モーダルの塊も <td> の中に入れてしまいます --}}
                        <div id="modal-{{ $contact->id }}" class="modal-overlay" style="display: none;">
                            <div class="modal-inner">
                                <button type="button" class="modal-close" onclick="closeModal('{{ $contact->id }}')">×</button>
                                <div class="modal-content">
                                    <table class="modal-table">
                                        <tr>
                                            <th>お名前</th>
                                            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>性別</th>
                                            <td>{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</td>
                                        </tr>
                                        <tr>
                                            <th>メールアドレス</th>
                                            <td>{{ $contact->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>電話番号</th>
                                            <td>{{ $contact->tel }}</td>
                                        </tr>
                                        <tr>
                                            <th>住所</th>
                                            <td>{{ $contact->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>建物名</th>
                                            <td>{{ $contact->building }}</td>
                                        </tr>
                                        <tr>
                                            <th>お問い合わせの種類</th>
                                            <td>{{ $contact->category->content }}</td>
                                        </tr>
                                        <tr>
                                            <th>お問い合わせ内容</th>
                                            <td>{{ $contact->detail }}</td>
                                        </tr>
                                        <form class="delete-form" action="/delete" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $contact->id }}">
                                            <button type="submit" class="delete-button">削除</button>
                                        </form>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    </div>
</main>
<script>
    function openModal(id) {
        console.log('Opening modal for ID:', id); // デバッグ用：コンソールにログを出す
        const modal = document.getElementById('modal-' + id);
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeModal(id) {
        const modal = document.getElementById('modal-' + id);
        if (modal) {
            modal.style.display = 'none';
        }
    }
</script>
@endsection