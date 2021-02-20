<?php

namespace App\Http\Controllers;

use Exception;
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

    /**
     * 创建运行环境
     *
     * Date: 2021/2/20
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @author Gorge
     */
    public function store(Request $request): JsonResponse
    {
        $attributes = $this->validate($request, [
            'project_id' => 'required|uuid',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $environment = Environment::create($attributes);
        return stored($environment);
    }

    /**
     * Date: 2021/1/27
     * @param Environment $environment
     * @return JsonResponse
     * @author George
     */
    public function show(Environment $environment): JsonResponse
    {
        return success($environment);
    }

    /**
     * Date: 2021/2/20
     * @param Request $request
     * @param Environment $environment
     * @return JsonResponse
     * @throws ValidationException
     * @author George
     */
    public function update(Request $request, Environment $environment): JsonResponse
    {
        $attributes = $this->validate($request, [
            'project_id' => 'required|uuid',
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $environment->update($attributes);
        return success($environment);
    }

    /**
     * Date: 2021/2/20
     * @param Environment $environment
     * @return JsonResponse
     * @throws Exception
     * @author George
     */
    public function destroy(Environment $environment): JsonResponse
    {
        if ($environment->delete()) {
            return deleted();
        }

        return internalError();
    }
}
