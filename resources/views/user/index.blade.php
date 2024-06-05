@extends('layout')

@section('title')会員登録画面@endsection

{{-- メインコンテンツ --}}

@section('contents')
    <h1>ユーザ登録</h1>

    @if($errors->any())
        <div>
          @foreach($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
    @endif
    @if(session('user.index.password') == true)
        パスワードの入力が間違っています。<br>
    @endif
    <form action="/user/register" method="post">
        @csrf
        名前: <input name="name" value="{{ old('name') }}"><br>
        email: <input name="email" type="email" value="{{ old('email') }}"><br>
        パスワード: <input name="password" type="password"><br>
        パスワード(再度): <input name="password_c" type="password"><br>
        <button>登録する</button><br>
    </form>
@endsection