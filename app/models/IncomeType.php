<?php
class IncomeType extends Eloquent {
    protected $table = 'income_types';
    public $timestamps = false;

    public function income_entries() {
        return $this->hasMany('IncomeEntry');
    }
}