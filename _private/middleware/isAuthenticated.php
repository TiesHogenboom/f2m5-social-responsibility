<?php
namespace Website\middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class IsAuthenticated implements IMiddleware {

    public function handle(Request $request): void 
    {
    
        // Authenticate user, will be available using request()->user
        $user = loggedInUSer();

        if($user === false){
            redirect(url('login.form'));
            exit;
        }

        $request->user = $user;
    }
}