<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function index(){

        $email = 'kek@mail.ru';
        $name = 'kek';
        $password = Hash::make('12345678');

        if(User::where('email', $email)->exists())
            return 'пользователь уже есть';

        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;
        $user->save();
        return true;
    }
}
