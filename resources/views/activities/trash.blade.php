@extends('layouts.app')

@section('content')

    <h2>Activity Terhapus</h2>

    @forelse ($activities as $activity)

        <p>
            {{ $activity->code }}
            -
            {{ $activity->title }}
        </p>

        <form
            method="POST"
            action="{{ route(
                'activities.restore',
                $activity->id
            ) }}"
        >
            @csrf
            @method('PATCH')

            <button type="submit">
                Restore
            </button>
        </form>

        <hr>

    @empty

        <p>Tidak ada Activity terhapus.</p>

    @endforelse

    {{ $activities->links() }}

@endsection