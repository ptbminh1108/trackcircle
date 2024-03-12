<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = Auth::user();
        if($user->user_group_id == 1 ){
            return redirect()->to(url('/customer/all'));
        }
        
        $data = [];

        $user_login_id = Auth::id();

        $customers = Customer::where('user_id', '=', $user_login_id)->get();

        $data['customers'] = [];
        foreach($customers as $customer){
            $data['customers'][] = array(
                "name" => $customer['firstname']. " " .$customer['lastname'],
                "customer_number" => $customer['customer_number'],
                "customer_email" => $customer['customer_email'],
                "customer_type" => $customer['customer_type'],
                "action" => ' <a class="badge bg-success" href="'.url("/customer/edit/" . $customer->id).'">  <i data-feather="edit"></i> </a>  <form method="post" action="'.url("/customer/delete/" . $customer->id).'"> '.csrf_field().'<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.customer'),
            'href' => url("/customer/list")
        );
        $data['url_create'] = url("/customer/create");
        $data['title'] = __("admin.customer");

        return view('admin.customer.customer-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [];


        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'customer_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            ]);

            if ($validator->fails()) {

                return redirect()->to($request->getRequestUri())
                    ->withInput($request->input())
                    ->withErrors($validator->errors());
            }
            if ($validator->passes()) {

                $user_login_id = Auth::id();
                $customer = Customer::create([
                    'user_id' => $user_login_id,
                    'customer_type' => $request->customer_type,
                    'customer_number' => $request->customer_number,
                    'salutation' => $request->salutation,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'company_initial' => $request->company_initial,
                    'company_name' => $request->company_name,
                    'display_name' => $request->display_name,
                    'customer_email' => $request->customer_email,
                    'company_phone' => $request->company_phone,
                    'company_mobile_phone' => $request->company_mobile_phone,
                ]);

                if ($customer) {
                    return redirect('/customer/list');
                }
            }


            return redirect()->to($request->getRequestUri())
            ->withInput($request->input())
            ->withErrors($validator->errors());
        }


        if (array_key_exists('customer_type', $request->old())) {
            $data['customer']['customer_type'] = $request->old('customer_type');
        } else {
            $data['customer']['customer_type'] = '';
        }

        if (array_key_exists('customer_number', $request->old())) {
            $data['customer']['customer_number'] = $request->old('customer_number');
        } else {
            $data['customer']['customer_number'] = '';
        }

        if (array_key_exists('salutation', $request->old())) {
            $data['customer']['salutation'] = $request->old('salutation');
        } else {
            $data['customer']['salutation'] = '';
        }

        if (array_key_exists('firstname', $request->old())) {
            $data['customer']['firstname'] = $request->old('firstname');
        } else {
            $data['customer']['firstname'] = '';
        }

        if (array_key_exists('lastname', $request->old())) {
            $data['customer']['lastname'] = $request->old('lastname');
        } else {
            $data['customer']['lastname'] = '';
        }

        if (array_key_exists('company_initial', $request->old())) {
            $data['customer']['company_initial'] = $request->old('company_initial');
        } else {
            $data['customer']['company_initial'] = '';
        }

        if (array_key_exists('company_name', $request->old())) {
            $data['customer']['company_name'] = $request->old('company_name');
        } else {
            $data['customer']['company_name'] = '';
        }

        if (array_key_exists('display_name', $request->old())) {
            $data['customer']['display_name'] = $request->old('display_name');
        } else {
            $data['customer']['display_name'] = '';
        }

        if (array_key_exists('customer_email', $request->old())) {
            $data['customer']['customer_email'] = $request->old('customer_email');
        } else {
            $data['customer']['customer_email'] = '';
        }
        
        if (array_key_exists('company_phone', $request->old())) {
            $data['customer']['company_phone'] = $request->old('company_phone');
        } else {
            $data['customer']['company_phone'] = '';
        }

        if (array_key_exists('company_mobile_phone', $request->old())) {
            $data['customer']['company_mobile_phone'] = $request->old('company_mobile_phone');
        } else {
            $data['customer']['company_mobile_phone'] = '';
        }

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.customer'),
            'href' => url("/user/list")
        );

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.customer'),
            'href' => url("/customer/list")
        );

        $data['button_submit_name'] = "Create";
        $data['url_submit'] = url('/customer/create');
        $data['title'] = __("admin.customer");

        return view('admin.customer.customer-edit', compact('data'));
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
            $customer  = Customer::where("id", '=', $id)->firstOrFail();
            $data['customer']['id'] = $customer['id'];
        }

        // Get previous request
        if (array_key_exists('customer_type', $request->old())) {
            $data['customer']['customer_type'] = $request->old('customer_type');
        }elseif ($customer['customer_type']) {
            $data['customer']['customer_type'] = $customer['customer_type'];
        } else {
            $data['customer']['customer_type'] = '';
        }

        if (array_key_exists('customer_number', $request->old())) {
            $data['customer']['customer_number'] = $request->old('customer_number');
        }elseif ($customer['customer_number']) {
            $data['customer']['customer_number'] = $customer['customer_number'];
        } else {
            $data['customer']['customer_number'] = '';
        }

        if (array_key_exists('salutation', $request->old())) {
            $data['customer']['salutation'] = $request->old('salutation');
        }elseif ($customer['salutation']) {
            $data['customer']['salutation'] = $customer['salutation'];
        } else {
            $data['customer']['salutation'] = '';
        }

        if (array_key_exists('firstname', $request->old())) {
            $data['customer']['firstname'] = $request->old('firstname');
        }elseif ($customer['firstname']) {
            $data['customer']['firstname'] = $customer['firstname'];
        } else {
            $data['customer']['firstname'] = '';
        }

        if (array_key_exists('lastname', $request->old())) {
            $data['customer']['lastname'] = $request->old('lastname');
        }elseif ($customer['lastname']) {
            $data['customer']['lastname'] = $customer['lastname'];
        }else {
            $data['customer']['lastname'] = '';
        }

        if (array_key_exists('company_initial', $request->old())) {
            $data['customer']['company_initial'] = $request->old('company_initial');
        }elseif ($customer['company_initial']) {
            $data['customer']['company_initial'] = $customer['company_initial'];
        } else {
            $data['customer']['company_initial'] = '';
        }

        if (array_key_exists('company_name', $request->old())) {
            $data['customer']['company_name'] = $request->old('company_name');
        }elseif ($customer['company_name']) {
            $data['customer']['company_name'] = $customer['company_name'];
        } else {
            $data['customer']['company_name'] = '';
        }

        if (array_key_exists('display_name', $request->old())) {
            $data['customer']['display_name'] = $request->old('display_name');
        }elseif ($customer['display_name']) {
            $data['customer']['display_name'] = $customer['display_name'];
        } else {
            $data['customer']['display_name'] = '';
        }

        if (array_key_exists('customer_email', $request->old())) {
            $data['customer']['customer_email'] = $request->old('customer_email');
        }elseif ($customer['customer_email']) {
            $data['customer']['customer_email'] = $customer['customer_email'];
        } else {
            $data['customer']['customer_email'] = '';
        }
        
        if (array_key_exists('company_phone', $request->old())) {
            $data['customer']['company_phone'] = $request->old('company_phone');
        }elseif ($customer['company_phone']) {
            $data['customer']['company_phone'] = $customer['company_phone'];
        } else {
            $data['customer']['company_phone'] = '';
        }

        if (array_key_exists('company_mobile_phone', $request->old())) {
            $data['customer']['company_mobile_phone'] = $request->old('company_mobile_phone');
        }elseif ($customer['company_mobile_phone']) {
            $data['customer']['company_mobile_phone'] = $customer['company_mobile_phone'];
        } else {
            $data['customer']['company_mobile_phone'] = '';
        }

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.customer'),
            'href' => url("/customer/list")
        );



        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/customer/edit/' . $id);
        $data['title'] = __("admin.customer");


        return view('admin.customer.customer-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'customer_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        if ($validator->passes()) {
            $customer = Customer::where('id', $id)->update([
                'customer_type' => $request->customer_type,
                'customer_number' => $request->customer_number,
                'salutation' => $request->salutation,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'company_initial' => $request->company_initial,
                'company_name' => $request->company_name,
                'display_name' => $request->display_name,
                'customer_email' => $request->customer_email,
                'company_phone' => $request->company_phone,
                'company_mobile_phone' => $request->company_mobile_phone,
            ]);

            if ($customer) {
                return redirect('/customer/list');
            }
        }


        return redirect()->to($request->getRequestUri())
            ->withInput($request->input())
            ->withErrors($validator->errors());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $user_login_id = Auth::id();

        $customer = Customer::where('user_id', '=', $user_login_id)->where('id', '=', $id);
        if ($customer) {
            $customer->delete();

            return  redirect()->to(url()->previous());
        }
    }

    /**
     * Get all list item for Adminstrator.
     */
    public function all()
    {   
        
        $data = [];

        $user_login_id = Auth::id();

        $customers = Customer::get();

        $data['customers'] = [];
        foreach($customers as $customer){
            $data['customers'][] = array(
                "name" => $customer['firstname']. " " .$customer['lastname'],
                "customer_number" => $customer['customer_number'],
                "customer_email" => $customer['customer_email'],
                "customer_type" => $customer['customer_type'],
                "action" => ' <a class="badge bg-success" href="'.url("/customer/edit/" . $customer->id).'">  <i data-feather="edit"></i> </a>  <form method="post" action="'.url("/customer/delete/" . $customer->id).'"> '.csrf_field().'<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.customer'),
            'href' => url("/customer/list")
        );
        $data['url_create'] = url("/customer/create");
        $data['title'] = __("admin.customer");

        return view('admin.customer.customer-list', compact('data'));
    }
}
