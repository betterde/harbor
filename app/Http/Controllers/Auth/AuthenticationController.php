<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * 用户认证逻辑控制器
 *
 * Date: 2021/2/22
 * @author George
 * @package App\Http\Controllers\Auth
 */
class AuthenticationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('signout');
    }

    /**
     * 用户登陆逻辑
     *
     * Date: 2018/10/15
     * @author George
     * @param Request $request
     * @param Hasher $hasher
     * @return JsonResponse
     * @throws ValidationException
     */
    public function signin(Request $request, Hasher $hasher): JsonResponse
    {
        $credentials = $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => '请输入您的账户',
            'password.required' => '请输入您的密码',
        ]);

        $credentials[$this->username()] = Arr::pull($credentials, 'username');
        $provider = new EloquentUserProvider($hasher, User::class);

        /**
         * 根据用户凭证获取用户信息
         *
         * @var User $user
         */
        $user = $provider->retrieveByCredentials($credentials);

        if ($user && $provider->validateCredentials($user, $credentials)) {
            $token = $user->createToken('API');

            return success([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'token_type' => 'Bearer',
                'access_token' => $token->plainTextToken,
            ]);
        }

        return failed('认证失败，用户名或密码不正确', 401);
    }

    /**
     * 注销登陆
     *
     * Date: 2018/10/14
     * @author George
     * @return JsonResponse
     */
    public function signout()
    {
        $this->guard()->logout();
        return message('注销成功');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return $request->only($this->username(), 'password');
    }

    /**
     * 获取用户凭证字段
     *
     * Date: 2018/9/9
     * @author George
     * @return string
     */
    public function username(): string
    {
        return 'email';
    }
}
