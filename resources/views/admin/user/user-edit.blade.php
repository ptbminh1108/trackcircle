@extends('layouts.admin.app')

@section('content')
<main>
  <div class="card">
    <div class="card-body">
    <form method="POST" action="{{ $url_submit }}">
    @csrf
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input class="form-control form-control-lg" type="text" name="name" placeholder="Enter your name" value="{{ isset($user->name)  ? $user->name: ''}}">
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control form-control-lg" type="text" name="email" placeholder="Enter your Phone Number" value="{{( isset($user->email)  ? $user->email: '')}}">
      </div>
      @if( !isset($user) )
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input class="form-control form-control-lg" type="password" name="password" placeholder="Enter password">
      </div>
      @endif
      <div class="mb-3">
        <label class="form-label">User Group</label>
        <select class="form-control form-control-lg" name="user_group_id" placeholder="Select User Group">
          @foreach ($user_groups as $user_group)
          @if( isset($user) && $user->user_group_id == $user_group->id)
          <option value="{{ $user_group->id }}" selected>{{ $user_group->name }} </option>
          @else
          <option value="{{ $user_group->id }}">{{ $user_group->name }} </option>
          @endif

          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Status</label>
        <div  class="form-control" style="border: 0px!important">
          <label class="switch">
            <input type="checkbox" name='status' {{ (isset($user->status) && $user->status) ? 'checked' : '' }}>
            <span class="slider round"></span>
          </label>
        </div>

      </div>
      <div class="text-center mt-3">
        <button type ="submit" class="btn btn-lg btn-primary">{{ $button_submit_name}}</button>
        <!-- <button type="submit" class="btn btn-lg btn-primary">Sign up</button> -->
      </div>
    </form>
    </div>
  </div>
</main>
@endsection