@extends('layouts.app')

@section('content')
    <h2>Edit Kegiatan</h2>

    <form
        action="{{ route('activities.update', $activity) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        @include('activities._form')

        <button type="submit">
            Simpan Perubahan
        </button>
    </form>
@endsection