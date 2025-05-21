<!-- .env -->
APP_NAME=掲示板アプリ
APP_ENV=local
APP_KEY=example
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=example
DB_PORT=example
DB_DATABASE=example
DB_USERNAME=example
DB_PASSWORD=example

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=example@gmail.com
MAIL_PASSWORD=example
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="example@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"


php artisan key:generate --show


<!-- email verify -->
https://laratech.jp/posts/fortify-emailverification/


<!-- routes/web -->
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});


<!-- App\Models\User -->
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail


<!-- App\Providers\FortifyServiceProvider の boot() メソッド -->
use Laravel\Fortify\Contracts\VerifyEmailViewResponse;
use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;

public function boot()
{
    // 他の設定があってもOK

    $this->app->singleton(VerifyEmailViewResponse::class, function () {
        return new class implements VerifyEmailViewResponse {
            public function toResponse($request)
            {
                return view('auth.verify-email');
            }
        };
    });
}

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

<!-- MySQL -->
https://aiven.io/
