<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\CommentInterface;
use App\Http\Requests\CommentRequest;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Traits\ApiDesignTrait;



use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use App\Http\Interfaces\PostInterface;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//use App\Http\Interfaces\PostInterface;
//use App\Http\Interfaces\PostInterface;



class CommentController extends Controller
{


    private $commentInterface;

    public function __construct(CommentInterface $commentInterface)
    {
        $this->commentInterface = $commentInterface;
    }

    public function addComment(CommentRequest $request){
        //dd($request);
        return $this->commentInterface->addComment($request);
    }

    public function allComments(){
        //dd($request);
        return $this->commentInterface->allComments();
    }

    public function deleteComment(CommentRequest $request){

        return $this->commentInterface->deleteComment($request);
    }



    public function specificComment(CommentRequest $request){

        return $this->commentInterface->specificComment($request);
    }



    public function updateComment(CommentRequest $request){

        return $this->commentInterface->updateComment($request);
    }

    public function toggleComment(CommentRequest $request){

        return $this->commentInterface->toggleComment($request);
    }

















    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'test', 'addTestUser']]);
    } */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
   /*  public function login()

    {
        $credentials = request(['email', 'password']);

        //dd(auth()->attempt($credentials));

        if (! $token = auth()->attempt($credentials)) {
            return $this->ApiResponse(422, 'unauthorized');
        }


        return $this->respondWithToken($token);
    } */


    /* public function login(){
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->ApiResponse(422, 'Unauthorized');
        }

        return $this->respondWithToken($token);
    } */




    /* public function addTestUser(Request $request){

        $validation = Validator::make($request->all(), [

            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required',

        ]);

        if ($validation->fails()){
            return $this->ApiResponse(422, 'Validation Error', $validation->errors());
        }



        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,

            'status' => 1,

            'role_id' => 1,
            'password' => Hash::make($request->password),
        ]);

        //return $this->ApiResponse(200, 'wait email');

        return $this->login();

    } */






    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
   /*  public function me()
    {
        return response()->json(auth()->user());
    } */

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /* public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    } */

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /* public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    } */

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /* protected function respondWithToken($token)
    {


        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
             //'expires_in' => auth()->factory()->getTTL() * 60
             'expires_in' => auth('api')->factory()->getTTL() * 60

        ]);
    } */
}
