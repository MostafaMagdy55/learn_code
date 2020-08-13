<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks=Track::orderBy('id','desc')->paginate(20);
        return  view('admin.tracks.index',compact('tracks'));
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
        $rules=['name'=>'required|min:4'];
        $this->validate($request,$rules);

        Track::create($request->all());
        return redirect()->route('tracks.index')->withStatus('Track successfully created' );

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $track=Track::find($id);
        return view('admin.tracks.edit',compact('track'));
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
        $track=Track::find($id);
        $rules=['name'=>'required|min:4'];
        $this->validate($request,$rules);
        //$track->update($request->all());
        //return redirect()->route('tracks.index')->withStatus('Track successfully Updated' );
        if($request->has('name'))
        {
            $track->name=$request->name;
        }
        if($track->isDirty())
        {
            $track->save();
            return redirect()->route('tracks.index')->withStatus('Track successfully Updated' );
        }else{
            return redirect()->route('tracks.edit',$track->id)->withStatus('NO Thing Changed');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $track=Track::find($id);
        $track->delete();
        return redirect()->route('tracks.index')->withStatus('Track Deleted successfully');
    }
}
