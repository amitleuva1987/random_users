<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_users(){
        $response = file_get_contents('https://randomuser.me/api?results=5');
        $data = json_decode($response,true);
        return $data['results'];
    }

    public function store_users(Request $request){
        
        foreach($request->users as $user){
            User::create([
                'name' => $user['name']['title']." ".$user['name']['first']." ".$user['name']['last'],
                'city' => $user['location']['city'],
                'country' => $user['location']['country'],
                'gender' => $user['gender'],
            ]);
        }
       return true;
    }
}
