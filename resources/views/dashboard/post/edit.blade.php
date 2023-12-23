@extends('dashboard.layout')

@section('content')
    <h1>Actualizar Post: {{ $post->title }}</h1>

    @include('dashboard.templates._errors-forms')


    <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">

        @method('PUT')

        @include('dashboard.post._form',['task' => 'edit'])

    </form>
@endsection
