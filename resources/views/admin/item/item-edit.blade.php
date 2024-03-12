@extends('layouts.admin.app')

@section('content')
<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="item-form" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{url('item/list')}}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1>{{$data['title']}}</h1>
      <ul class="breadcrumb">
        @foreach ($data['breadcrumbs'] as $breadcrumb)
        <li><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['text'] }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ $data['url_submit'] }}" id="item-form">
          @csrf
       
       

          <!-- trade_name -->
          <div class="mb-3">
            <label class="form-label">Trade Name</label>
            <input class="form-control form-control-lg" type="text" name="trade_name" placeholder="Enter your item first name" value="{{ isset($data['item']['trade_name'])  ? $data['item']['trade_name']: ''}}">
          </div>

          <!-- generic_name -->
          <div class="mb-3">
            <label class="form-label">Generic Name</label>
            <input class="form-control form-control-lg" type="text" name="generic_name" placeholder="Enter your item generic name" value="{{ isset($data['item']['generic_name'])  ? $data['item']['generic_name']: ''}}">
          </div>

          <!-- dosage_form -->
          <div class="mb-3">
            <label class="form-label">Dosage Form</label>
            <input class="form-control form-control-lg" type="text" name="dosage_form" placeholder="Enter your dosage form" value="{{ isset($data['item']['dosage_form'])  ? $data['item']['dosage_form']: ''}}">
          </div>

          <!-- sku -->
          <div class="mb-3">
            <label class="form-label">sku</label>
            <input class="form-control form-control-lg" type="text" name="sku" placeholder="Enter your sku" value="{{ isset($data['item']['sku'])  ? $data['item']['sku']: ''}}">
          </div>

          <!-- 	strength -->
          <div class="mb-3">
            <label class="form-label">Strength</label>
            <input class="form-control form-control-lg" type="text" name="strength" placeholder="Enter your company initial" value="{{ isset($data['item']['strength'])  ? $data['item']['strength']: ''}}">
          </div>

          <!-- 	quantity -->
          <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input class="form-control form-control-lg" type="text" name="quantity" placeholder="Enter your quantity" value="{{ isset($data['item']['quantity'])  ? $data['item']['quantity']: ''}}">
          </div>

          <!-- 	manufacturer_id -->
          <div class="mb-3">
            <label class="form-label">Company Display Name</label>
            <select class="form-control form-control-lg" name="manufacturer_id" placeholder="Select User Group">
              @foreach ( $data['manufacturers'] as $manufacturer)
              @if( isset($data['item'] ) && $data['item']['manufacturer_id'] == $manufacturer->id)
              <option value="{{ $manufacturer->id }}" selected>{{ $manufacturer->name }} </option>
              @else
              <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }} </option>
              @endif

              @endforeach
            </select>
          </div>


          <!-- marketing_holder -->
          <div class="mb-3">
            <label class="form-label">Marketing Holder</label>
            <input class="form-control form-control-lg" type="text" name="marketing_holder" placeholder="Enter your marketing holder" value="{{ isset($data['item']['marketing_holder'])  ? $data['item']['marketing_holder']: ''}}">
          </div>

          <!-- country_id -->
          <div class="mb-3">
            <label class="form-label">Country</label>
            <input class="form-control form-control-lg" type="text" name="country_id" placeholder="Enter your Country" value="{{ isset($data['item']['country_id'])  ? $data['item']['country_id']: ''}}">
          </div>

           <!-- coa -->
           <div class="mb-3">
            <label class="form-label">COA</label>
            <input class="form-control form-control-lg" type="text" name="coa" placeholder="Enter your COA" value="{{ isset($data['item']['coa'])  ? $data['item']['coa']: ''}}">
          </div>

           <!-- biostudy -->
           <div class="mb-3">
            <label class="form-label">Biostudy</label>
            <input class="form-control form-control-lg" type="text" name="biostudy" placeholder="Enter your biostudy" value="{{ isset($data['item']['biostudy'])  ? $data['item']['biostudy']: ''}}">
          </div>

           <!-- sale_price -->
           <div class="mb-3">
            <label class="form-label">Sale Price</label>
            <input class="form-control form-control-lg" type="number" step="0.01" name="sale_price" placeholder="Enter your company sale price" value="{{ isset($data['item']['sale_price'])  ? $data['item']['sale_price']: ''}}">
          </div>

           <!-- sale_currency -->
           <div class="mb-3">
            <label class="form-label">Sale Currency</label>
            <input class="form-control form-control-lg" type="text" name="sale_currency" placeholder="Enter your company sale currency" value="{{ isset($data['item']['sale_currency'])  ? $data['item']['sale_currency']: ''}}">
          </div>

           <!-- sale_description -->
           <div class="mb-3">
            <label class="form-label">Sale Description</label>
            <input class="form-control form-control-lg" type="text" name="sale_description" placeholder="Enter your company sale description" value="{{ isset($data['item']['sale_description'])  ? $data['item']['sale_description']: ''}}">
          </div>

           <!-- purchase_price -->
           <div class="mb-3">
            <label class="form-label">Purchase Price</label>
            <input class="form-control form-control-lg" type="text" name="purchase_price" placeholder="Enter your company mobile phone" value="{{ isset($data['item']['purchase_price'])  ? $data['item']['purchase_price']: ''}}">
          </div>

           <!-- purchase_currency -->
           <div class="mb-3">
            <label class="form-label">Purchase Currency</label>
            <input class="form-control form-control-lg" type="text" name="purchase_currency" placeholder="Enter your company mobile phone" value="{{ isset($data['item']['purchase_currency'])  ? $data['item']['purchase_currency']: ''}}">
          </div>

           <!-- purchase_description -->
           <div class="mb-3">
            <label class="form-label">Purchase Description</label>
            <input class="form-control form-control-lg" type="text" name="purchase_description" placeholder="Enter your purchase description" value="{{ isset($data['item']['purchase_description'])  ? $data['item']['purchase_description']: ''}}">
          </div>

        </form>
      </div>
    </div>
  </div>
</main>
@endsection