<?php
class Expense extends Eloquent{
    protected $table = 'expenses';

    public function expenseType(){
        return $this->belongsTo("ExpenseType");
    }

    public function expenseBy() {
        return $this->belongsTo("User", "user_id");
    }

    public function name(){
        return Expense_type::find($this->expense_type_id)->name;
    }
}