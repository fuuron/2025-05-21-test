@extends('layouts.app')

@section('content')
<h1>マイページ</h1>

<!-- Step3：値の検証（フラッシュメッセージを表示） -->
@include('commons.flash')

<form action="{{ route('messages.store') }}" method="post">
    @csrf 
    <p>
        <textarea name="content" rows="3" placeholder="メッセージを入力"></textarea>
    </p>
    <p>
        <button type="submit">投稿する</button>
    </p>
</form>

@include('commons.messages')
@endsection