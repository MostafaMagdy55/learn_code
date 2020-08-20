<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Photo;
use App\Track;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses=Course::orderBy('id','desc')->paginate(15);
        return view('admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tracks=Track::all();
        return view('admin.courses.create',compact('tracks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:20|max:150',
            'status' => 'required|integer|in:0,1',
            'link' => 'required|url',
            'track_id' => 'required|integer',
        ];


       $course=Course::create([
        'title' => $request->title,
        'status' => $request->status,
        'link' => $request->link,
        'track_id' => $request->track_id,
       ]);

        $this->validate($request, $rules);

        if($course){

            if($request->has('image')){

                $photo=$request->image->getClientOriginalName();
                $photo_name=time().$photo;
                $request->image->move('images',$photo_name);

                Photo::create([
                 'filename'=> $photo_name,
                 'photoable_id'=>$course->id,
                 'photoable_type'=>'App\Course',
                ]);

                }
                return redirect('/admin/courses')->withStatus('Course successfully created.');
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('admin.courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        return view('admin.courses.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course=Course::find($id);

        $course->update([

        'title' => $request->title,
        'status' => $request->status,
        'link' => $request->link,
        'track_id' => $request->track_id,
        ]);


            if($request->has('image')){

                $photo=$request->image->getClientOriginalName();
                $photo_name=time().$photo;
                $request->image->move('images',$photo_name);


               if($course->photo)
               {
                $photomodel=Photo::find($course->photo->id);
                $remove_photo=$course->photo->filename;
                unlink('images/'.$remove_photo);
                $photomodel->update([
                    'filename'=> $photo_name,
                    'photoable_id'=>$course->id,
                    'photoable_type'=>'App\Course',
                   ]);

               }else{  Photo::create([
                'filename'=> $photo_name,
                'photoable_id'=>$course->id,
                'photoable_type'=>'App\Course',
               ]);
}

                }
                return redirect('/admin/courses')->withStatus('Course successfully created.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $course=Course::find($id);

           if($course->photo)
           {
            $filename=$course->photo->filename;
           }

           $course->photo->delete();

           unlink('images/'.$filename);

           $course->delete();
           return redirect('/admin/courses')->withStatus('Course successfully Deleted.');
    }
}
