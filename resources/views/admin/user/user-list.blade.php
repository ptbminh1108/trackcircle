@extends('layouts.admin.app')

@section('content')

<main>
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="{{ $data['url_create'] }}" data-toggle="tooltip" title="Create" class="btn btn-primary"><i class="fa fa-plus"></i></a>
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
    <div class="row">
      <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill">
          <div class="card-header">

            <h5 class="card-title mb-0">User</h5>
          </div>
          <table class="table table-hover my-0">
            <thead>
              <tr>
                <th class="d-none d-xl-table-cell text-center">Name</th>
                <th class="d-none d-xl-table-cell text-center">Status</th>
                <th class="d-none d-xl-table-cell text-center">User Group</th>
                <th class="d-none d-xl-table-cell text-center">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($data['users'] as $user)
              <tr>
                <td class="d-none d-xl-table-cell text-center">{{ $user->name }}</td>
                <td class="d-none d-xl-table-cell text-center">
                  <label class="switch">
                    <input type="checkbox" {{ $user->status ? 'checked' : '' }}>
                    <span class="slider round"></span>
                  </label>
                </td>
                <td class="d-none d-xl-table-cell text-center">{{ $user->user_groups->name }}</td>
                <td class="d-none d-xl-table-cell text-center">
                  <a class="badge bg-success" href="{{url('/user/edit/' . $user->id)}}">
                    <i data-feather="edit"></i>
                  </a>
                  <form method="post" action="{{url('/user/delete/' . $user->id)}}">
                    @csrf
                    <button class="badge bg-danger" type='submit'>
                      <i data-feather="trash"></i>
                    </button>
                  </form>

                </td>
              </tr>
              @endforeach

          </table>
        </div>
      </div>

    </div>
  </div>
</main>
@endsection