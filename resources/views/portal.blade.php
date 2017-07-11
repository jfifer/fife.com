@extends('layouts.app')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Query Builder</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel panel-default col-md-2">
                                <div class="panel-body">
                                    <label for="select">Select:</label>
                                    <select class="form-control" name="select" ng-model="query.select" ng-change="updateColumns(query.select)">
                                        <option value="reseller">Resellers</option>
                                        <option value="branch">Branches</option>
                                        <option value="server">Servers</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Query Builder</h3>
                        <button class="btn btn-default pull-right" ng-click="submitQuery(query)">Submit</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row" ng-repeat="column in columns track by $index" ng-if="$index % 4 == 0">
                            <div class="col-xs-3" 
                                 ng-repeat="i in [$index, $index + 1, $index + 2, $index + 3]" 
                                 ng-if="columns[i] != null">
                                <div><label><%columns[i].column%></label> <input name="<%query[columns[i].column]%>" ng-model="query[columns[i].column]" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
