<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

/**
 * 项目日志逻辑控制器
 *
 * Date: 2021/3/9
 * @author George <george@betterde.com>
 * @package App\Http\Controllers
 */
class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Journal::query();

        $project_id = $request->get('project_id');
        if ($project_id) {
            $query->where('project_id', $project_id);
        }

        $environment_id = $request->get('environment_id');
        if ($environment_id) {
            $query->where('environment_id', $environment_id);
        }

        $operator_id = $request->get('operator_id');
        if ($operator_id) {
            $query->where('operator_id', $operator_id);
        }

        $operator_type = $request->get('operator_type');
        if ($operator_type) {
            $query->where('operator_type', $operator_type);
        }

        $resource_id = $request->get('resource_id');
        if ($resource_id) {
            $query->where('resource_id', $resource_id);
        }

        $resource_type = $request->get('resource_type');
        if ($resource_type) {
            $query->where('resource_type', $resource_type);
        }

        $action = $request->get('action');
        if ($action) {
            $query->where('action', $action);
        }

        $uri = $request->get('uri');
        if ($uri) {
            $query->where('uri', 'like', "%$uri%");
        }

        $begin = $request->get('begin');
        $after = $request->get('after');

        if ($begin && $after) {
            $range = [
                Carbon::parse($begin),
                Carbon::parse($after)
            ];
            $query->whereBetween('created_at', $range);
        }

        $limit = $request->get('limit', 15);

        $paginate = $query->paginate($limit);

        return success($paginate);
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
            'project_id' => 'required|uuid',
            'environment_id' => 'required|uuid',
            'operator_id' => 'required|string',
            'operator_type' => 'required|string',
            'resource_id' => 'required|string',
            'resource_type' => 'required|string',
            'action' => 'required',
            'query' => 'nullable|json',
            'body' => 'nullable|json',
            'uri' => 'required|string',
            'origin' => 'nullable|json',
            'modified' => 'nullable|json',
        ]);

        Journal::create($attributes);

        return message('请求成功');
    }

    /**
     * Display the specified resource.
     *
     * @param Journal $journal
     * @return JsonResponse
     */
    public function show(Journal $journal): JsonResponse
    {
        return success($journal);
    }
}
