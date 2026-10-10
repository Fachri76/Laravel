<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
        }

        .container {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            border: 1px solid #ddd;
        }

        input {
            width: 100%;
            box-sizing: border-box;
            padding: 9px;
            margin: 5px 0 15px;
        }

        button {
            width: 100%;
            padding: 10px;
        }

        .error {
            color: red;
            background: #ffecec;
            padding: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Login</h1>

    <p>Masuk untuk membuka dashboard</p>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form
        method="POST"
        action="{{ route('login.process') }}"
    >
        @csrf

        <label>Username</label>

        <input
            type="text"
            name="username"
            value="{{ old('username') }}"
            required
        >

        <label>Password</label>

        <input
            type="password"
            name="password"
            required
        >

        <button type="submit">
            Masuk
        </button>
    </form>

</div>

</body>
</html>