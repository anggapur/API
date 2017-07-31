<?php

namespace App\Http\Middleware;

use Closure;

class cekApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
          if($request->header('user-key') !== $_ENV['API_KEY'])
        {
            if(empty($request->header('user-key')))
            {
                return redirect('notValid')->with('data','API KEY REQUIRED');
            }
            else
            {
                return redirect('notValid')->with('data','API KEY NOT VALID');
            }
        }

        return $next($request);
    }
}
