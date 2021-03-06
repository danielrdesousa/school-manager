<?php

namespace App\Http\Controllers\API;

use EloquentBuilder;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\StudentResource;
use App\Http\Resources\ClassroomResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = EloquentBuilder::to(Student::with('classrooms'), request()->filter)->get();
        return response([ 'students' => StudentResource::collection($students), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'email|required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $student = Student::create($data);

        return response(['student' => new StudentResource($student), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = Student::with('classrooms')->where('id', $student->id)->first();
        return response(['student' => new StudentResource($student), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->update($request->all())->with('classrooms');

        return response(['student' => new StudentResource($student), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response(['message' => 'Deleted']);
    }

    /**
     * Insert a classroom listing for a student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function createClassrooms(Request $request, Student $student)
    {
        $classrooms = $request->input('classrooms');
        $student->classrooms()->syncWithoutDetaching($classrooms);

        $update_student = Student::with('classrooms')->where('id', $student->id)->first();

        return response(['student' => new StudentResource($update_student), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove a classroom listing for a student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroyClassrooms(Request $request, Student $student)
    {
        $classrooms = $request->input('classrooms');
        $student->classrooms()->detach($classrooms);

        $update_student = Student::with('classrooms')->where('id', $student->id)->first();

        return response(['student' => new StudentResource($update_student), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Updates a student's classroom listing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function updateClassrooms(Request $request, Student $student)
    {
        $classrooms = $request->input('classrooms');
        $student->classrooms()->sync($classrooms);

        $update_student = Student::with('classrooms')->where('id', $student->id)->first();

        return response(['student' => new StudentResource($update_student), 'message' => 'Retrieved successfully'], 200);
    }
}
