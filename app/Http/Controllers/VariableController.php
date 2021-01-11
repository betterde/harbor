<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * 环境变量逻辑控制器
 *
 * Date: 2021/1/10
 * @author George
 * @package App\Http\Controllers
 */
class VariableController extends Controller
{
    /**
     * 获取指定运行环境的变量
     *
     * Date: 2021/1/10
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @author George
     */
    public function index(Request $request): JsonResponse
    {
        $this->validate($request, [
            'environment_id' => 'required|integer'
        ]);

        $limit = $request->get('limit');

        $search = $request->get('search');

        $query = Variable::query()->where('environment_id', $request->get('environment_id'));

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $result = $query->paginate($limit);

        return success($result);
    }
}
