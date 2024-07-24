@extends('layout.layout')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">GitHub Popular Repositories</h1>
    </div>
    @include('repositories._search')

    @include('repositories._data')




@endsection
