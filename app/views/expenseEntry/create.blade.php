<form class="form-horizontal create-edit-form" role="form" action="{{OSMS::$baseUrl}}expenseEntry/save" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">Expense Type:</label>
        <div class="form-group col-sm-8">
            {{ Form::select("expenseType", $expenseTypes, null, array("class" => 'chosen form-control')) }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Amount:</label>
        <div class="col-sm-8">
            <input type="text" name="amount" class="form-control" placeholder="Amount"  value="">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-8 col-sm-3">
            <button type="submit" class="form-control">Create</button>
        </div>
    </div>
</form>