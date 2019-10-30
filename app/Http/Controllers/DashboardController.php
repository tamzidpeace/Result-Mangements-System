<?php

namespace App\Http\Controllers;

use App\Mark;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function student()
    {
        $student = \Auth::user()->userable;
        $cgpas = $student->cgpas;




        $ccgpa = 0;
        $marks = \App\Student::find($student->id)->marks;

        $total = 0;
        $total_credit = 0;
        foreach ($marks as $m) {
            $total += $m->gpa * $m->subject->course->credit;
            $total_credit += $m->subject->course->credit;
        }

        if ($total_credit == 0) $ccgpa = 0;
        else $ccgpa = round($total / $total_credit, 2);




        return view('dashboard.student')->with(['cgpas' => $cgpas, 'ccgpa' => $ccgpa]);
    }
    public function teacher()
    {
        $subjects = \Auth::user()->userable->subjects;

        return view('dashboard.teacher')->with(['ss' => $subjects]);
    }
    public function teacheraddcourse(Request $request)
    {
        if (!\Gate::allows('approved')) {
            $request->session()->flash('msg', 'you need to be approved first');
            return redirect()->back();
        }

        if (isset($request->year)) //2nd step
        {
            //validate year semester dept
            $courses = \App\Course::where('semester', $request->semester)->where('department_id', $request->department)->get();
            return view('dashboard.teacheraddcourseshow')->with(['courses' => $courses, "year" => $request->year]);
        } else //1st step
        {
            return view('dashboard.teacheraddcourse');
        }
    }
    public function studentaddcourse(Request $request)
    {

        if (isset($request->year)) //2nd step
        {

            $subjects = \App\Subject::whereHas('course', function ($q) use ($request) {
                $q->where('semester', $request->semester)->where('department_id', $request->department);
            })->where('year', $request->year)->get();
            return view('dashboard.studentaddcourseshow')->with(['subjects' => $subjects->load('course'), "year" => $request->year]);
        }
        return view('dashboard.studentaddcourse');
    }
    public function studentregister(Request $request, \App\Subject $subject)
    {

        $mark = new \App\Mark;

        $mark->student_id = \Auth::user()->userable->id;
        $mark->subject_id = $subject->id;
        $mark->year = $request->year;
        $mark->save();
        //$subject->marks->save($mark);
        return redirect()->back();
    }
    public function studentunregister(Request $request, \App\Subject $subject)
    {
        $mark = \App\Mark::where('year', $request->year)->where('student_id', \Auth::user()->userable->id)->where('subject_id', $subject->id)->first();

        $mark->delete();

        return redirect()->back();
    }
    public function result()
    {

        $subjects = \App\Subject::where('teacher_id', \Auth::user()->userable->id)->with('course')->get();

        return view('dashboard.teacherresult')->with(['subjects' => $subjects]);
    }

    // my work

    public function teacherResultOption(\App\Subject $subject)
    {

        $marks = $subject->marks()->with('student')->get();
        //dd($marks);
        return view('dashboard.teacher_incourse_result', compact('marks'));
    }

    public function semesterFinalResult(\App\Subject $subject)
    {

        $marks = $subject->marks()->with('student')->get();
        //dd($marks);
        return view('dashboard.teacher_semister_final_result', compact('marks'));
    }

    // end of my work

    public function teacherResultSubject(\App\Subject $subject)
    {

        $marks = $subject->marks()->with('student')->get();

        //dd($subject);
        return view('dashboard.teacherResultSubject')->with(['marks' => $marks]);
    }

    public function teacherIncourseMarksEdit(\App\Mark $mark)
    {

        //return 123;
        return view('dashboard.teacher_incourse_mark_update')->with(['mark' => $mark->load('student')]);
    }

    public function teacherIncourseMarksStore(Request $request, \App\Mark $mark)
    {
        $mark->tt1 = $request->tt1;
        $mark->tt2 = $request->tt2;
        $mark->tt3 = $request->tt3;
        $mark->ttt = $request->ttt;
        $mark->attendance = $request->attendance;
        
        $mark->save();

        return redirect('/dashboard/teacher/result');
    }

    public function teacherSemFinalMarkEdit(\App\Mark $mark)
    {
        return view('dashboard.teacher_semester_final_result_update')->with(['mark' => $mark->load('student')]);
    }

    public function teacherSemFinalMarkStore(Request $request, \App\Mark $mark)
    {

        
        $mark->part_a = $request->part_a;
        $mark->part_b = $request->part_b;
        
        $total = $mark->part_a + $mark->part_b + $mark->attendance + $mark->ttt;
        $mark->total = $total;

        if ($total >= 00.00) $mark->gpa = 0.00;
        if ($total >= 40.00) $mark->gpa = 2.00;
        if ($total >= 45.00) $mark->gpa = 2.25;
        if ($total >= 50.00) $mark->gpa = 2.50;
        if ($total >= 55.00) $mark->gpa = 2.75;
        if ($total >= 60.00) $mark->gpa = 3.00;
        if ($total >= 65.00) $mark->gpa = 3.25;
        if ($total >= 70.00) $mark->gpa = 3.50;
        if ($total >= 75.00) $mark->gpa = 3.75;
        if ($total >= 80.00) $mark->gpa = 4.00;

        

        $mark->save();
        $cgpa = \App\Student::find($mark->student_id)->cgpas()->where('semester', $mark->subject->course->semester)->first();
        // cgpa should be updated
        $marks = \App\Student::find($mark->student_id)->marks()->whereHas('subject', function ($q) use ($mark) {
            $q->whereHas('course', function ($q) use ($mark) {
                $q->where('semester', $mark->subject->course->semester);
            });
        })->with('subject.course')->get();

        $total = 0;
        $total_credit = 0;
        foreach ($marks as $m) {
            $total += $m->gpa * $m->subject->course->credit;
            $total_credit += $m->subject->course->credit;
        }

        $cgpa->gpa = $total / $total_credit;
        $cgpa->save();
        return redirect('/dashboard/teacher/result');
    }

    public function teacherResultMarkEdit(\App\Mark $mark)
    {

        return view('dashboard.teacherResultMarkEdit')->with(['mark' => $mark->load('student')]);
    }
    public function teacherResultMarkStore(Request $request, \App\Mark $mark)
    {

        $mark->tt1 = $request->tt1;
        $mark->tt2 = $request->tt2;
        $mark->tt3 = $request->tt3;
        $mark->ttt = $request->ttt;
        $mark->part_a = $request->part_a;
        $mark->part_b = $request->part_b;
        $mark->attendance = $request->attendance;
        $mark->total = $request->total;
        if ($request->total >= 00.00) $mark->gpa = 0.00;
        if ($request->total >= 40.00) $mark->gpa = 2.00;
        if ($request->total >= 45.00) $mark->gpa = 2.25;
        if ($request->total >= 50.00) $mark->gpa = 2.50;
        if ($request->total >= 55.00) $mark->gpa = 2.75;
        if ($request->total >= 60.00) $mark->gpa = 3.00;
        if ($request->total >= 65.00) $mark->gpa = 3.25;
        if ($request->total >= 70.00) $mark->gpa = 3.50;
        if ($request->total >= 75.00) $mark->gpa = 3.75;
        if ($request->total >= 80.00) $mark->gpa = 4.00;
        $mark->save();
        $cgpa = \App\Student::find($mark->student_id)->cgpas()->where('semester', $mark->subject->course->semester)->first();
        // cgpa should be updated
        $marks = \App\Student::find($mark->student_id)->marks()->whereHas('subject', function ($q) use ($mark) {
            $q->whereHas('course', function ($q) use ($mark) {
                $q->where('semester', $mark->subject->course->semester);
            });
        })->with('subject.course')->get();

        $total = 0;
        $total_credit = 0;
        foreach ($marks as $m) {
            $total += $m->gpa * $m->subject->course->credit;
            $total_credit += $m->subject->course->credit;
        }

        $cgpa->gpa = $total / $total_credit;
        $cgpa->save();
        return redirect('/dashboard/teacher/result');
    }

    public function teacherIncourseMarkStore(Request $request, \App\Mark $mark)
    { }

    public function studentresult(Request $request)
    {

        if (isset($request->year)) {
            $marks = \App\Mark::where('student_id', \Auth::user()->userable->id)
                ->where('year', $request->year)->whereHas('subject', function ($q) use ($request) {
                    $q->whereHas('course', function ($q) use ($request) {
                        $q->where('semester', $request->semester);
                    });
                })->get();
            return view('dashboard.studentresulttable')->with(['marks' => $marks->load('subject.course')]);
        } else

            return view('dashboard.studentresultshow');
    }
    public function submit(Request $request)
    {

        //dd(\App\Course::where('semester',$request->semester)->where('department_id',$request->department)->get());
        dd(\App\Subject::where('year', $request->year)->get());
    }
}
