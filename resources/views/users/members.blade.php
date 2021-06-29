@extends('layouts.app')

@section('content')

    <h1>メンバー一覧</h1>

    @if (count($members) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>メンバー</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection