<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - WongTask</title>
    @vite('resources/css/app.css')
    <style>
        :root { --bg:#f3eee6; --card:#fff; --line:#e9dccd; --brand:#7a4b23; --muted:#887b6f; --text:#2b2118; }
        * { box-sizing:border-box; font-family:"Plus Jakarta Sans",sans-serif; }
        body { margin:0; min-height:100vh; background:radial-gradient(circle at 20% 20%, #fff8ef, #f3eee6); display:grid; place-items:center; color:var(--text); }
        .card { width:min(430px, 92vw); background:var(--card); border:1px solid var(--line); border-radius:18px; padding:22px 18px; box-shadow:0 10px 30px rgba(90,58,31,.1); }
        h1 { margin:0 0 6px; font-size:1.45rem; }
        .sub { margin:0 0 14px; color:var(--muted); font-size:.84rem; }
        .err { background:#fff1f1; color:#b13b3b; border:1px solid #ffd1d1; border-radius:10px; padding:9px 10px; font-size:.8rem; margin-bottom:10px; }
        .field { margin-bottom:10px; }
        .field label { display:block; margin-bottom:4px; color:var(--muted); font-size:.76rem; font-weight:700; }
        .field input { width:100%; border:1px solid var(--line); border-radius:11px; padding:10px 11px; }
        .btn { width:100%; border:none; background:var(--brand); color:#fff; border-radius:11px; padding:11px; font-weight:700; margin-top:4px; }
        .foot { margin-top:10px; text-align:center; font-size:.8rem; color:var(--muted); }
        .foot a { color:var(--brand); text-decoration:none; font-weight:700; }
    </style>
</head>

<body>
    <main class="card">
        <h1>Daftar WongTask</h1>
        <p class="sub">Buat akun dulu, baru bisa masuk ke dashboard.</p>

        @if($errors->any())
        <div class="err">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf
            <div class="field">
                <label for="name">Nama</label>
                <input id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="field">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            <button class="btn" type="submit">Daftar</button>
        </form>

        <p class="foot">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </main>
</body>

</html>
