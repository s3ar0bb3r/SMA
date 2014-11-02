<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/18/14
 * Time: 10:22 PM
 */

class IncomeEntryService {

    public static function getIncomesWithFilter() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $array = array();
        $query = "";
        $admission = IncomeType::where('name','=','Admission Form')->get()->first();
        $readmission = IncomeType::where('name','=','Readmission Form')->get()->first();
        $transfer = IncomeType::where('name','=','Transfer certificate')->get()->first();
        $incomes = null;
        if($admission && $readmission && $transfer){
            $incomes = Income::where('income_type_id','=',$admission->id)->orWhere('income_type_id','=',$readmission->id)->orWhere('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif($admission && $readmission && !$transfer){
            $incomes = Income::where('income_type_id','=',$admission->id)->orWhere('income_type_id','=',$readmission->id)->take($max)->skip($offset);
        }
        elseif($admission && !$readmission && $transfer){
            $incomes = Income::where('income_type_id','=',$admission->id)->orWhere('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif($admission && !$readmission && !$transfer){
            $incomes = Income::where('income_type_id','=',$admission->id)->take($max)->skip($offset);
        }
        elseif(!$admission && $readmission && $transfer){
            $incomes = Income::where('income_type_id','=',$readmission->id)->orWhere('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif(!$admission && $readmission && !$transfer){
            $incomes = Income::where('income_type_id','=',$readmission->id)->take($max)->skip($offset);
        }
        elseif(!$admission && !$readmission && $transfer){
            $incomes = Income::where('income_type_id','=',$transfer->id)->take($max)->skip($offset);
        }
        elseif(!$admission && !$readmission && !$transfer){
            return $incomes;
        }
        return $incomes->get();
    }


    public static function saveIncome( $type, $amount, $income_type ) {

        return true;
    }
}