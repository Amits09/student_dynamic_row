<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Counts;

class StudentController extends Controller
{
    public function submit(Request $request){
       
        $name = $request->get('name');
        $country = $request->get('country');
        $state = $request->get('state');
        $files= $request->file('image');

      

        for($i=0;$i<count($name);$i++){

            $student = new Student();

            $student->name = $name[$i];
            $student->country_id = $country[$i];
            $student->state_id =  $state[$i];
            $student->save();

        }
    
    }


    public function index(Request $request){

        if ($request->ajax()) {
            $data = Student::select('*')->with('state');
            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('state_name', function ($row) {
                    return $row->state->state_name;
                })

                ->addColumn('country_name', function ($row) {
                    return $row->country->country_name;
                })

                ->addColumn('image', function ($row) { 
                    $url=asset("/assets/images/".$row->image); 
                    return '<img src='.$url.'  width="100"  height="100" align="center" />'; 
             })


                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                //     return $actionBtn;
                // })
                // ->rawColumns(['action'])
                ->rawColumns(['image'])
                ->make(true);

        }
        return view('/dashboard');
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["state_name", "id"]);
  
        return response()->json($data);
    }
}