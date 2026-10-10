<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Dashboard</h1>

    <h2>
        Selamat datang,
        {{ auth()->user()->nama_lengkap }}!
    </h2>

    <p>
        Halaman ini hanya bisa dibuka setelah login.
    </p>

    <p>
        Username:
        {{ auth()->user()->username }}
    </p>

    <form
        method="POST"
        action="{{ route('logout') }}"
    >
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>

</div>

</body>
</html>