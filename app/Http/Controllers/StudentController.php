<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;

class StudentController extends Controller
{
    public function submit(Request $request){
       
        $name = json_decode($request->get('name'));
        $country = json_decode($request->get('country')) ;
        $state = json_decode($request->get('state'));

       return $image =  json_decode($request->file('image'));

        for($i=0;$i<count($name);$i++){

           return $imageName = time().'.'.$image[$i]->extension();
         

            $student = new Student();



            $student->name = $name[$i];
            $student->country_id = $country[$i];
            $student->state_id =  $state[$i];
            $student->save();

        }
    
    }


    public function index(Request $request){

        if ($request->ajax()) {
            $data = Student::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('/dashboard');
    }
}