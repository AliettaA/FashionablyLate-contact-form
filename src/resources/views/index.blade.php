@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main>
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Contact</h2>
        </div>
        <form class="form" action="/confirm" method="post" novalidate>
            @csrf
            <!-- 名前 -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">お名前</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--flex">
                        <div class="form__input--box">
                            <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                        </div>
                        <div class="form__input--box">
                            <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}" />
                        </div>
                    </div>
                    <div class="form__error--flex">
                        <div class="error__message">
                            @error('last_name') <p class="error__text">{{ $message }}</p> @enderror
                        </div>
                        <div class="error__message">
                            @error('first_name') <p class="error__text">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- 性別 -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">性別</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--flex">
                        <input type="radio" id="1" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}>
                        <label for="male">男性</label>
                        <input type="radio" id="2" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                        <label for="female">女性</label>
                        <input type="radio" id="3" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                        <label for="other">その他</label>
                    </div>
                    <div class="form__error">
                        @error('gender') <p class="error__text">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <!-- email -->
            <div class="form__group">
                <div class="form__label">
                    <span class=" label__item">メールアドレス</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--box">
                        <div class="form__input--flex">
                            <input type="email" name="email" placeholder="test@example.com" value="{{ old('email') }}" />
                        </div>
                    </div>
                    <div class="form__error">
                        @error('email') <p class="error__text">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <!-- tel -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">電話番号</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--group">
                        <div class="form__input--flex">
                            <div class="form__input--box">
                                <input class="input__tel" type="text" name="tel1" value="{{ old('tel1', $contact['tel1'] ?? '') }}" placeholder="090">
                            </div>
                            <span class="tel-hyphen">ー</span>
                            <div class="form__input--box">
                                <input class="input__tel" type="text" name="tel2" placeholder="1234" value="{{ old('tel2', $contact['tel2'] ?? '') }}">
                            </div>
                            <span class="tel-hyphen">ー</span>
                            <div class="form__input--box">
                                <input class="input__tel" type="text" name="tel3" placeholder="5678" value="{{ old('tel3', $contact['tel3'] ?? '') }}">
                            </div>
                        </div>
                        <div class="form__error--flex">
                            <div class="form__error">
                                @error('tel1') <p class="error__text">{{ $message }}</p> @enderror
                            </div>
                            <div class="form__error">
                                @error('tel2') <p class="error__text">{{ $message }}</p> @enderror
                            </div>
                            <div class="form__error">
                                @error('tel3') <p class="error__text">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- address -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">住所</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--box">
                        <div class="form__input--flex">
                            <input class="input__address" type="text" name="address" placeholder="例：東京都世田谷区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
                        </div>
                    </div>
                    <div class="form__error">
                        @error('address') <p class="error__text">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <!-- building -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">建物名</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--box">
                        <div class="form__input--flex">
                            <input class="input__building" type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- お問い合わせの種類 -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">お問い合わせの種類</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--flex">
                        <select name="category_id" id="category_id" class="...">
                            <option value="" selected disabled>選択してください</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__error">
                        @error('category_id') <p class="error__text">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <!-- お問い合わせ -->
            <div class="form__group">
                <div class="form__label">
                    <span class="label__item">お問い合わせ内容</span>
                    <span class="label__required">※</span>
                </div>
                <div class="form__input--content">
                    <div class="form__input--box">
                        <div class="form__input--flex">
                            <textarea class="input__detail" name="detail" placeholder="お問い合わせ内容をご記載ください" value="{{ old('detail') }}"></textarea>
                        </div>
                    </div>
                    <div class="form__error">
                        @error('detail') <p class="error__text">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <!-- 確認ボタン -->
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
</main>
@endsection