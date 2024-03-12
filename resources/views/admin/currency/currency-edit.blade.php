@extends('layouts.admin.app')

@section('content')
<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="currency-form" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{url('currency/list')}}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <form method="POST" action="{{ $data['url_submit'] }}" id="currency-form">
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control form-control-lg @error('currency_code') is-invalid @enderror"  maxlength="3" type="text" name="currency_code" required placeholder="Enter your currency code" value="{{ isset($data['currency']['currency_code'])  ? $data['currency']['currency_code']: ''}}">
            @error('currency_code')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Currency Title</label>
            <input class="form-control form-control-lg" type="text" name="currency_title" placeholder="Enter your currency title" value="{{ isset($data['currency']['currency_title'])  ? $data['currency']['currency_title']: ''}}">
          </div>
          <div class="mb-3">
            <label class="form-label">Currency Symbol</label>
            <input class="form-control form-control-lg" type="text" name="currency_symbol" placeholder="Enter your currency symbol" value="{{ isset($data['currency']['currency_symbol'])  ? $data['currency']['currency_symbol']: ''}}">
          </div>
          <div class="mb-3">
            <label class="form-label">Decimal Place</label>
            <input class="form-control form-control-lg" type="number" maxlength="1" name="decimal_place" placeholder="Enter your decimal place" value="{{ isset($data['currency']['decimal_place'])  ? $data['currency']['decimal_place']: ''}}">
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection