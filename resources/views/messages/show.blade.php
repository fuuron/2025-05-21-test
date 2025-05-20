@extends('layouts.app')

@section('content')
<!-- Step8オプション課題 -->
<h1>メッセージ詳細</h1>

<dl>
    <dt>投稿者</dt>
    <dd>{{ $message->user->name }}</dd>
    <dt>本文</dt>
    <dd>{!! nl2br(e($message->content)) !!}</dd>
    <dt>イイネ！した人</dt>
    <dd>
        <ul>
            @foreach($message->likeUsers as $user)
            <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </dd>
</dl>


@endsection