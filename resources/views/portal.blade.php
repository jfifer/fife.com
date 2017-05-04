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
            <label for="qType">Type</label>
            <select name="qType" class="form-component">
              <option value="count">Count</option>
            </select>
          </div>
          <div class="form-group">
            <label for="qModel">From</label>
            <select name="qModel" class="form-component">
              <option value="extension">Extension</option>
              <option value="customer">Customer</option>
              <option value="branch">Branch</option>
              <option value="reseller">Reseller</option>
            </select>
          </div>
          <div class="form-group">
            <label for="qGroup">Group By</label>
            <select name="qGroup">
              <option value="resellerId">Reseller</option>
              <option value="branchId">Branch</option>
              <option value="customerId">Customer</option>
            </select>
          </div>
          <!--<table>
          @foreach ($data['servers'] as $server)
              <tr>
                <td>{{$server->hostname}}</td>
                <td>{{$server->platform['name']}}</td>
              </tr>
          @endforeach
          </table>-->
        </div>
      </div>
    </div>
  </div>
@endsection
