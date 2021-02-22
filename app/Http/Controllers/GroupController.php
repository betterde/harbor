<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * 用户组逻辑控制器
 *
 * Date: 2021/2/22
 * @author George
 * @package App\Http\Controllers
 */
class GroupController extends Controller
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

        /**
         * @var User $user
         */
        $user = auth()->user();

        $query = $user->groups();

        if ($search) {
            $query->where('name', 'like', "%$search%");
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
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|unique:groups',
            'cover' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $group = DB::transaction(function () use ($attributes, ) {
            $group = Group::create($attributes);

            Member::create([
                'resource_id' => $group->id,
                'resource_type' => 'group',
                'user_id' => Auth::user()->getAuthIdentifier(),
                'role' => 'owner',
            ]);

            return $group;
        });

        return stored($group);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return JsonResponse
     */
    public function show(Group $group): JsonResponse
    {
        return success($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function update(Request $request, Group $group): JsonResponse
    {
        $attributes = $this->validate($request, [
            'name' => 'required|string|unique:groups',
            'cover' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        if ($group->isOwner(Auth::user())) {
            $group->update($attributes);
        } else {
            return failed('你无权修改组设置', 422);
        }

        return success($group);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Group $group): JsonResponse
    {
        if ($group->projects()->count() > 0) {
            return failed('该用户组下存在项目，无法删除改组');
        }

        if ($group->delete()) {
            return deleted();
        }

        return internalError();
    }
}
