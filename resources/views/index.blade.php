@extends('layout')

@section('title')ログイン画面@endsection

{{-- メインコンテンツ --}}

@section('contents')
    <h1>ログイン</h1>

    @if($errors->any())
        <div>
          @foreach($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
    @endif
        @if(session('user.index.success') == true)
        ユーザを登録しました！！<br>
    @endif
    <form action="/login" method="post">
        @csrf
        email: <input name="email" type="email"><br>
        パスワード: <input name="password" type="password"><br>
        <button>ログインする</button><br>
    </form>
    <a href="/user/register">会員登録</a>
@endsection