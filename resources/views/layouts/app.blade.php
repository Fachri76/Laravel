<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity Manager</title>
</head>

<body>
    <header>
        <h1>Activity Manager</h1>

        <nav>
            <a href="{{ route('activities.index') }}">
                Daftar Kegiatan
            </a>
        </nav>
    </header>

    <hr>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>