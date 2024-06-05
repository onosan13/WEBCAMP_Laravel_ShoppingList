@extends('layout')

@section('title')購入済みリスト@endsection

{{--メインコンテンツ--}}

@section('contents')
        <h1>購入済み「買うもの」一覧</h1>

        <a href="/shopping_list/list">「買うもの」一覧に戻る</a>
        <table border="1">
            <tr>
                <th>「買うもの」名
                <th>購入日
            </tr>
            @foreach($comp_lists as $list)
            <tr>
                <td>{{ $list->name }}
                <td>{{ $list->created_at->format('Y/m/d') }}
            </tr>
            @endforeach
        </table>
        現在{{$comp_lists->currentPage()}}ページ目<br>
        @if(!$comp_lists->onFirstPage())
            <a href="/shopping_list/list">最初のページ</a>
        @else
            最初のページ
        @endif
        /
        @if($comp_lists->previousPageUrl() !== null)
            <a href="{{$comp_lists->previousPageUrl()}}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if($comp_lists->nextPageUrl() !== null)
            <a href="{{$comp_lists->nextPageUrl()}}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
        <menu>
            <a href="/logout">ログアウト</a>
        </menu>
@endsection