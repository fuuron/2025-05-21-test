@extends('layouts.app')

@section('content')
<h1>メッセージ編集</h1>

<!-- Step3：値の検証（フラッシュメッセージを表示） -->
@include('commons.flash')

<form action="{{ route('messages.update', $message->id) }}" method="post">
    @csrf 
    @method('patch')
    <p>
        <textarea name="content" rows="3" placeholder="メッセージを入力">{{ old('content', $message->content) }}</textarea>
    </p>
    <p>
        <button type="submit">更新する</button>
        <a href="{{ route('home') }}">キャンセル</a>
    </p>
    
</form>

<form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('messages.destroy', $message->id) }}" method="post">
    @csrf 
    @method('delete')
    <button type="submit">削除</button>
</form>
@endsection