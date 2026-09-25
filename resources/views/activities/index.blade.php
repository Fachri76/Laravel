@extends('layouts.app')

@section('content')
    <h2>Daftar Kegiatan</h2>

    <a href="{{ route('activities.create') }}">
        Tambah Kegiatan
    </a>

    @forelse ($activities as $activity)
        <article>
            <h3>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h3>

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
        </article>

        <hr>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
@endsection