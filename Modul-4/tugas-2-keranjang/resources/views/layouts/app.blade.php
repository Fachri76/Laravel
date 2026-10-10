<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Toko Alat Tulis</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .card {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
        }

        button {
            padding: 6px 12px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>

<body>

<nav>
    <a href="{{ route('barang.index') }}">
        Toko Alat Tulis
    </a>

    <a href="{{ route('keranjang.index') }}">
        Keranjang
    </a>
</nav>

@if (session('success'))
    <p class="success">
        {{ session('success') }}
    </p>
@endif

@if ($errors->any())
    <p class="error">
        {{ $errors->first() }}
    </p>
@endif

@yield('content')

</body>
</html>