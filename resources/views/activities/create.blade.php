@extends('layouts.app')

@section('content')

    <h2>Tambah Activity</h2>

    <form
        action="{{ route('activities.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        @include('activities._form')
    </form>

@endsection