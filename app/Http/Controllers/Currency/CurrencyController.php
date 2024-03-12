<?php

namespace App\Http\Controllers\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->user_group_id == 1) {
            return redirect()->to(url('/currency/all'));
        }

        $data = [];

        $user_login_id = Auth::id();

        $currencies = Currency::where('user_id', '=', $user_login_id)->get();

        $data['currencies'] = [];
        foreach ($currencies as $currency) {
            $data['currencys'][] = array(
                "currency_code" => $currency['currency_code'],
                "currency_title" => $currency['currency_title'],
                "currency_symbol" => $currency['currency_symbol'],
                "action" => ' <a class="badge bg-success" href="' . url("/currency/edit/" . $currency->id) . '">  <i data-feather="edit"></i> </a>  <form method="post" action="' . url("/currency/delete/" . $currency->id) . '"> ' . csrf_field() . '<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.currency'),
            'href' => url("/currency/list")
        );
        $data['url_create'] = url("/currency/create");
        $data['title'] = __("admin.currency");

        return view('admin.currency.currency-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [];


        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'currency_code' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {

                return redirect()->to($request->getRequestUri())
                    ->withInput($request->input())
                    ->withErrors($validator->errors());
            }

            if ($validator->passes()) {

                $user_login_id = Auth::id();
                $currency = Currency::create([
                    'currency_code' => $request->currency_code,
                    'currency_title' => $request->currency_title,
                    'currency_symbol' => $request->currency_symbol,
                    'decimal_place' => $request->decimal_place,
                    'user_id' => $user_login_id
                ]);

                if ($currency) {
                    return redirect('/currency/list');
                }
            }


            // return redirect()->to($request->getRequestUri())
            // ->withInput($request->input())
            // ->withErrors($validator->errors(), $this->errorBag());
        }


        if (array_key_exists('currency_code', $request->old())) {
            $data['currency']['currency_code'] = $request->old('currency_code');
        } else {
            $data['currency']['currency_code'] = '';
        }

        if (array_key_exists('currency_title', $request->old())) {
            $data['currency']['currency_title'] = $request->old('currency_title');
        } else {
            $data['currency']['currency_title'] = '';
        }

        if (array_key_exists('currency_symbol', $request->old())) {
            $data['currency']['currency_symbol'] = $request->old('currency_symbol');
        } else {
            $data['currency']['currency_symbol'] = '';
        }

        if (array_key_exists('decimal_place', $request->old())) {
            $data['currency']['decimal_place'] = $request->old('decimal_place');
        } else {
            $data['currency']['decimal_place'] = '';
        }


        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.currency'),
            'href' => url("/currency/list")
        );

        $data['button_submit_name'] = "Create";
        $data['url_submit'] = url('/currency/create');
        $data['title'] = __("admin.currency");

        return view('admin.currency.currency-edit', compact('data'));
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
            $currency  = Currency::where("id", '=', $id)->firstOrFail();
            $data['currency']['id'] = $currency['id'];
        }

        // Get previous request
        // Currency Code

        if (array_key_exists('name', $request->old())) {
            $data['currency']['name'] = $request->old('name');
        } elseif ($currency) {
            $data['currency']['name'] = $currency['name'];
        } else {
            $data['currency']['name'] = '';
        }

        // Currency Code

        if (array_key_exists('currency_code', $request->old())) {
            $data['currency']['currency_code'] = $request->old('currency_code');
        } elseif ($currency) {
            $data['currency']['currency_code'] = $currency['currency_code'];
        } else {
            $data['currency']['currency_code'] = '';
        }

        // Currency Title

        if (array_key_exists('currency_title', $request->old())) {
            $data['currency']['currency_title'] = $request->old('currency_title');
        } elseif ($currency) {
            $data['currency']['currency_title'] = $currency['currency_title'];
        } else {
            $data['currency']['currency_title'] = '';
        }

        // Currency Symbol

        if (array_key_exists('currency_symbol', $request->old())) {
            $data['currency']['currency_symbol'] = $request->old('currency_symbol');
        } elseif ($currency) {
            $data['currency']['currency_symbol'] = $currency['currency_symbol'];
        } else {
            $data['currency']['currency_symbol'] = '';
        }

        // Currency Place

        if (array_key_exists('decimal_place', $request->old())) {
            $data['currency']['decimal_place'] = $request->old('decimal_place');
        } elseif ($currency) {
            $data['currency']['decimal_place'] = $currency['decimal_place'];
        } else {
            $data['currency']['decimal_place'] = '';
        }



        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.currency'),
            'href' => url("/currency/list")
        );



        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/currency/edit/' . $id);
        $data['title'] = __("admin.currency");


        return view('admin.currency.currency-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'currency_code' => ['required', 'string', 'max:3'],
        ]);



        if ($validator->passes()) {
            $currency = Currency::where('id', $id)->update([
                'currency_code' => $request->currency_code,
                'currency_title' => $request->currency_title,
                'currency_symbol' => $request->currency_symbol,
                'decimal_place' => $request->decimal_place,
            ]);

            if ($currency) {
                return redirect('/currency/list');
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

        $currency = Currency::where('user_id', '=', $user_login_id)->where('id', '=', $id);
        if ($currency) {
            $currency->delete();

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

        $currencies = Currency::get();

        $data['currencies'] = [];
        foreach ($currencies as $currency) {
            $data['currencies'][] = array(
                "currency_code" => $currency['currency_code'],
                "currency_title" => $currency['currency_title'],
                "currency_symbol" => $currency['currency_symbol'],
                "action" => ' <a class="badge bg-success" href="' . url("/currency/edit/" . $currency->id) . '">  <i data-feather="edit"></i> </a>  <form method="post" action="' . url("/currency/delete/" . $currency->id) . '"> ' . csrf_field() . '<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.currency'),
            'href' => url("/currency/list")
        );
        $data['url_create'] = url("/currency/create");
        $data['title'] = __("admin.currency");

        return view('admin.currency.currency-list', compact('data'));
    }
}
