@extends('layouts.admin.app')

@section('content')
<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="manufacturer-form" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{url('manufacturer/list')}}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <form method="POST" action="{{ $data['url_submit'] }}" id="manufacturer-form">
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your name" value="{{ isset($data['manufacturer']['name'])  ? $data['manufacturer']['name']: ''}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control form-control-lg" type="text" name="description" placeholder="Enter your Email" value="">
            {{( isset($data['manufacturer']['description'])  ? $data['manufacturer']['description']: '')}}
            </textarea>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection