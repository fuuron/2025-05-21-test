<!-- resources/views/auth/verify-email.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>メール確認</title>
</head>
<body>
    <h1>メールアドレスを確認してください</h1>

    <p>確認メールを送信しました。メールに記載されたリンクをクリックして認証を完了してください。</p>

    @if (session('status') == 'verification-link-sent')
        <p style="color: green;">新しい確認リンクを送信しました。</p>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">確認メールを再送信</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>
</body>
</html>
