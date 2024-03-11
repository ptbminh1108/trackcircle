@extends('layouts.admin.app')

@section('content')
<main>
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ $data['url_submit'] }}">
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
    <div class="text-center mt-3">
      <button type="submit" class="btn btn-lg btn-primary">{{ $data['button_submit_name']}}</button>
      <!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
    </div>
    </form>
  </div>
  </div>
</main>
@endsection