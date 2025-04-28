@extends('adminlte::page')

@section('title', 'Usuário')

@section('content')
<div class="container pt-4">
    <div class="card">
      <div class="card-body">
          <x-adminlte-datatable id="table1" :heads="$response->heads">
              @foreach($response->data as $row)
                  <tr>
                      @foreach($row as $cell)
                          <td>{!! $cell !!}</td>
                      @endforeach
                  </tr>
              @endforeach
          </x-adminlte-datatable>
      </div>
    </div>
</div>
@endsection