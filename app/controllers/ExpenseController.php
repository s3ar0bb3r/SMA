<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 8/31/14
 * Time: 10:48 PM
 */

class ExpenseController extends BaseController {
    public function __construct()
    {
        $this->beforeFilter('super_admin', array('except' => array("loadTable")));
    }
    public function getLoadTable() {
        $max = Input::get("max") ? intval(Input::get("max")): 10;
        $offset = Input::get("offset") ? intval(Input::get("offset")) : 0;
        $searchText = Input::get("searchText") ? Input::get("searchText") : "";
        $array = array();
        $query = "";
        if($searchText) {
            $query = $query."name Like ?";
            $text = trim($searchText) ;
            array_push($array, "%".$text."%");
        }
        $expenses = null;
        $total = 0;
        if(count($array) > 0 ) {
            $expenses = Expense::whereRaw($query, $array)->take($max)->skip($offset)->orderBy('id', "DESC")->get();
            $total =  Expense::whereRaw($query, $array)->count();
        } else {
            $expenses = Expense::take($max)->skip($offset)->orderBy('id', "DESC")->get();
            $total = Expense::count();
        }
        return View::make("expenseEntry.tableView", array(
            'expenses' => $expenses,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }
    public function getCreate() {
        $expenseAll = ExpenseType::all();
        $expenseTypes = array('' => "None");
        foreach($expenseAll as $exp) {
            $expenseTypes[$exp->id] = $exp->name;
        }
        return View::make("expenseEntry.create",array('expenseTypes' => $expenseTypes));
    }

    public function postSave()
    {
        $rules = array(
            'expenseType' => 'required',
            'amount' => 'required|numeric'
        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $amount = Input::get("amount");
        $expense_type_id = Input::get("expenseType");
        $user = Auth::user();
        DB::transaction(function() use ($amount, $expense_type_id, $user){
            $expense = new Expense();
            $expense->expense_type_id = $expense_type_id;
            $expense->amount = $amount;
            $expense->user_id = $user->id;
            $expense->save();
        });
        return array('status' => 'success', 'message' => 'Expense entry has been successfully saved');
    }
    public function getDateselect() {
        return View::make("expenseEntry.dateSelection");
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
        $expenses = Expense::whereRaw($query, $array)->orderBy('created_at', 'ASC')->get();
        /*$allIncome = (array) null;
        foreach($incomes as $inc) {
            $allIncome[$inc->name()] = $inc->amount;
        }*/
        require_once(base_path()."/vendor/dompdf/dompdf/dompdf_config.inc.php");
        $html =  View::make("expenseEntry.report", array('expenses' => $expenses, 'to' => $to, 'from' => $from));
        return $html;
    }
}
