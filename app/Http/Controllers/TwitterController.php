<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
class TwitterController extends Controller
{
    //
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function redirectToTwitter(): RedirectResponse
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback(): RedirectResponse
    {
        try {
            if (request()->has('error')) {
                return response()->json(['error' => 'Has cancelado el inicio de sesión con Twitter.'], 400);
            }
            $socialUser = Socialite::driver('twitter')->user();

            if (!$socialUser) {
                return response()->json(['error' => 'Error al obtener datos del usuario de Twitter.'], 400);
            }
            $result = $this->authService->loginWithSocial($socialUser, 'twitter');
            $token = $result['token'];

            $frontUrl = env('FRONT_URL', 'http://localhost:5173'); 
            return redirect()->away("{$frontUrl}auth/callback?token=$token");

          
        } catch (\Throwable $e) {
            Log::error('Error en Twitter Callback: ' . $e->getMessage());
            return response()->json(['error' => 'Error al procesar la respuesta de Twitter.'], 500);
        }
    }
}
