@extends('layouts.app')

@section('content')
    <div class="cantainer">
        <div class="card-deck m-auto col-10">
            <div class="card col-3 mr-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">New Chat</h5>
                    <ul>
                        <li></li>
                    </ul>
                    {!! Form::open(['route' => ['chart.create', $id], 'method' => 'post']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::submit('编辑项目', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}


                </div>
            </div>
            {{-- <div class="card col-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    {!! Form::open(['route' => ['chart.create', 2], 'method' => 'post']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::submit('编辑项目', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card col-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('customJS')

    <script>
        let token = document.head.querySelector("meta[name='csrf-token']").content;

    </script>
@endsection
