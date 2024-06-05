@extends('layout')

@section('title')買うものリスト@endsection

{{--メインコンテンツ--}}

@section('contents')
        <h1>「買うもの」登録</h1>
        @if($errors->any())
            <div>
            @foreach($errors->all() as $error)
                {{$error}}<br>
            @endforeach
            </div>
        @endif
        @if(session('list_register_success') == true)
            「買うもの」を登録しました！！<br>
        @endif
        @if(session('shopping_list_delete') == true)
            「買うもの」を削除しました！！<br>
        @endif
        @if(session('shopping_complete_succes') == true)
            「買うもの」を完了しました！！<br>
        @endif
        @if(session('shopping_complete_false') == true)
            「買うもの」を完了に失敗しました。<br>
        @endif
        <form action="/shopping_list/register" method="post">
            @csrf
            「買うもの」名: <input name="name"><br>
            <button>「買うもの」を登録する</button>
        </form>
        <h1>「買うもの」一覧</h1>
        <a href="/completed_shopping_list/list">購入済み「買うもの」一覧</a>
        <table border="1">
            <tr>
                <th>登録日
                <th>「買うもの」名
            </tr>
            @foreach($lists as $list)
            <tr>
                <td>{{ $list->created_at->format('Y/m/d') }}
                <td>{{ $list->name }}
                <td>
                    <form action="{{route('complete', ['shopping_list_id'=>$list->id])}}" method="post">
                        @csrf
                        <button onclick='return confirm("この「買うもの」を完了します。よろしいですか？");'>完了</button>
                    </form>
                </td>
                <td>
                    <form action="{{route('delete', ['shopping_list_id'=>$list->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick='return confirm("この「買うもの」を削除します。よろしいですか？");'>削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        現在{{$lists->currentPage()}}ページ目<br>
        @if(!$lists->onFirstPage())
            <a href="/shopping_list/list">最初のページ</a>
        @else
            最初のページ
        @endif
        /
        @if($lists->previousPageUrl() !== null)
            <a href="{{$lists->previousPageUrl()}}">前に戻る</a>
        @else
            前に戻る
        @endif
        /
        @if($lists->nextPageUrl() !== null)
            <a href="{{$lists->nextPageUrl()}}">次に進む</a>
        @else
            次に進む
        @endif
        <br>
        <hr>
        <menu>
            <a href="/logout">ログアウト</a>
        </menu>
@endsection