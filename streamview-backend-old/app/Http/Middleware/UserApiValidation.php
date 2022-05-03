<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use App\Helpers\Helper;

use Validator;

use Log;

use App\User;

use DB;

class UserApiValidation
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

        $validator = Validator::make(
                $request->all(),
                array(
                        'token' => 'required|min:5',
                        'id' => 'required|integer|exists:users,id'
                ));

        if ($validator->fails()) {

            $error_messages = implode(',', $validator->messages()->all());

            $response = array('success' => false, 'error' => $error_messages , 'error_code' => 3000, 'error_messages'=>Helper::get_error_message(3000) );

            return response()->json($response,200);

        } else {

            $token = $request->token;

            $user_id = $request->id;

            if (!Helper::is_token_valid('USER', $user_id, $token, $error)) {

                $response = response()->json($error, 200);
                
                return $response;
                
            } else {

                $user = User::find($request->id);

                \Session::put('user-lang-'.$user->id, $request->language);
                
                if(!$user) {
                    
                    $response = array('success' => false , 'error_messages' => Helper::get_error_message(133) , 'error_code' => 133);
                    return response()->json($response, 200);
                }

                if($user->is_activated == USER_DECLINED) {
                    
                    $response = ['success' => false , 'error' => Helper::get_error_message(905) , 'error_code' => 905];

                    return response()->json($response, 200);
               
                }
            }
        }

        return $next($request);
    }
}
