<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
    <header>
        <div class="container">
            <a class="brand" href="/">{{ config('app.name') }}</a>
            @if(Auth::check())
            <ul class="navigation">
                <li><a href="{{ route('home') }}">マイページ</a></li>
                <li><a href="{{ route('messages.index') }}">みんなの投稿</a></li>
                <li>
                    <a href="#" onclick="logout()">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                    <script>
                        function logout() {
                            event.preventDefault();
                            if (window.confirm('ログアウトしますか？')) {
                                document.getElementById('logout-form').submit();
                            }
                        }
                    </script>
                </li>
            </ul>
            @endif
        </div>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>