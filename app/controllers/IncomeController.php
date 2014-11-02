<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/31/14
 * Time: 10:48 PM
 */

class IncomeController extends BaseController {
    public function __construct() {
        $this->beforeFilter('super_admin', array('except' => array("loadTable")));
    }

    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText");
        $array = array();
        $query = "";
        if($searchText) {
            $query = $query."name Like ?";
            $text = trim($searchText);
            array_push($array, "%".$text."%");
        }
        $incomes = null;
        $total = 0;
        if(count($array) > 0 ) {
            $incomes = Income::whereRaw($query, $array)->take($max)->skip($offset)->get();
            $total = Income::whereRaw($query, $array)->count();
        } else {
            $incomes = Income::take($max)->skip($offset)->orderBy('id', "ASC")->get();
            $total = Income::count();
        }
        return View::make("incomeEntry.tableView", array(
            'incomes' => $incomes,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }

    public function getCreate() {
        $incomeAll = IncomeType::all();
        $incomeTypes = array('' => "None");
        foreach($incomeAll as $inc) {
            $incomeTypes[$inc->id] = $inc->name;
        }
        return View::make("incomeEntry.create",array('incomeTypes' => $incomeTypes));
    }
    public function getEdit() {
        $id = Input::get("id");
        $income = IncomeType::find($id);
        return View::make("income.edit", array(
            'income' => $income,
        ));
    }

    public function postSave()
    {
        $rules = array(
            'incomeType' => 'required',
            'amount' => 'required'
        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $id = Input::get("incomeType");
        $amount = Input::get("amount");
        $income_type_id = Input::get("incomeType");
        DB::transaction(function() use ($amount, $income_type_id){
            $income = null;
            $income = new Income();
            $income->income_type_id = $income_type_id;
            $income->amount = $amount;
            $income->save();
        });
        return array('status' => 'success', 'message' => 'Income type has been successfully saved');
    }

    public function getDateselect() {
        return View::make("incomeEntry.dateSelection");
    }

    public function postReport(){
        $from = Input::get("from");
        $to = Input::get("to");
        $array = array();
        $query= "";
        $flag = false;
        if($from) {
            array_push($array, new DateTime($from."00:00:00"));
            $query = $query."created_at >= ?";
            $flag = true;
        }
        if($to) {
            array_push($array, new DateTime($to."23:59:59"));
            $query = $query.($flag ? " and " : "");
            $query = $query."created_at <= ?";
        }
        if(strlen($query) <= 0) {
            return "invalid query";
        }
        $incomes = IncomeEntry::whereRaw($query, $array)->orderBy('created_at', 'ASC')->get();
        /*$allIncome = (array) null;
        foreach($incomes as $inc) {
            $allIncome[$inc->name()] = $inc->amount;
        }*/
        require_once(base_path()."/vendor/dompdf/dompdf/dompdf_config.inc.php");
        $html =  View::make("incomeEntry.report", array('incomes' => $incomes, 'to' => $to, 'from' => $from));
        return $html;
    }
}
