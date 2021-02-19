<?php

namespace App\Http\Controllers;

use App\models\School;
use Illuminate\Http\Request;
use App\Http\Requests;



class SchoolsController extends Controller
{
    
    public function index ()
    {
        $schools = Schools::with('courses')->get();
        return response()->json($schools);
    }

    public function show($id)
    {

        $school = School::find($id);

        if(!$school){
            return response()->json([
                'message' => 'Registro inexistente',
            ], 404);
        }

        return response()->json($school);
    }

    public function store(Request $request)
    {
        $school = new School();
        $school->fill($request->all());
        $ex = $this->validateSchool($school);

        if ($ex->count() > 0)
            return response()->json($ex, 400);
        else
            $school->save();

        return response()->json($school,201);
    }

    public function validateSchool(School $school){
        $ex = collect([]);

        if (!$school->name || $school->name == "")
            $ex->push('Campo "Name" deve ser preenchido.');

        if (!$school->city || $school->city == "")
            $ex->push('Campo "City" deve ser preenchido.');

        return $ex;
    }

    public function update(Request $request, $id)
    {
        $school = School::find($id);

        if(!$school){
            return response()->json([
                'message'=> 'Registro inexistente',
            ],404);
        }

        $school->fill($request->all());
        $school->save();
        
        return response()->json($school);
    }
    
    public function destroy($id)
    {
        $school = School::find($id);

        if(!$school){
            return response()->json([
                'message'=>'Record not found'
            ], 404);
        }

        $school->delete();
    }

}
