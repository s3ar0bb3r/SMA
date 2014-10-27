<?php
class ExpenseType extends Eloquent {
    protected $table = 'expense_types';
    public $timestamps = false;

    public function expense_entries() {
        return $this->hasMany('ExpenseEntry');
    }
}