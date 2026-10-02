@extends('layouts.app')

@section('content')

    <h2>Daftar Category</h2>

    @foreach ($categories as $category)

        <div>
            <strong>
                {{ $category->name }}
            </strong>

            <p>
                Jumlah Activity:
                {{ $category->activities_count }}
            </p>

            <form
                method="POST"
                action="{{ route(
                    'categories.destroy',
                    $category
                ) }}"
            >
                @csrf
                @method('DELETE')

                <button type="submit">
                    Hapus
                </button>
            </form>
        </div>

        <hr>

    @endforeach

@endsection