<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Post;

class PostValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::find($request->route('id'));
        // dd($post);
        if (!isset($post)) {
            return redirect()->back()->withErorrs(['message' => 'Post không tồn tại']);
        }
        return $next($request);
    }
}
