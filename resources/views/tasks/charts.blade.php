@extends('layouts.app')

@section('content')
    <div class="contaner col-md-4 d-flex">
        <canvas id="pieChart" width="300" height="300">
            <div id="pie-data" data-done="{{ $todo }}" data-todo="{{ $done }}" data-total="{{ $total }}"></div>
            <p>Hello Fallback World</p>
        </canvas>
        <canvas class="pl-5" id="barChart" width="300" height="300">
            <div id="bar-data" data-names="{{ $names }}" data-projects="{{ TaskCountArray($projects) }}"></div>
        </canvas>

    </div>
@endsection


@section('customJS')
    <script src="{{ asset('/js/Chart.min.js') }}"></script>
    <script src="{{ asset('/js/pie.js') }}"></script>
    <script src="{{ asset('/js/bar.js') }}"></script>
@endsection
