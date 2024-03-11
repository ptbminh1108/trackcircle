<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [];
        $data['user_groups'] = UserGroup::get();


        return view('admin.user-group.user-group-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [];


        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {

                return redirect()->to($request->getRequestUri())
                    ->withInput($request->input())
                    ->withErrors($validator->errors());
            }

            if ($validator->passes()) {
                $user_group = UserGroup::create([
                    'name' => $request->name,
                    'permission_type' => $request->permission_type,
                    'permissions' =>$request->permissions,
                ]);

                var_dump(json_encode($request->permissions, true));
                if ($user_group) {
                    return redirect('/user-group');
                }
            }


            return redirect()->to($request->getRequestUri())
            ->withInput($request->input())
            ->withErrors($validator->errors(), $this->errorBag());
        }


        if (array_key_exists('name', $request->old())) {
            $data['user']['name'] = $request->old('name');
        } else {
            $data['user']['name'] = '';
        }

      
    



        if (array_key_exists('name', $request->old())) {
            $data['user_group']['name'] = $request->old('name');
        }  else {
            $data['user_group']['name'] = '';
        }

        // permission_type
        if (array_key_exists('user_group_id', $request->old())) {
            $data['user_group']['permission_type'] = $request->old('permission_type');
        }else {
            $data['user_group']['permission_type'] = '';
        }

        // permissions
        if (array_key_exists('permissions', $request->old())) {
            $data['user_group']['permissions'] = $request->old('permissions');
        } else {
            $data['user_group']['permissions'] = [];
        }

        $data['permission_list'] = [
            '/user',
            '/user/create',
            '/user/edit',
            '/user/delete',

            '/user-group',
            '/user-group/create',
            '/user-group/edit',
            '/user-group/delete',

            '/item',
            '/item/create',
            '/item/edit',
            '/item/delete',
            '/item/all',

        ];

        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/user-group/create/');

        return view('admin.user-group.user-group-edit', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $data = [];

        // get error from session
        // $errors = session()->get('errors', app(ViewErrorBag::class));

        if ($id) {
            $user_group  = UserGroup::where("id", '=', $id)->firstOrFail();
            $data['user_group']['id'] = $user_group['id'];
        }

        // Get previous request
        // Name

        if (array_key_exists('name', $request->old())) {
            $data['user_group']['name'] = $request->old('name');
        } elseif ($user_group['name']) {
            $data['user_group']['name'] = $user_group['name'];
        } else {
            $data['user_group']['name'] = '';
        }

        // permission_type
        if (array_key_exists('user_group_id', $request->old())) {
            $data['user_group']['permission_type'] = $request->old('permission_type');
        } elseif ($user_group['permission_type']) {
            $data['user_group']['permission_type'] = $user_group['permission_type'];
        } else {
            $data['user_group']['permission_type'] = '';
        }

        // permissions
        if (array_key_exists('permissions', $request->old())) {
            $data['user_group']['permissions'] = $request->old('permissions');
        } elseif ($user_group['permissions']) {
            $data['user_group']['permissions'] = $user_group['permissions'];
        } else {
            $data['user_group']['permissions'] = [];
        }

        $data['permission_list'] = [
            '/user',
            '/user/create',
            '/user/edit',
            '/user/delete',

            '/user-group',
            '/user-group/create',
            '/user-group/edit',
            '/user-group/delete',

            '/item',
            '/item/create',
            '/item/edit',
            '/item/delete',
            '/item/all',

            '/manufacturer',
            '/manufacturer/create',
            '/manufacturer/edit',
            '/manufacturer/delete',
            '/manufacturer/all',

        ];

        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/user-group/edit/' . $id);


        return view('admin.user-group.user-group-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);


        if ($validator->fails()) {

            return redirect()->to($request->getRequestUri())
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        if ($validator->passes()) {
            $user_group = UserGroup::where('id', $id)->update([
                'name' => $request->name,
                'permission_type' => $request->permission_type,
                'permissions' =>$request->permissions,
            ]);

            if ($user_group) {
                return redirect('/user-group');
            }
        }


        return redirect()->to($request->getRequestUri())
            ->withInput($request->input())
            ->withErrors($validator->errors(), $this->errorBag());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
