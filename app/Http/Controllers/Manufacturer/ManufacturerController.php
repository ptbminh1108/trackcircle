<?php

namespace App\Http\Controllers\Manufacturer;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];

        $user_login_id = Auth::id();

        $manufacturers = Manufacturer::where('user_id', '=', $user_login_id)->get();

        $data['manufacturers'] = [];
        foreach($manufacturers as $manufacturer){
            $data['manufacturers'][] = array(
                "name" => $manufacturer['name'],
                "description" => $manufacturer['description'],
                "created_time" => $manufacturer['created_at'],
                "updated_time" => $manufacturer['updated_at'],
                "action" => ' <a class="badge bg-success" href="'.url("/user/edit/" . $manufacturer->id).'">  <i data-feather="edit"></i> </a>  <form method="post" action="'.url("/user/delete/" . $manufacturer->id).'"> '.csrf_field().'<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.manufacturer'),
            'href' => url("/manufacturer/list")
        );
        $data['url_create'] = url("/manufacturer/create");
        $data['title'] = __("admin.manufacturer");

        return view('admin.manufacturer.manufacturer-list', compact('data'));
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

                $user_login_id = Auth::id();
                $manufacturer = Manufacturer::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'user_id' => $user_login_id
                ]);

                if ($manufacturer) {
                    return redirect('/manufacturer/list');
                }
            }


            // return redirect()->to($request->getRequestUri())
            // ->withInput($request->input())
            // ->withErrors($validator->errors(), $this->errorBag());
        }


        if (array_key_exists('name', $request->old())) {
            $data['manufacturer']['name'] = $request->old('name');
        } else {
            $data['manufacturer']['name'] = '';
        }

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.user_group'),
            'href' => url("/user/list")
        );

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.manufacturer'),
            'href' => url("/manufacturer/list")
        );

        $data['button_submit_name'] = "Create";
        $data['url_submit'] = url('/manufacturer/create');
        $data['title'] = __("admin.manufacturer");

        return view('admin.manufacturer.manufacturer-edit', compact('data'));
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
            $manufacturer  = Manufacturer::where("id", '=', $id)->firstOrFail();
            $data['manufacturer']['id'] = $manufacturer['id'];
        }

        // Get previous request
        // Name

        if (array_key_exists('name', $request->old())) {
            $data['manufacturer']['name'] = $request->old('name');
        } elseif ($manufacturer) {
            $data['manufacturer']['name'] = $manufacturer['name'];
        } else {
            $data['manufacturer']['name'] = '';
        }

        // email
        if (array_key_exists('description', $request->old())) {
            $data['manufacturer']['description'] = $request->old('email');
        } elseif ($manufacturer) {
            $data['manufacturer']['description'] = $manufacturer['description'];
        } else {
            $data['manufacturer']['description'] = '';
        }

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.manufacturer'),
            'href' => url("/manufacturer/list")
        );



        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/manufacturer/edit/' . $id);
        $data['title'] = __("admin.manufacturer");


        return view('admin.manufacturer.manufacturer-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);



        if ($validator->passes()) {
            $manufacturer = Manufacturer::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            if ($manufacturer) {
                return redirect('/manufacturer/list');
            }
        }


        return redirect()->to($request->getRequestUri())
            ->withInput($request->input())
            ->withErrors($validator->errors(), $this->errorBag());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user_login_id = Auth::id();

        $manufacturer = Manufacturer::where('user_id', '=', $user_login_id)->where('id', '=', $id);
        if ($manufacturer) {
            $manufacturer->delete();

            return  redirect()->to(url()->previous());
        }
    }

    /**
     * Get all list item for Adminstrator.
     */
    public function all()
    {
        $manufacturers = Manufacturer::get();

        return view('admin.manufacturer.manufacturer-list', compact('manufacturers'));
    }
}
