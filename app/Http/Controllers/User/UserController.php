<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];

        $user_login_id = Auth::id();
        $data['users'] = User::with(['user_groups'])->where('id', '!=', $user_login_id)->get();

        // Breadcrumb
        $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' =>__('admin.dashboard'),
			'href' => url("/dashboard")
		);

		$data['breadcrumbs'][] = array(
			'text' => __('admin.user'),
			'href' => url("/user/list")
		);

        $data['url_create'] = url("/user/create");
        $data['title'] = __("admin.user");

        return view('admin.user.user-list', compact('data'));
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
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', Rules\Password::defaults()],
            ]);

            if ($validator->fails()) {

                return redirect()->to($request->getRequestUri())
                    ->withInput($request->input())
                    ->withErrors($validator->errors());
            }

            if ($validator->passes()) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'user_group_id' => $request->user_group_id,
                    'password' =>  Hash::make($request->password),
                    'status' => isset($request->status) ? 1 : 0,
                ]);

                if ($user) {
                    return redirect('/user/list');
                }
            }


            // return redirect()->to($request->getRequestUri())
            // ->withInput($request->input())
            // ->withErrors($validator->errors(), $this->errorBag());
        }


        if (array_key_exists('name', $request->old())) {
            $data['user']['name'] = $request->old('name');
        } else {
            $data['user']['name'] = '';
        }

        // email
        if (array_key_exists('email', $request->old())) {
            $data['user']['email'] = $request->old('email');
        } else {
            $data['user']['email'] = '';
        }

        // status
        if (array_key_exists('status', $request->old())) {
            $data['user']['status'] = $request->old('status');
        } else {
            $data['user']['status'] = '';
        }

        // group_id
        if (array_key_exists('user_group_id', $request->old())) {
            $data['user']['user_group_id'] = $request->old('user_group_id');
        } else {
            $data['user']['user_group_id'] = '';
        }

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' =>__('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.user'),
            'href' => url("/user/list")
        );

        $user_groups = UserGroup::all();
        $data['user_groups'] = UserGroup::all();
        $data['button_submit_name'] = "Create";
        $data['url_submit'] = url('/user/create');
        $data['title'] = __("admin.user");

        return view('admin.user.user-edit', compact('data'));
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
        // //
        // if($id){
        //     $user = User::where("id",'=',$id)->firstOrFail();
        // }
        // $user_groups = UserGroup::all();

        // return view('admin.user.user-edit', compact('user','user_groups'));

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
            $user  = User::where("id", '=', $id)->firstOrFail();
            $data['user']['id'] = $user['id'];
        }

        // Get previous request
        // Name

        if (array_key_exists('name', $request->old())) {
            $data['user']['name'] = $request->old('name');
        } elseif ($user) {
            $data['user']['name'] = $user['name'];
        } else {
            $data['user']['name'] = '';
        }

        // email
        if (array_key_exists('email', $request->old())) {
            $data['user']['email'] = $request->old('email');
        } elseif ($user) {
            $data['user']['email'] = $user['email'];
        } else {
            $data['user']['email'] = '';
        }

        // status
        if (array_key_exists('status', $request->old())) {
            $data['user']['status'] = $request->old('status');
        } elseif ($user) {
            $data['user']['status'] = $user['status'];
        } else {
            $data['user']['status'] = '';
        }

        // group_id
        if (array_key_exists('user_group_id', $request->old())) {
            $data['user']['user_group_id'] = $request->old('user_group_id');
        } elseif ($user) {
            $data['user']['user_group_id'] = $user['user_group_id'];
        } else {
            $data['user']['user_group_id'] = '';
        }

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' =>__('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.user'),
            'href' => url("/user/list")
        );

        $data['user_groups'] = UserGroup::all();
        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/user/edit/' . $id);
        $data['title'] = __("admin.user");


        return view('admin.user.user-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            // 'user_group_id' => ['required', 'int', 'exist:'.User::class],
        ]);


        if ($validator->fails()) {

            return redirect()->to($request->getRequestUri())
                ->withInput($request->input())
                ->withErrors($validator->errors());
        }

        if ($validator->passes()) {
            $user = User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'user_group_id' => $request->user_group_id,
                'status' => isset($request->status) ? 1 : 0,
            ]);

            if ($user) {
                return redirect('/user/list');
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
        $user_login_id = Auth::id();

        $user = User::where('id', '=', $id)->where('id', '!=', $user_login_id);

        if ($user) {
            $user->delete();
            return redirect('/user/list');
        }
    }
}
