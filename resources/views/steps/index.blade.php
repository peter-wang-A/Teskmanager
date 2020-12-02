@extends('layouts.app')


@section('content')
    <div class="container" id="app">
        <h3>{{ $task->name }}</h3>
        <steps route=" {{ route('tasks.steps.index', $task->id) }}" :initial="{{ json_encode($steps) }}"
            :in-process="{{ json_encode($todos) }}" :processed="{{ json_encode($dones) }}"
            :errors="{{ json_encode($errors->first('name')) }}">
        </steps>
    </div>

@endsection
