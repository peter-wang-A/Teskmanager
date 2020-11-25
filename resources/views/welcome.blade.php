@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="card-deck">
            @foreach ($projects as $project)
                <div class="col-4">
                    <div class="card">
                        <img src="{{ asset('storage/thums/original/' . $project->thumbnail) }}" class="card-img-top"
                            alt="...">

                        <div class="card-body">
                            <h5 class="card-title">{{ $project->name }}--{{ $project->thumbnail }}</h5>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>




        @include('projects._createModel')
    </div>
@endsection
