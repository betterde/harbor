<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * 用户账户逻辑控制器
 *
 * Date: 2021/2/24
 * @author George
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    /**
     * Date: 2021/2/24
     * @param Request $request
     * @return JsonResponse
     * @author George
     */
    public function profile(Request $request): JsonResponse
    {
        $user = Auth::user();
        return success($user);
    }
}
