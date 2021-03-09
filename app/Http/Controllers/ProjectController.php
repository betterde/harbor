<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

/**
 * 项目逻辑控制器
 *
 * Date: 2021/1/12
 * @author George
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{
    /**
     * 获取项目列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $limit = $request->get('limit', config('app.query.limit'));

        $query = Project::query();

        if ($search = $request->get('search')) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('name', 'like', "%$search%")
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
            'group_id' => 'required|uuid',
            'description' => 'nullable|string',
            'cover' => 'nullable|string',
            'repository' => 'nullable|string',
        ]);

        $project = Project::create($attributes);
        return stored($project);
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        return success($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Project $project): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'cover' => 'nullable|string',
            'repository' => 'nullable|string',
        ]);

        $project->update($attributes);
        return updated($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Project $project): JsonResponse
    {
        if ($project->delete()) {
            return deleted();
        }

        return internalError('删除失败');
    }
}
