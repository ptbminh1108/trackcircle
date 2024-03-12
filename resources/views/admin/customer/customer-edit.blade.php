@extends('layouts.admin.app')

@section('content')
<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="customer-form" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{url('customer/list')}}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <form method="POST" action="{{ $data['url_submit'] }}" id="customer-form">
          @csrf
          <!-- customer_type -->
          <div class="mb-3">
            <label class="form-label">Customer Type</label>
            <select class="form-control form-control-lg" name="customer_type" placeholder="Select User Group">
              @if( isset($data['customer'] ) && $data['customer']['customer_type'] == "Company")
              <option value="Company" selected> Company </option>
              <option value="Individual"> Individual </option>
              @else
              <option value="Company"> Company </option>
              <option value="Individual" selected> Individual </option>
              @endif
            </select>
          </div>
          <!-- customer_email -->
          <div class="mb-3">
            <label class="form-label">Customer Email</label>
            <input class="form-control form-control-lg  @error('customer_email') is-invalid @enderror" type="email" name="customer_email" required placeholder="Enter your customer name" value="{{ isset($data['customer']['customer_email'])  ? $data['customer']['customer_email']: ''}}">
            @error('customer_email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <!-- firstname -->
          <div class="mb-3">
            <label class="form-label">Customer Firsname</label>
            <input class="form-control form-control-lg" type="text" name="firstname" placeholder="Enter your customer first name" value="{{ isset($data['customer']['firstname'])  ? $data['customer']['firstname']: ''}}">
          </div>

          <!-- lastname -->
          <div class="mb-3">
            <label class="form-label">Customer Lastname</label>
            <input class="form-control form-control-lg" type="text" name="lastname" placeholder="Enter your customer last name" value="{{ isset($data['customer']['lastname'])  ? $data['customer']['lastname']: ''}}">
          </div>

          <!-- customer_number -->
          <div class="mb-3">
            <label class="form-label">Customer Number</label>
            <input class="form-control form-control-lg" type="text" name="customer_number" placeholder="Enter your customer number" value="{{ isset($data['customer']['customer_number'])  ? $data['customer']['customer_number']: ''}}">
          </div>

          <!-- salulation -->
          <div class="mb-3">
            <label class="form-label">Salutation</label>
            <input class="form-control form-control-lg" type="text" name="salutation" placeholder="Enter your salulation" value="{{ isset($data['customer']['salutation'])  ? $data['customer']['salutation']: ''}}">
          </div>

          <!-- 	company_initial -->
          <div class="mb-3">
            <label class="form-label">Company Initial</label>
            <input class="form-control form-control-lg" type="text" name="company_initial" placeholder="Enter your company initial" value="{{ isset($data['customer']['company_initial'])  ? $data['customer']['company_initial']: ''}}">
          </div>

          <!-- 	company_name -->
          <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input class="form-control form-control-lg" type="text" name="company_name" placeholder="Enter your company name" value="{{ isset($data['customer']['company_name'])  ? $data['customer']['company_name']: ''}}">
          </div>

          <!-- 	display_name -->
          <div class="mb-3">
            <label class="form-label">Company Display Name</label>
            <input class="form-control form-control-lg" type="text" name="display_name" placeholder="Enter your company name" value="{{ isset($data['customer']['display_name'])  ? $data['customer']['display_name']: ''}}">
          </div>


          <!-- company_phone -->
          <div class="mb-3">
            <label class="form-label">Company Phone</label>
            <input class="form-control form-control-lg" type="text" name="company_phone" placeholder="Enter your company phone" value="{{ isset($data['customer']['company_phone'])  ? $data['customer']['company_phone']: ''}}">
          </div>

          <!-- company_mobile_phone -->
          <div class="mb-3">
            <label class="form-label">Company Mobile Phone</label>
            <input class="form-control form-control-lg" type="text" name="company_mobile_phone" placeholder="Enter your company mobile phone" value="{{ isset($data['customer']['company_mobile_phone'])  ? $data['customer']['company_mobile_phone']: ''}}">
          </div>

        </form>
      </div>
    </div>
  </div>
</main>
@endsection