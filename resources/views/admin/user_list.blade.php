@extends('admin.layout')

@section('title')管理画面 ユーザ一覧@endsection

{{-- メインコンテンツ --}}

@section('contents')
    <h1>ユーザ一覧</h1>
    <table border="1">
        <tr>
            <th>ユーザID
            <th>ユーザ名
            <th>購入した「買うもの」の数
        </tr>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}
            <td>{{$user->name}}
            <td>{{$user->shopping_num}}
        </tr>
    @endforeach
    </table>
@endsection