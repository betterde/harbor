<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Server;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

/**
 * 服务器管理逻辑控制器
 *
 * Date: 2021/2/22
 * @author George
 * @package App\Http\Controllers
 */
class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->get('limit', config('app.query.limit'));
        $search = $request->get('search');
        $query = Server::query();

        if ($search) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('id', 'like', "%$search%")
                    ->orWhere('name', 'like',"%$search%")
                    ->orWhere('ip', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        $result = $query->paginate($limit);

        return success($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'ip' => 'required|string',
            'port' => 'required|integer|between:1,65535',
            'username' => 'required|string',
            'authentication' => 'required|string',
            'certificate' => 'required|string',
            'core' => 'required|integer',
            'memory' => 'required|integer',
        ]);

        $attributes['id'] = Str::uuid()->toString();
        $server = Server::create($attributes);
        return stored($server);
    }

    /**
     * Display the specified resource.
     *
     * @param Server $server
     * @return JsonResponse
     */
    public function show(Server $server): JsonResponse
    {
        return success($server);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Server $server
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Server $server): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'ip' => 'required|string',
            'port' => 'required|integer|between:1,65535',
            'username' => 'required|string',
            'authentication' => 'required|string',
            'certificate' => 'required|string',
            'core' => 'required|integer',
            'memory' => 'required|integer',
        ]);

        $server->update($attributes);
        return updated($server);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Server $server
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Server $server): JsonResponse
    {
        if ($server->environments()->count() > 0) {
            return failed('服务器上还存在运行环境，无法删除！');
        }

        if ($server->delete()) {
            return deleted();
        }

        return internalError();
    }
}
