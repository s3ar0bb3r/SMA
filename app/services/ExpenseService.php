<?php
class ExpenseService {
    public static function saveExpenseType($id, $name, $description) {
        DB::transaction(function() use ($id, $name, $description){
            $expense = null;
            if($id){
                $expense = ExpenseType::find($id);
            }
            else{
                $expense = new ExpenseType();
            }
            $expense->name = $name;
            $expense->description = $description;
            $expense->status = "Y";
            $expense->save();
        });
        return true;
    }
}