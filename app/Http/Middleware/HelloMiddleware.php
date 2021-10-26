<?php

namespace App\Http\Middleware;

use Closure;

class HelloMiddleware
{
    public function handle($request, Closure $next)
    {
        $data = [
            ['name'=>'山田たろう', 'mail'=>'taro@yamada'],
            ['name'=>'田中はなこ', 'mail'=>'hanako@flower'],
            ['name'=>'鈴木さちこ', 'mail'=>'sachico@happy'],
        ];
        $request->merge(['data'=>$data]);
        return $next($request);
    }
}
