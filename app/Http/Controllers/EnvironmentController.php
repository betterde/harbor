<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * 项目运行环境逻辑控制器
 *
 * Date: 2021/1/10
 * @author George
 * @package App\Http\Controllers
 */
class EnvironmentController extends Controller
{
    /**
     * Date: 2021/1/10
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @author George
     */
    public function index(Request $request): JsonResponse
    {
        $this->validate($request, [
            'project_id' => 'required|integer'
        ]);

        $limit = $request->get('limit');

        $search = $request->get('search');

        $query = Environment::query()->where('project_id', $request->get('project_id'));

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $result = $query->paginate($limit);

        return success($result);
    }
}
