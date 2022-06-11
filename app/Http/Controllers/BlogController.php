<?php

namespace App\Http\Controllers;

// use App\Helpers\ApiFormatter;

use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function view(){
        $data = DB::table('blog')
        ->join('category', 'blog.category_id', '=', 'category.id')->whereNull('deleted_at')->get();
        return response()->json([
            'data' => $data,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Blog::all();
        $data = DB::table('blog')
        ->join('category', 'blog.category_id', '=', 'category.id')->whereNull('deleted_at')->get();

        $data = Blog::latest()->get();
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
        $category = Category::all();

        return view('create', compact('category'));
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
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = $request->except(['_token']);
        if($request->file('image')){
            $imgName = time().'.'.$request->file('image')->extension();
            $data['image'] = $request->file('image')->move('blog',$imgName);
        }

        $Blog = Blog::create([
            'name' => $request->name,
            'desc' => $request->desc
         ]);
        
        return response()->json(['Program created successfully.', new BlogResource($Blog)]);

        Blog::insert($data);
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
        $Blog = Blog::find($id);
        if (is_null($Blog)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new BlogResource($Blog)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $data = Blog::findOrFail($id);
        
        return view('edit')->with([
            'results' => $data,
            'category' => $category
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

        $item = Blog::findOrFail($id);
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
        $item = Blog::findOrFail($id);
        unlink($item->image);
        $item->delete();
        return redirect('/');
        return response()->json('Blog deleted successfully');
    }
}
