@extends('layouts.app')

@section('content')

    <h2>{{ $activity->title }}</h2>

    <p>
        Kode:
        {{ $activity->code }}
    </p>

    <p>
        Kategori:
        {{ $activity->category->name }}
    </p>

    <p>
        Deskripsi:
        {{ $activity->description }}
    </p>

    <p>
        Mulai:
        {{ optional(
            $activity->start_at
        )->format('d-m-Y H:i') }}
    </p>

    <p>
        Selesai:
        {{ optional(
            $activity->end_at
        )->format('d-m-Y H:i') }}
    </p>

    <p>
        Lokasi:
        {{ $activity->location }}
    </p>

    <p>
        Kapasitas:
        {{ $activity->capacity }}
    </p>

    <p>
        Terdaftar:
        {{ $activity->registered_count }}
    </p>

    <p>
        Status:
        {{ $activity->status }}
    </p>

    @if ($activity->poster_path)
        <img
            src="{{ asset(
                'storage/' .
                $activity->poster_path
            ) }}"
            alt="Poster"
            width="250"
        >
    @endif

    <hr>

    <a href="{{ route(
        'activities.edit',
        $activity
    ) }}">
        Edit
    </a>

    <form
        action="{{ route(
            'activities.destroy',
            $activity
        ) }}"
        method="POST"
    >
        @csrf
        @method('DELETE')

        <button type="submit">
            Hapus
        </button>
    </form>

    @if ($activity->status === 'draft')
        <form
            method="POST"
            action="{{ route(
                'activities.publish',
                $activity
            ) }}"
        >
            @csrf

            <button type="submit">
                Publish
            </button>
        </form>
    @endif

    @if ($activity->status === 'published')
        <form
            method="POST"
            action="{{ route(
                'activities.complete',
                $activity
            ) }}"
        >
            @csrf

            <button type="submit">
                Complete
            </button>
        </form>

        <hr>

        <h3>Pendaftaran Peserta</h3>

        <form
            method="POST"
            action="{{ route(
                'activities.registrations.store',
                $activity
            ) }}"
        >
            @csrf

            <input
                type="text"
                name="participant_name"
                placeholder="Nama peserta"
            >

            <input
                type="email"
                name="email"
                placeholder="Email"
            >

            <button type="submit">
                Daftar
            </button>
        </form>
    @endif

@endsection