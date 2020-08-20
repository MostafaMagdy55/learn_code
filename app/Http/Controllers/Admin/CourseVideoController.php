<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Video;
use Illuminate\Http\Request;

class CourseVideoController extends Controller
{



    public function create(Course $course)
    {
        return view('admin.courses.createvideo', compact('course'));

    }

    public function store(Request $request ,Course $course )
    {

        $rules=[
            'title'=>'required|',
            'link'=>'required|url',
            'course_id'=>'required',
        ];
        $this->validate($request,$rules);
        Video::create($request->all());
        return redirect()->route('courses.show',$course->id)->withStatus('the video Created succesfully ');
    }

}
