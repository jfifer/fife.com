@extends('layouts.app')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Model</h3>
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
                        <h3 class="pull-left">Options</h3>
                        <button class="btn btn-default pull-right" ng-click="submitQuery(query)">Submit</button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row" ng-repeat="column in columns track by $index" ng-if="$index % 4 == 0">
                            <div class="col-md-3 panel-default" 
                                 ng-repeat="i in [$index, $index + 1, $index + 2, $index + 3]" 
                                 ng-if="columns[i] != null">
                                 <div class="panel-heading">
                                    <span class="pull-left"><%columns[i].column%></span>
                                    <input type="checkbox" ng-model="query.eloquent_includes[columns[i].column]" value='true' class="pull-right" />
                                    <div class="clearfix"></div>
                                 </div>
                                <div class="panel-body">
                                    <input name="<%query[columns[i].column]%>" ng-model="query[columns[i].column]" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" ng-if="results.length > 0">
            <div class="col-md-12">
                <div class="panel panel-default col-md-12">
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Results</h3>
                        <div class="form-group pull-right">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <table style="width:60%;margin:0 auto;">
                            <tr>
                                <th ng-repeat="column in resCols"><%column%></th>
                            </tr>
                            <tr ng-repeat="result in results">
                                <td ng-repeat="res in result">
                                    <% res %>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
