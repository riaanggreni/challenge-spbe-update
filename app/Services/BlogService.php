<?php 

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogService
{
    public function getData()
    {
        return Blog::with('createdUser')->get();
    }

    public function find($blog_id)
    {
        // return Blog::with('createdUser')->find($blog_id);
        return Blog::with('createdUser')->where('id',$blog_id)->first();
    }

    public function create($data = [])
    {
        $data = $this->uploadFile($data);
        return Blog::create($data); 
    }

    public function uploadFile($data)
    {
        if (empty($data['image'])) {
            return $data;
        }
        $data['image'] = Storage::put('blog',$data['image']);
        return $data;
    }
}
