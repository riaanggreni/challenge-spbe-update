<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Models\User;

class AuthController extends Controller
{
    protected $BlogService;
    function __construct(
        BlogService $BlogService
    ) {
        $this->BlogService = $BlogService;
    }

    public function getData()
    {
        $blogs = $this->BlogService->getData();
        return $this->responSuccess(200,'Success',$blogs);
    }

    public function create(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('api_token',$token)->first();
        if (empty($user)) {
            return $this->responAuthFailed(301,'Anda tidak memiliki ijin !','Failed');
        }
        $request['created_user_id'] = $user->id;
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ],[
            'title.required' => 'title diperlukan !',
            'description.required' => 'description diperlukan !'
        ]);
        $blog = $this->BlogService->create($request->all());
        return $this->responSuccess(200,'Blog Berhasil Ditambahkan !',$blog);
    }
}
