@extends('layouts.app')

@section('content')
  @foreach ($servers as $server)
    <p>Hostname: {{ $server->hostname }}, {{$server->name}}</p>
  @endforeach
@endsection
