<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function allData() {
        $data = Teacher::orderBy('id', 'DESC')->get();
        return response()->json($data);
    }

    public function storeData(Request $request) {

        $request->validate([
            'name' => 'string|required',
            'title' => 'string|required',
            'institute' => 'string|required',
        ]);
        
        /******* this is a way to insert data into database *********/

        // $data = Teacher::insert([
        //     'name' => $request->name,
        //     'title' => $request->title,
        //     'institute' => $request->institute,
        // ]);

        
        /****** This is another way to store data into database *******/
        $data = new Teacher();

        $data->name = $request->name;
        $data->title = $request->title;
        $data->institute = $request->institute;

        $data->save();

        
    }


    public function editData(Request $request) {
        $data = Teacher::findOrFail($request->id);
        return response()->json($data);
    }

    public function updateData(Request $request) {

        $teacher = Teacher::findOrFail($request->id);

        $request->validate([
            'name' => 'string|required',
            'title' => 'string|required',
            'institute' => 'string|required'
        ]);

        if($teacher) {
            
            

            $data = $request->all();

            $status = $teacher->fill($data)->save();

            return response()->json($status);
            


        } else {
            return response()->json($teacher);
        }
        

        // if($request->validate([
        //     'name' => 'required',
        //     'title' => 'required',
        //     'institute' => 'required'
        // ]) && $data) {

        //     Teacher::insert([
        //     'name' => $request->name,
        //     'title' => $request->title,
        //     'institute' => $request->institute,
        //     ]);
            
        // }
        // else {
        //     return response()->json($data);
        // }
    }

    public function deleteData(Request $request) {
        $teacher = Teacher::findOrFail($request->id);

        if($teacher) {
            $status = $teacher->delete();
        } else {
            return back()->with('error', 'Data not found!!!');
        }
    }
}
