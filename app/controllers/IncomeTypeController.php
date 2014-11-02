<?php

class IncomeTypeController extends BaseController {

    public function loadTable() {
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
        $incomes = null;
        $total = 0;
        if(count($array) > 0 ) {
            $incomes = IncomeType::whereRaw($query, $array)->take($max)->skip($offset)->get();
            $total = IncomeType::whereRaw($query, $array)->count();
        } else {
            $incomes = IncomeType::take($max)->skip($offset)->orderBy('id', "ASC")->get();
            $total = IncomeType::count();
        }
        return View::make("income.tableView", array(
            'income' => $incomes,
            'total' => $total,
            'max' => $max,
            'offset' => $offset,
            'searchText' => $searchText
        ));
    }

    public function create() {
        $incomeType = new IncomeType();
        return View::make("income.edit", array(
            'incomeType' => $incomeType,
        ));
    }

    public function edit() {
        $id = Input::get("id");
        $incomeType = IncomeType::find($id);
        return View::make("income.edit", array(
            'incomeType' => $incomeType,
        ));
    }

    public function save()
    {
        $rules = array(
            'name' => 'required|unique:income_types,name'
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
            $incomeType = null;
            if($id){
                $incomeType = IncomeType::find($id);
            }
            else{
                $incomeType = new IncomeType();
            }
            $incomeType->name = $name;
            $incomeType->description = $description;
            $incomeType->status = "Y";
            $incomeType->save();
        });
        return array('status' => 'success', 'message' => 'Income type has been successfully saved');
    }
}