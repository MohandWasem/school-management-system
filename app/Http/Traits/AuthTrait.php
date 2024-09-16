<?php

namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait 
{
    public function checkGuard($request)
    {
        if($request->type == 'student'){
            $guardName = 'student';
        } elseif ($request->type == 'teacher'){
            $guardName = 'teacher';
        } elseif ($request->type == 'parent'){
            $guardName = 'parent';
        } else {
            $guardName = 'web';
        }

        return $guardName;

    }

    public function redirect($request)
    {
        if($request->type == 'student'){
            return redirect()->intended(RouteServiceProvider::STUDENT);

        } elseif ($request->type == 'teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);

        } elseif ($request->type == 'parent'){
            return redirect()->intended(RouteServiceProvider::PARENT);

        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }
}