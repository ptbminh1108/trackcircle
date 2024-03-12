@extends('layouts.admin.app')

@section('content')
<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="user-form" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{url('user/list')}}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <form method="POST" action="{{ $data['url_submit'] }}" id='user-form'>
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your name" value="{{ isset($data['user']['name'])  ? $data['user']['name']: ''}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter your Email" value="{{( isset($data['user']['email'])  ? $data['user']['email']: '')}}">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          @if( !isset($data['user']['id']) )
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control form-control-lg  @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter password">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          @endif
          <div class="mb-3">
            <label class="form-label">User Group</label>
            <select class="form-control form-control-lg" name="user_group_id" placeholder="Select User Group">
              @foreach ( $data['user_groups'] as $user_group)
              @if( isset($data['user'] ) && $data['user']['user_group_id'] == $user_group->id)
              <option value="{{ $user_group->id }}" selected>{{ $user_group->name }} </option>
              @else
              <option value="{{ $user_group->id }}">{{ $user_group->name }} </option>
              @endif

              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="form-control" style="border: 0px!important">
              <label class="switch">
                <input type="checkbox" name='status' {{ (isset($data['user']['status']) && $data['user']['status']) ? 'checked' : '' }}>
                <span class="slider round"></span>
              </label>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection