<ul class="message-list">
    @foreach($messages as $message)
    <li>
        <div>
            {{ $message->user->name }}：{{ $message->created_at }}
            @if($message->user_id == Auth::id())
            <a href="{{ route('messages.edit', $message->id) }}">編集</a>
            @endif
        </div>
        <div>{!! nl2br(e($message->content)) !!}</div>
        
        <!-- Step6：お気に入り登録・解除ボタン -->
        @if (Auth::user()->isLike($message->id))
        <form action="{{ route('likes.destroy') }}" method="post">
            @csrf 
            @method('delete')
            <input type="hidden" name="message_id" value="{{ $message->id }}">
            <button type="submit">イイネ解除</button>
            <!-- Step7オプション課題：イイネした人数 -->
            <a href="{{ route('messages.show', $message->id) }}">{{ $message->likes()->count() }}人</a>がイイネ！と言っています
        </form>
        @else 
        <form action="{{ route('likes.store') }}" method="post">
            @csrf
            <input type="hidden" name="message_id" value="{{ $message->id }}">
            <button type="submit">イイネ！</button>
            <!-- Step7オプション課題：イイネした人数 -->
            <a href="{{ route('messages.show', $message->id) }}">{{ $message->likes()->count() }}人</a>がイイネ！と言っています
        </form>
        @endif
        
    </li>
    @endforeach 
</ul>
{{ $messages->links() }}