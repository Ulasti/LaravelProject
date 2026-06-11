@extends('layouts.frontbase')

@section('title', 'Home - ' . config('app.name'))

@section('content')
    @include('partials.front-slider')
@endsection
