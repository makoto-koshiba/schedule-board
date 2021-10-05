@extends('layouts.app')

@section('content')


<h3>顧客一覧</h3>

 @if(Auth::check() && Auth::user()->admin_flag == true )
    {{-- プロジェクト作成ページへのリンク --}}
    {!! link_to_route('clients.create', '顧客追加', [], ['class' => 'btn btn-primary btn-sm mb-1']) !!}
　　@if (count($clients) > 0)
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>顧客名</th>
                    <th>顧客コード</th>
                    <th>郵便番号</th>
                    <th>所在地</th>
                    <th>電話番号</th>
                    <th>FAX番号</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->code }}</td>
                    <td>{{ $client->postal_code }}</td>
                    <td>{{ $client->address }}</td>
                    <td>{{ $client->tel }}</td>
                    <td>{{ $client->fax }}</td>
                    <td>
                     @if(Auth::user()->admin_flag == true )
                        
                         <div class="d-flex flex-row bd-highlight mb-6"> 
                        <div>
                        {!! link_to_route('clients.edit', '編集', ['client'=>$client->id], ['class' => 'btn btn-primary btn-sm mr-3']) !!}
                        </div>
                        {!! Form::model($client, ['route' => ['clients.destroy', $client->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    
    @endif
    
@endsection
    
　　　

