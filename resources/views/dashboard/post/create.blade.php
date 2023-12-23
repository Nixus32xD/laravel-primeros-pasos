@extends('dashboard.layout')

@section('content')
    <h1>Crear Post</h1>

    @include('dashboard.templates._errors-forms')


    <form action="{{ route('post.store') }}" method="post">
        @include('dashboard.post._form')
    </form>
@endsection
