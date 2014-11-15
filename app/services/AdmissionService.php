<?php
class AdmissionService {
    public static function getStudents() {

        return $students->get();
    }

    public static function getCounts() {
        $array = array();
        $query = "";
        if(Input::get("searchText")) {
            $query = $query."student_id Like ?";
            $text = trim(Input::get("searchText")) ;
            array_push($array, "%".$text."%");
        }
        if(count($array) > 0 ) {
            return StudentInformation::whereRaw($query, $array)->count();
        }
        return StudentInformation::count();
    }
}
