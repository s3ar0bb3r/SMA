<?php
class Income extends Eloquent {

    protected $table = 'incomes';

    public function incomeType(){
        return $this->belongsTo("IncomeType");
    }

    public function name(){
        return Income_type::find($this->income_type_id)->name;
    }
}