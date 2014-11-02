<?php
class Income extends Eloquent {

    protected $table = 'incomes';

    public function incomeType(){
        return $this->belongsTo("IncomeType");
    }

    public function incomeBy() {
        return $this->belongsTo("User", "user_id");
    }

    public function name(){
        return Income_type::find($this->income_type_id)->name;
    }
}