<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->user_group_id == 1) {
            return redirect()->to(url('/item/all'));
        }

        $data = [];

        $user_login_id = Auth::id();

        $item = Product::where('user_id', '=', $user_login_id)->get();

        $data['item'] = [];
        foreach ($item as $item) {
            $data['item'][] = array(
                "trade_name" => $item['trade_name'],
                "sku" => $item['sku'],
                "purchase_price" => $item['purchase_price'],
                "purchase_currency" => $item['purchase_currency'],
                "action" => ' <a class="badge bg-success" href="' . url("/item/edit/" . $item->id) . '">  <i data-feather="edit"></i> </a>  <form method="post" action="' . url("/item/delete/" . $item->id) . '"> ' . csrf_field() . '<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.item'),
            'href' => url("/item/list")
        );
        $data['url_create'] = url("/item/create");
        $data['title'] = __("admin.item");

        return view('admin.item.item-list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = [];


        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                // 'name' => ['required', 'string', 'max:255'],
            ]);

            if ($validator->fails()) {

                return redirect()->to($request->getRequestUri())
                    ->withInput($request->input())
                    ->withErrors($validator->errors());
            }

            if ($validator->passes()) {

                $user_login_id = Auth::id();
                $item = Product::create([
                    'user_id' =>  $user_login_id,
                    'trade_name' => $request->trade_name,
                    'generic_name' => $request->generic_name,
                    'dosage_form' => $request->dosage_form,
                    'sku' => $request->sku,
                    'manufacturer_id' => $request->manufacturer_id,
                    'marketing_holder' => $request->marketing_holder,
                    'coa' => $request->coa,
                    'biostudy' => $request->biostudy,
                    'sale_price' => $request->sale_price,
                    'sale_currency' => $request->sale_currency,
                    'sale_description' => $request->sale_description,
                    'purchase_price' => $request->purchase_price,
                    'purchase_currency' => $request->purchase_currency,
                    'purchase_description' => $request->purchase_description,
                ]);

                if ($item) {
                    return redirect('/item/list');
                }
            }


            // return redirect()->to($request->getRequestUri())
            // ->withInput($request->input())
            // ->withErrors($validator->errors(), $this->errorBag());
        }

        // trade_name
        if (array_key_exists('trade_name', $request->old())) {
            $data['item']['trade_name'] = $request->old('trade_name');
        } else {
            $data['item']['trade_name'] = '';
        }

        // generic_name
        if (array_key_exists('generic_name', $request->old())) {
            $data['item']['generic_name'] = $request->old('generic_name');
        } else {
            $data['item']['generic_name'] = '';
        }

        // dosage_form
        if (array_key_exists('dosage_form', $request->old())) {
            $data['item']['dosage_form'] = $request->old('dosage_form');
        } else {
            $data['item']['dosage_form'] = '';
        }

        // strength
        if (array_key_exists('strength', $request->old())) {
            $data['item']['strength'] = $request->old('strength');
        } else {
            $data['item']['strength'] = '';
        }

        // quantity
        if (array_key_exists('quantity', $request->old())) {
            $data['item']['quantity'] = $request->old('quantity');
        } else {
            $data['item']['quantity'] = '';
        }

        // manufacturer_id
        if (array_key_exists('manufacturer_id', $request->old())) {
            $data['item']['manufacturer_id'] = $request->old('manufacturer_id');
        } else {
            $data['item']['manufacturer_id'] = '';
        }

        // marketing_holder
        if (array_key_exists('marketing_holder', $request->old())) {
            $data['item']['marketing_holder'] = $request->old('marketing_holder');
        } else {
            $data['item']['marketing_holder'] = '';
        }

        // country_id
        if (array_key_exists('country_id', $request->old())) {
            $data['item']['country_id'] = $request->old('country_id');
        } else {
            $data['item']['country_id'] = '';
        }

        // biostudy
        if (array_key_exists('biostudy', $request->old())) {
            $data['item']['biostudy'] = $request->old('biostudy');
        } else {
            $data['item']['biostudy'] = '';
        }

        // sale_price
        if (array_key_exists('sale_price', $request->old())) {
            $data['item']['sale_price'] = $request->old('sale_price');
        } else {
            $data['item']['sale_price'] = '';
        }

        // sale_currency
        if (array_key_exists('sale_currency', $request->old())) {
            $data['item']['sale_currency'] = $request->old('sale_currency');
        } else {
            $data['item']['sale_currency'] = '';
        }

        // sale_description
        if (array_key_exists('name', $request->old())) {
            $data['item']['name'] = $request->old('name');
        } else {
            $data['item']['name'] = '';
        }

        // purchase_price
        if (array_key_exists('purchase_price', $request->old())) {
            $data['item']['purchase_price'] = $request->old('purchase_price');
        } else {
            $data['item']['purchase_price'] = '';
        }

        // purchase_currency
        if (array_key_exists('purchase_currency', $request->old())) {
            $data['item']['purchase_currency'] = $request->old('purchase_currency');
        } else {
            $data['item']['purchase_currency'] = '';
        }

        // purchase_description
        if (array_key_exists('purchase_description', $request->old())) {
            $data['item']['purchase_description'] = $request->old('purchase_description');
        } else {
            $data['item']['purchase_description'] = '';
        }

        // Get Manufacturer

        $manufacturers = Manufacturer::where("user_id","=",Auth::id())->get();
        $data['manufacturers'] = $manufacturers;

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.item'),
            'href' => url("/item/list")
        );

        $data['button_submit_name'] = "Create";
        $data['url_submit'] = url('/item/create');
        $data['title'] = __("admin.item");

        return view('admin.item.item-edit', compact('data'));
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
            $item  = Product::where("id", '=', $id)->firstOrFail();
            $data['item']['id'] = $item['id'];
        }

        // Get previous request

        // trade_name
        if (array_key_exists('trade_name', $request->old())) {
            $data['item']['trade_name'] = $request->old('trade_name');
        } elseif ($item) {
            $data['item']['trade_name'] = $item['trade_name'];
        } else {
            $data['item']['trade_name'] = '';
        }

        // generic_name
        if (array_key_exists('generic_name', $request->old())) {
            $data['item']['generic_name'] = $request->old('generic_name');
        } elseif ($item) {
            $data['item']['generic_name'] = $item['generic_name'];
        } else {
            $data['item']['generic_name'] = '';
        }

        // dosage_form

        if (array_key_exists('dosage_form', $request->old())) {
            $data['item']['dosage_form'] = $request->old('dosage_form');
        } elseif ($item) {
            $data['item']['dosage_form'] = $item['dosage_form'];
        } else {
            $data['item']['dosage_form'] = '';
        }

        // sku

        if (array_key_exists('sku', $request->old())) {
            $data['item']['sku'] = $request->old('sku');
        } elseif ($item) {
            $data['item']['sku'] = $item['sku'];
        } else {
            $data['item']['sku'] = '';
        }

        // strength

        if (array_key_exists('strength', $request->old())) {
            $data['item']['strength'] = $request->old('strength');
        } elseif ($item) {
            $data['item']['strength'] = $item['strength'];
        } else {
            $data['item']['strength'] = '';
        }

        // quantity

        if (array_key_exists('quantity', $request->old())) {
            $data['item']['quantity'] = $request->old('quantity');
        } elseif ($item) {
            $data['item']['quantity'] = $item['quantity'];
        } else {
            $data['item']['quantity'] = '';
        }

        // manufacturer_id

        if (array_key_exists('manufacturer_id', $request->old())) {
            $data['item']['manufacturer_id'] = $request->old('manufacturer_id');
        } elseif ($item) {
            $data['item']['manufacturer_id'] = $item['manufacturer_id'];
        } else {
            $data['item']['manufacturer_id'] = '';
        }

        // marketing_holder

        if (array_key_exists('marketing_holder', $request->old())) {
            $data['item']['marketing_holder'] = $request->old('marketing_holder');
        } elseif ($item) {
            $data['item']['marketing_holder'] = $item['marketing_holder'];
        } else {
            $data['item']['marketing_holder'] = '';
        }

        // country_id

        if (array_key_exists('country_id', $request->old())) {
            $data['item']['country_id'] = $request->old('country_id');
        } elseif ($item) {
            $data['item']['country_id'] = $item['country_id'];
        } else {
            $data['item']['country_id'] = '';
        }

        // coa

        if (array_key_exists('coa', $request->old())) {
            $data['item']['coa'] = $request->old('coa');
        } elseif ($item) {
            $data['item']['coa'] = $item['coa'];
        } else {
            $data['item']['coa'] = '';
        }

        // biostudy

        if (array_key_exists('biostudy', $request->old())) {
            $data['item']['biostudy'] = $request->old('biostudy');
        } elseif ($item) {
            $data['item']['biostudy'] = $item['biostudy'];
        } else {
            $data['item']['biostudy'] = '';
        }

        // sale_price

        if (array_key_exists('sale_price', $request->old())) {
            $data['item']['sale_price'] = $request->old('sale_price');
        } elseif ($item) {
            $data['item']['sale_price'] = $item['sale_price'];
        } else {
            $data['item']['sale_price'] = '';
        }

        // sale_currency

        if (array_key_exists('sale_currency', $request->old())) {
            $data['item']['sale_currency'] = $request->old('sale_currency');
        } elseif ($item) {
            $data['item']['sale_currency'] = $item['sale_currency'];
        } else {
            $data['item']['sale_currency'] = '';
        }

        // sale_description

        if (array_key_exists('sale_description', $request->old())) {
            $data['item']['sale_description'] = $request->old('sale_description');
        } elseif ($item) {
            $data['item']['sale_description'] = $item['sale_description'];
        } else {
            $data['item']['sale_description'] = '';
        }

        // purchase_price

        if (array_key_exists('purchase_price', $request->old())) {
            $data['item']['purchase_price'] = $request->old('purchase_price');
        } elseif ($item) {
            $data['item']['purchase_price'] = $item['purchase_price'];
        } else {
            $data['item']['purchase_price'] = '';
        }

        // purchase_currency

        if (array_key_exists('purchase_currency', $request->old())) {
            $data['item']['purchase_currency'] = $request->old('purchase_currency');
        } elseif ($item) {
            $data['item']['purchase_currency'] = $item['purchase_currency'];
        } else {
            $data['item']['purchase_currency'] = '';
        }

        // purchase_description

        if (array_key_exists('purchase_description', $request->old())) {
            $data['item']['purchase_description'] = $request->old('purchase_description');
        } elseif ($item) {
            $data['item']['purchase_description'] = $item['purchase_description'];
        } else {
            $data['item']['purchase_description'] = '';
        }

        // Get Manufacturer

        $manufacturers = Manufacturer::where("user_id","=",Auth::id())->get();
        $data['manufacturers'] = $manufacturers;

        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.item'),
            'href' => url("/item/list")
        );



        $data['button_submit_name'] = "Save";
        $data['url_submit'] = url('/item/edit/' . $id);
        $data['title'] = __("admin.item");


        return view('admin.item.item-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => ['required', 'string', 'max:255'],
        ]);



        if ($validator->passes()) {
            $item = Product::where('id', $id)->update([
                'trade_name' => $request->trade_name,
                'generic_name' => $request->generic_name,
                'dosage_form' => $request->dosage_form,
                'sku' => $request->sku,
                'manufacturer_id' => $request->manufacturer_id,
                'marketing_holder' => $request->marketing_holder,
                'coa' => $request->coa,
                'biostudy' => $request->biostudy,
                'sale_price' => $request->sale_price,
                'sale_currency' => $request->sale_currency,
                'sale_description' => $request->sale_description,
                'purchase_price' => $request->purchase_price,
                'purchase_currency' => $request->purchase_currency,
                'purchase_description' => $request->purchase_description,
            ]);

            if ($item) {
                return redirect('/item/list');
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

        $item = Product::where('user_id', '=', $user_login_id)->where('id', '=', $id);
        if ($item) {
            $item->delete();

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

        $items = Product::get();

        $data['items'] = [];
        foreach ($items as $item) {
            $data['items'][] = array(
                "trade_name" => $item['trade_name'],
                "sku" => $item['sku'],
                "purchase_price" => $item['purchase_price'],
                "purchase_currency" => $item['purchase_currency'],
                "action" => ' <a class="badge bg-success" href="' . url("/item/edit/" . $item->id) . '">  <i data-feather="edit"></i> </a>  <form method="post" action="' . url("/user/delete/" . $item->id) . '"> ' . csrf_field() . '<button class="badge bg-danger" type="submit">    <i data-feather="trash"></i></button> </form>',
            );
        }
        
        // Breadcrumb
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => __('admin.dashboard'),
            'href' => url("/dashboard")
        );

        $data['breadcrumbs'][] = array(
            'text' => __('admin.item'),
            'href' => url("/item/list")
        );
        $data['url_create'] = url("/item/create");
        $data['title'] = __("admin.item");

        return view('admin.item.item-list', compact('data'));
    }
}
