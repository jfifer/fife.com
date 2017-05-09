@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="queryBuilder" class="form-horizontal" role="form">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3><%title%></h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-md-4">
                            <label for="qType">Type</label>
                            <select name="qType" id="type" class="form-component">
                                <option value="count">Count</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qModel">From</label>
                            <select name="qModel" id="model" class="form-component">
                                <option value="extension">Extension</option>
                                <option value="customer">Customer</option>
                                <option value="branch">Branch</option>
                                <option value="reseller">Reseller</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4" id="extensionTypes">
                            <label for="extensionType">Extension Type</label>
                            <select name="extType" id="extType" class="form-component">
                                <option value="1">Standard</option>
                                <option value="2">Cloud</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="qGroup">Group By</label>
                            <select name="qGroup" id="group" class="form-component">
                                <option value="reseller">Reseller</option>
                                <option value="branch">Branch</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </div>
                    <div class="panel-footer">
                      <button type="submit">Build Query</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
