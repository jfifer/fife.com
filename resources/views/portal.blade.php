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
                                    <select class="form-control" name="select" ng-model="query.select">
                                        <option value="extension">Extension</option>
                                        <option value="customer">Customer</option>
                                        <option value="branch">Branch</option>
                                    </select>
                                </div>
                            </div>
                            <div class="panel panel-default col-md-2">
                                <div class="panel-body">
                                    <label for="from">From:</label>
                                    <select class="form-control" name="from" ng-model="query.from">
                                        <option value="reseller">Reseller</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="extensionDtl">
                        </div>
                    </div>
                    <div class="panel-footer">
                      <button data-ng-click="submitQuery(query);">Generate Query</button>
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
                            <label for="chartType">Chart Type</label>
                            <select class="form-component" ng-model="chartType">
                                <option value="bar">Bar</option>
                                <option value="pie">Pie Chart</option>
                            </select>
                            <button class="pull-right" ng-click="generateChart(query, chartType)">Generate</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <table style="width:60%;margin:0 auto;">
                            <tr>
                                <th ng-repeat="column in columns"><%column%></th>
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
    <div class="modal-parent big-modal" id="modal-parent">
    </div>
@endsection
