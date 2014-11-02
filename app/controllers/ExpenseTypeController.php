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
        $expenseType = new ExpenseType();
        return View::make("expense.create", array(
            'expenseType' => $expenseType,
        ));
    }

    public function getEdit() {
        $id = Input::get("id");
        $expenseType = ExpenseType::find($id);
        return View::make("expense.create", array(
            'expenseType' => $expenseType,
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
        DB::transaction(function() use ($id, $name, $description){
            $expenseType = null;
            if($id){
                $expenseType = ExpenseType::find($id);
            }
            else{
                $expenseType = new ExpenseType();
            }
            $expenseType->name = $name;
            $expenseType->description = $description;
            $expenseType->status = "Y";
            $expenseType->save();
        });
        return array('status' => 'success', 'message' => 'Expense type has been successfully saved');
    }

    public function getAddExpense(){
        return View::make("expense.add");
    }
}