@extends('layouts.app')

@section('content')
    <div class="container">
        @include('tasks._list',$project)
    </div>
@endsection
