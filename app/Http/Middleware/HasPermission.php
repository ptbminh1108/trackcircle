<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserGroup;
use Closure;
use Illuminate\Support\Facades\Auth;

class HasPermission
{
  /**
   * The names of the cookies that should not be encrypted.
   *
   * @var array<int, string>
   */

  public function handle($request, Closure $next)
  {
    $user = Auth::user();

    $permissions = UserGroup::where('id', '=',  $user->user_group_id)->first()['permissions'];
    if ($permissions) {
      foreach ($permissions as $permission) {
       

        if (preg_match( '#^'.preg_quote($permission) ."(NULL||/.*)$#",$request->getRequestUri())) {
          // echo $permission ."<br>";
          // echo $request->getRequestUri() ."<br>";
          return $next($request);
        }
      }
    }


    $common_route = ['/','/home','/dashboard'];
    if(in_array($request->getRequestUri(),$common_route)){
      return $next($request);
    }

  
    return redirect()->back();
  }
}
