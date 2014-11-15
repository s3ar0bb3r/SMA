<?php
class Registration extends Eloquent {
    protected $table = 'registrations';
    public $timestamps = false;

    public function student() {
        return $this->belongsTo("Student");
    }

    public function name(){
        return Student::find($this->student_id)->name;
    }
}