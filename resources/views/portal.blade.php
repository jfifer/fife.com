@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Stuff</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <select class="form-control" name="featureServer">
                    @foreach ($data['servers'] as $server)
                        <option value="{{$server->serverId}}">{{$server->hostname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
