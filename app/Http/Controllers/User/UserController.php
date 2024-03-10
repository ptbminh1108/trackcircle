<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['user_groups'])->get();

        return view('admin.user.user-list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $user_groups = UserGroup::all();


        $button_submit_name = "Create";
        $url_submit = url('/user/create');

        if ($request->isMethod('post'))
        {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', Rules\Password::defaults()],
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_group_id' => $request->user_group_id,
                'password' =>  Hash::make($request->password),
                'status' => isset($request->status) ? 1 : 0,
            ]);
    
    
    
    
            return redirect('/user');
        }
        
        return view('admin.user.user-edit',compact('user_groups','button_submit_name','url_submit'));
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
    public function edit(string $id)
    {
        if($id){
            $user = User::where("id",'=',$id)->firstOrFail();
        }
        
        $user_groups = UserGroup::all();
        $button_submit_name = "Save";
        $url_submit = url('/user/edit/' . $id) ;


    return view('admin.user.user-edit',compact('user','user_groups','button_submit_name','url_submit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            // 'user_group_id' => ['required', 'int', 'exist:'.User::class],
        ]);

        $user = User::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'user_group_id' => $request->user_group_id,
            'status' => isset($request->status) ? 1 : 0,
        ]);

        // var_dump($request->name);
        // var_dump($request->email);
        // var_dump($request->password);



        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
