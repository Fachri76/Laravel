@extends('layouts.app')

@section('content')
    <h2>Tambah Kegiatan</h2>

    <form
        action="{{ route('activities.store') }}"
        method="POST"
    >
        @csrf

        @include('activities._form')

        <button type="submit">
            Simpan
        </button>
    </form>
@endsection