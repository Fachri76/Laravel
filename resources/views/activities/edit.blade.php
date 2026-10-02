@extends('layouts.app')

@section('content')

    <h2>Edit Activity</h2>

    <form
        action="{{ route(
            'activities.update',
            $activity
        ) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('activities._form')
    </form>

@endsection