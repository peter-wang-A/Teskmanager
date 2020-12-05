@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    @foreach ($columns as $item)
                        <th scope="col">{{ $item }}</th>
                    @endforeach

                </tr>
            </thead>
            <tbody>
                @if (count($histories) > 0)
                    @foreach ($histories as $history)
                        <tr>
                            <th scope="row">{{ $history->id }}</th>
                            <td>{{ $history->user }}</td>
                            <td>{{ $history->ip }}</td>
                            <td>{{ $history->path }}</td>
                            <td>{{ $history->query ? $history->query : '' }}</td>
                            <td>{{ $history->method }}</td>
                            <td>{{ $history->platform }}</td>
                            <td>{{ $history->browser }}</td>
                            <td>{{ $history->referer }}</td>
                            <td>{{ $history->created_at->diffForhumans() }}</td>
                            <td>{{ $history->updated_at->diffForhumans() }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
            {{ $histories->links() }}
    </div>
@endsection
