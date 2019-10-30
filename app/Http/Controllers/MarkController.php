<?php

namespace App\Http\Controllers;

use App\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            if(isset($request->semester))
            {
                $courses= \App\Course::where('department_id',$request->department)->where('semester',$request->semester)->get(); 



                $marks = \App\Mark::whereHas('subject',function($q)use ($request)
                {
                    $q->whereHas('course',function($q)use($request)
                    {
                        $q->where('department_id',$request->department)->where('semester',$request->semester);
                    })->where('year',$request->year);
                })->get();
                // dd($marks);
                $arr = [];
                for($i=0;$i<count($marks);$i++){
                    $arr[$marks[$i]->student_id] = 1;
                }
                
                return view('admin.results.show')->with([
                    'courses'=>$courses,
                    'marks'=>$marks->load('subject'),
                    'arr' => $arr,
                    'semester' => $request->semester,
                    
                ]);
            }
            else
            return view('admin.results.index');
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
