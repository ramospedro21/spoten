<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

	/**
	 * Autenticar dados e retornar token
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login (Request $request) {

		$credentials = $request->validate([
			'email' => 'required',
			'password' => 'required'
		]);

		if (Auth::attempt($credentials)) {

			/** @var User $user */
			$user = User::query()->firstWhere('email', '=', $credentials['email']);

			$token = $user
				->createToken($request->header('user-agent', 'Unknown Device'))
				->plainTextToken;

			return response()->json([
				'user' => $user,
				'token' => $token
			]);

		}

		# Caso as credencias sejam inválidas,
		# atrasar a resposta do servidor
		if (!env('APP_ENV') === 'testing')
			sleep(1);

		return response()->json([
			'message' => 'The provided credentials do not match our records.'
		], 401);

	}

	/**
	 * Retornar dados do usuário logado
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function user () {
		return response()->json(Auth::user());
	}

	/**
	 * Registrar um novo usuário
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function register (Request $request) {

		$data = $request->validate([
			'email' => 'required | email | unique:users,email',
			'cpf' => 'required | unique:users,cpf',
			'name' => 'required',
			'password' => 'required | min:6 | confirmed'
		]);

		$user = new User($data);

		$user->is_active = true;
		$user->type = User::TYPE['INVESTOR'];
		$user->password = bcrypt($data['password']);

		$user->save();

		return response()->json($user);

	}

	/**
	 * Remover token
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout (Request $request) {

		// Revoke the token that was used to authenticate the current request...
		$request->user()->currentAccessToken()->delete();

		return response(null, 204);

	}
}
