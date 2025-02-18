<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::whereNot('id',auth()->id())->get();
        return UserResource::collection($users);
    }
    public function post(User $user){
        $posts = $user->posts;
        return PostResource::collection($posts);
    }
    public function toggleFollowing(User $user){
        $res  = auth()->user()->followings()->toggle($user->id);
        $data['is_followed'] = count($res['attached']) > 0;
        return $data;
    }
}
