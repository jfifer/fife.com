<div class="col-md-12">
    <div class="panel panel-default col-md-12">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">Results</h3>
            <div class="form-group pull-right">
                <label for="chartType">Chart Type</label>
                <select class="form-component">
                    <option value="bar">Bar</option>
                    <option value="histogram">Histogram</option>
                    <option value="pie">Pie Chart</option>
                </select>
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