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

            <h5 class="card-title mb-0">User Group</h5>
          </div>
          <table class="table table-hover my-0">
            <thead>
              <tr>
                <th class="d-none d-xl-table-cell text-center">Name</th>
                <th class="d-none d-xl-table-cell text-center">Permission Type</th>
                <th class="d-none d-xl-table-cell text-center">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($data['user_groups'] as $user_group)
              <tr>
                <td class="d-none d-xl-table-cell text-center">{{ $user_group->name }}</td>

                <td class="d-none d-xl-table-cell text-center">{{ $user_group->permission_type }}</td>
                <td class="d-none d-xl-table-cell text-center">
                  <a class="badge bg-success" href="{{url('/user-group/edit/' . $user_group->id)}}">
                    <i data-feather="edit"></i>
                  </a>
                </td>
              </tr>
              @endforeach

          </table>
        </div>
      </div>

    </div>
  </div>
</main>
<style>

</style>
@endsection