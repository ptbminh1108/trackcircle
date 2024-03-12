@extends('layouts.admin.app')

@section('content')
<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="user-group-form" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="{{url('user-group/list')}}" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
        <form method="POST" action="{{ $data['url_submit'] }}" id="user-group-form">
          @csrf
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" placeholder="Enter your name" value="{{ isset($data['user_group']['name'])  ? $data['user_group']['name']: ''}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label">Permission Type</label>
            <select class="form-control form-control-lg" type="text" name="permission_type" placeholder="Choose permission type">
              @if(isset($data['user_group']['permission_type']) && $data['user_group']['permission_type'] == 'all')
              <option value="all" selected>all</option>
              <option value="custom">custom</option>
              @else
              <option value="all">All</option>
              <option value="custom" selected>Custom</option>
              @endif
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Permissions</label>
            <div class="well well-sm" style="height: 150px; overflow: auto;">
              <div class="checkbox">
                @foreach ($data['permission_list'] as $permission)
                @if(in_array($permission, $data['user_group']['permissions']))
                <label> <input type="checkbox" name="permissions[]" value="{{$permission}}" checked="checked">{{$permission}} </label>
                @else
                <label> <input type="checkbox" name="permissions[]" value="{{$permission}}">{{$permission}} </label>
                @endif
                @endforeach
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<style>
  .well-sm {
    height: 150px;
    overflow: auto;
    padding: 9px;
    border-radius: 2px;
  }

  .well {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 3px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
  }

  .checkbox label {
    display: block;
    min-height: 18px;
    padding-left: 20px;
    margin-bottom: 0;
    font-weight: normal;
    cursor: pointer;
  }

  input[type="checkbox"] {
    margin-right: 5px;
    /* position: relative;
    width: 13px;
    width: 16px \0;
    height: 13px;
    height: 16px \0;
    -webkit-appearance: none;
    background: white;
    border: 1px solid #dcdcdc;
    border: 1px solid transparent \0;
    border-radius: 1px; */
  }

  input[type="checkbox"]:checked,
  .checkbox-inline input[type="checkbox"]:checked {
    /* background: #fff; */
  }
</style>
@endsection