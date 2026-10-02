<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Activity Manager</title>
</head>

<body>

    <h1>Activity Manager</h1>

    <nav>
        <a href="{{ route('activities.index') }}">
            Activities
        </a>

        |

        <a href="{{ route('categories.index') }}">
            Categories
        </a>

        |

        <a href="{{ route('activities.trash') }}">
            Trash
        </a>
    </nav>

    <hr>

    @if (session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <div>
            <strong>Terjadi kesalahan:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</body>
</html>