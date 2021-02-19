<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use DateTime;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::with('school')->get();
        return response()->json($courses);
    }

    public function show($id)

    {

        $course = Course::with('school')->find($id);

        if(!$course){
            return response()->json([
                'message' => 'Registro inexistente'
            ], 404);
        }
        
        return response()->json($course);

    }

    public function store(Request $request)
    {
        $course = new Course();
        $course->fill($request->all());
        $course->start_date = Carbon::parse($request->start_date);

        $ex = $this->validateCourse($course);
        
         if ($ex->count() > 0)
            return response()->json($ex, 400);
         else
            $course->save();

        return response()->json($course, 201);
    }

    public function validateCourse(Course $course){
        $ex = collect([]);

        if (!$course->name || $course->name == "")
            $ex->push('Campo "name" deve ser preenchido.');

        if (!$course-> school_id || $course->school_id == "")
            $ex->push('Campo "school" deve ser preenchido.');

        if (!$course->description || $course->description == "")
            $ex->push('Campo "description" deve ser preenchido.');

        return $ex; 
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if(!$course){
            return response()->json([
                'message'=>'Registro Inexistente',
            ], 404);
        }

        $course->fill($request->all());
        $course->start_date = Carbon::parse($request->start_date);
        $course->save();

        return response()->json($course);
    }

    
    public function destroy($id)
    {
        $course = Course::find($id);

        if(!$course){
                return response()->json([
                    'message'=>'Registro Inexistente'
                ],404);
        }
        $course->delete();
    }



}
