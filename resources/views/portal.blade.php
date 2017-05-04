@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Stuff</h3>
        </div>
        <div class="panel-body">
            {{ Form::select('age', ['Under 18', '19 to 30', 'Over 30']) }}
        </div>
      </div>
    </div>
  </div>
@endsection
