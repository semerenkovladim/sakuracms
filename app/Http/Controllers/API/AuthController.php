<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // Проверяем существует ли пользователь с указанным email адресом
        $user = User::whereEmail(request('email'))->first();

        if (!$user) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }

        // Если пользователь с таким email адресом найден - проверим совпадает
        // ли его пароль с указанным
        if (!Hash::check(request('password'), $user->password)) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }
        if (! $user->is_admin) {
            return response()->json([
                'message' => 'You has not access to admin panel',
                'status' => 403
            ], 403);
        }

        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => request('email'),
            'password' => request('password'),
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);
        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Wrong email or password',
                'status' => 422
            ], 422);
        }
        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent(), true);
        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'token' => $data['access_token'],
            'refresh_token' => $data['refresh_token'],
            'user' => $user,
            'status' => 200
        ]);
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }

    public function refresh() {
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'refresh_token',
            'refresh_token' => request('refresh_token'),
            'scope' => '',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);
        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent(), true);
        return $data;
        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'token' => $data['access_token'],
            'status' => 200
        ]);
    }
}
