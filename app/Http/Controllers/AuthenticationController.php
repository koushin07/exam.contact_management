<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\LogoutRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Models\User;
use App\Services\AuthenticationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{

    protected $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService=$authenticationService;
    }

    public function login(LoginRequest $request)
    {
        try{

            $credentials = $request->only('username', 'password');


            if(!Auth::attempt($credentials)){
                return $this->unauthorize();
            }
            /** @var \App\Models\MyUserModel $user **/
            $user = Auth::user();
            $token = $user->createToken('my-token');

            $response=[
                'user' =>$user->first_name,
                'token' =>$token->plainTextToken
            ];
            return $this->ok($response);


        }catch(Exception $e){
            return $this->error($e);
        }
    }

    public function register(RegisterRequest $request){
        try{
            // return $this->ok($request->first_name);
            DB::beginTransaction();
            $request->validated();
            $user =  $this->authenticationService->register($request);
            DB::commit();
            return $this->ok($user);
        }catch(Exception $e){
            return $this->error($e);
            DB::rollBack();
        }
    }

    public function logout($id)
    {
        try {
            $user = User::find($id); // Get the authenticated user
            if (!$user) {
                return $this->unauthorize();
            }

            $user->tokens()->delete(); // Revoke all tokens for the user

            return $this->ok(['message' => 'Logged out successfully']);
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
