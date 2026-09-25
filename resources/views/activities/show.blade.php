@extends('layouts.app')

@section('content')
    <h2>{{ $activity->title }}</h2>

    <p>
        {{ $activity->description ?? 'Tidak ada deskripsi.' }}
    </p>

    <p>
        Tanggal:
        {{ $activity->activity_date->format('d-m-Y') }}
    </p>

    <p>
        Kategori:
        {{ $activity->category }}
    </p>

    <p>
        Status:
        {{ $activity->status }}
    </p>

    <a href="{{ route('activities.edit', $activity) }}">
        Edit
    </a>

    <form
        action="{{ route('activities.destroy', $activity) }}"
        method="POST"
    >
        @csrf
        @method('DELETE')

        <button type="submit">
            Hapus
        </button>
    </form>

    <a href="{{ route('activities.index') }}">
        Kembali ke daftar
    </a>
@endsection