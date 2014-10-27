<?php
class ExpenseTypeController extends \BaseController {

    public function __construct()
    {
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
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        $expenseTypes = null;
        $total = 0;
        if(count($array) > 0 ) {
            $expenseTypes = ExpenseType::whereRaw($query, $array)->take($max)->skip($offset)->get();
            $total = ExpenseType::whereRaw($query, $array)->count();
        } else {
            $expenseTypes = ExpenseType::take($max)->skip($offset)->orderBy('id', "ASC")->get();
            $total = ExpenseType::count();
        }
        return View::make("expense.tableView", array(
            'expenses' => $expenseTypes,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }

    public function getCreate() {
        return View::make("expense.create");
    }

    public function getEdit() {
        $id = Input::get("id");
        $expense = Expense_type::find($id);
        $des = $expense->description;
        return View::make("expense.add", array(
            'expense' => $expense,
        ));
    }

    public function postSave()
    {
        $rules = array(
            'name' => 'required|unique:expense_types,name'
        );
        $inputs = Input::all();
        $validator = Validator::make($inputs, $rules);
        if($validator->fails()) {
            return array('status' => 'error', 'message' => $validator->messages()->all());
        }
        $id = Input::get("id");
        $name = Input::get("name");
        $description = Input::get("description");
        if(ExpenseService::saveExpenseType($id,$name,$description)){
            return array('status' => 'success', 'message' => 'Expense type has been successfully saved');
        }
        else{
            return array('status' => 'error', 'message' => 'Expense type not added');
        }
    }

    public function getAddExpense(){
        return View::make("expense.add");
    }
}