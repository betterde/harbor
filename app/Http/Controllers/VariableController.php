<?php

namespace App\Http\Controllers;

use Exception;
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

        $limit = $request->get('limit', config('app.query.limit'));

        $search = $request->get('search');

        $query = Variable::query()->where('environment_id', $request->get('environment_id'));

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        $result = $query->paginate($limit);

        return success($result);
    }

    /**
     * Date: 2021/2/20
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @author George
     */
    public function store(Request $request): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string',
            'type' => 'required|in:integer,string,float,boolean',
            'value' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $variable = Variable::create($attributes);
        return stored($variable);
    }

    /**
     * Date: 2021/2/20
     * @param Variable $variable
     * @return JsonResponse
     * @author George
     */
    public function show(Variable $variable): JsonResponse
    {
        return success($variable);
    }

    /**
     * Date: 2021/2/20
     * @param Request $request
     * @param Variable $variable
     * @return JsonResponse
     * @throws ValidationException
     * @author George
     */
    public function update(Request $request, Variable $variable): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string',
            'type' => 'required|in:integer,string,float,boolean',
            'value' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $variable->update($attributes);

        return success($variable);
    }

    /**
     * 删除环境变量
     *
     * Date: 2021/2/20
     * @param Variable $variable
     * @return JsonResponse
     * @throws Exception
     * @author George
     */
    public function destroy(Variable $variable): JsonResponse
    {
        if ($variable->environments()->count() > 0) {
            return failed('环境变量在其它环境中使用，无法删除');
        }

        if ($variable->delete()) {
            return deleted();
        }

        return internalError();
    }
}
