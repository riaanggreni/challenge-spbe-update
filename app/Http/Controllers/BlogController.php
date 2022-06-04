<?php

namespace App\Http\Controllers;

// use App\Helpers\ApiFormatter;
use App\Models\M_Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = M_Blog::all();

        // if($data){
        //     return ApiFormatter::createApi(200, 'Success', $data);
        // } else {
        //     return ApiFormatter::createApi(200, 'Failed');
        // }
        
        return view('index')->with([
            'results' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->except(['_token']);
        if($request->file('image')){
            $imgName = time().'.'.$request->file('image')->extension();
            $data['image'] = $request->file('image')->move('blog',$imgName);
        }
        M_Blog::insert($data);
        return redirect('/');
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
        $data = M_Blog::findOrFail($id);
        
        return view('edit')->with([
            'results' => $data
        ]);
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
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $item = M_Blog::findOrFail($id);
        $data = $request->except(['_token']);

        if($request->file('image')){

            if($item->image != ''){
                unlink($item->image);
            }
            
            
            $imgName = time().'.'.$request->file('image')->extension();
            $data['image'] = $request->file('image')->move('blog',$imgName);
        }
        $item->update($data);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = M_Blog::findOrFail($id);
        unlink($item->image);
        $item->delete();
        return redirect('/');
    }
}
