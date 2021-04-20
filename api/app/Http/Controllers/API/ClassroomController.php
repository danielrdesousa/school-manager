<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Resources\ClassroomResource;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = Classroom::with('school')->get();
        return response([ 'classrooms' => ClassroomResource::collection($classrooms), 'message' => 'Retrieved successfully'], 200);
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
           'year' => 'required',
           'level_education' => 'required',
           'serie' => 'required',
           'shift' => 'required',
           'school_id' => 'required',
       ]);

       if ($validator->fails()) {
           return response(['error' => $validator->errors(), 'Validation Error']);
       }

       $classroom = Classroom::create($data);

       return response(['classroom' => new ClassroomResource($classroom), 'message' => 'Created successfully'], 201);
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        $classroom = Classroom::with('school')->where('id', $classroom->id)->get();
        return response(['classroom' => new ClassroomResource($classroom), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $classroom->update($request->all());

        return response(['classroom' => new ClassroomResource($classroom), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response(['message' => 'Deleted']);
    }
}
