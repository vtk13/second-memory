<?php
namespace App\Http\Controllers;

use App\Services\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{
    protected $userService;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserService $userService)
    {
        parent::__construct($entityManagerInterface);
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $input = $request->all();

            $newUser = $this->userService->create($input);
            $data = [
                'name' => $newUser->getName(),
                'email' => $newUser->getEmail(),
            ];
            return response()->json(['data' => $data]);
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json(['errors' => 'wrong email or password']);
        }
        return response()->json(['data' => $token]);
    }

}
