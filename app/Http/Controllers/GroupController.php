<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', config('app.query.limit'));

        $query = Group::query();

        $user = auth()->user();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
