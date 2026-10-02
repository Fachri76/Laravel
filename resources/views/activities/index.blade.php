@extends('layouts.app')

@section('content')

    <h2>Daftar Activity</h2>

    <a href="{{ route('activities.create') }}">
        Tambah Activity
    </a>

    <hr>

    <form
        method="GET"
        action="{{ route('activities.index') }}"
    >
        <input
            type="text"
            name="search"
            placeholder="Cari kode atau judul"
            value="{{ request('search') }}"
        >

        <select name="category_id">
            <option value="">
                Semua kategori
            </option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(
                        request('category_id')
                        == $category->id
                    )
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <select name="status">
            <option value="">
                Semua status
            </option>

            @foreach (\App\Models\Activity::STATUSES as $status)
                <option
                    value="{{ $status }}"
                    @selected(
                        request('status') === $status
                    )
                >
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <select name="sort">
            <option
                value="latest"
                @selected(
                    request('sort', 'latest')
                    === 'latest'
                )
            >
                Terbaru
            </option>

            <option
                value="oldest"
                @selected(
                    request('sort')
                    === 'oldest'
                )
            >
                Terlama
            </option>
        </select>

        <button type="submit">
            Filter
        </button>

        <a href="{{ route('activities.index') }}">
            Reset
        </a>
    </form>

    <hr>

    @forelse ($activities as $activity)

        <div>
            <strong>
                {{ $activity->code }}
                -
                {{ $activity->title }}
            </strong>

            <p>
                Kategori:
                {{ $activity->category->name }}
            </p>

            <p>
                Status:
                {{ $activity->status }}
            </p>

            <p>
                Mulai:
                {{ optional(
                    $activity->start_at
                )->format('d-m-Y H:i') }}
            </p>

            <a href="{{ route(
                'activities.show',
                $activity
            ) }}">
                Detail
            </a>
        </div>

        <hr>

    @empty

        <p>Tidak ada Activity.</p>

    @endforelse

    {{ $activities->links() }}

@endsection