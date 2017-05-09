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
                            <div class="form-group col-md-3">
                                <label for="qType">Type</label>
                                <select name="qType" id="type" class="form-component" ng-model="type">
                                    <option value="count">Count</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="qModel">From</label>
                                <select name="qModel" id="model" class="form-component" ng-model="model">
                                    <option value="extension">Extension</option>
                                    <option value="customer">Customer</option>
                                    <option value="branch">Branch</option>
                                    <option value="reseller">Reseller</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3" id="extensionTypes" ng-show="model==='extension'">
                                <label for="extensionType">Extension Type</label>
                                <select name="extType" id="extType" class="form-component" ng-model="attr.extType">
                                    <option value="-1">Any</option>
                                    <option value="1">Standard</option>
                                    <option value="2">Cloud</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="qGroup">Group By</label>
                                <select name="qGroup" id="group" class="form-component" ng-model="groupBy">
                                    <option value="reseller">Reseller</option>
                                    <option value="branch">Branch</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="panel-footer">
                          <button data-ng-click="submitQuery(groupBy);">Generate Query</button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row" ng-if="results.length > 0">
            <div class="col-md-12">
                <div class="panel panel-default col-md-12">
                    <div class="panel-heading">
                        <h3>Results</h3>
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
@endsection
