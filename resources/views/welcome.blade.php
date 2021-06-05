@extends('layouts.app')

@section('content')
     @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <div class="center jumbotron">
            <div class="text-center">
            <h1>スケジュールボード</h1>
        </div>
    </div>
     @endif
@endsection