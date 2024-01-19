<?php

// app/Http/Middleware/CheckAdministratif.php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class CheckAdministratif extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        $user = User::find(Auth::user()->id);
        if (Auth::check() &&$user->isAdmin()) {
            return $request->expectsJson() ? null : route('login');
        }

    }
   
}
