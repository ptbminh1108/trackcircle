@extends('layouts.admin.app')

@section('content')

<main>
  <div class="row" style="margin-bottom: 10px">
    <div class="d-flex flex-row-reverse">
      <a class="badge bg-danger " href="{{url('/user-group/create')}}"> <i class="d-inline" data-feather="plus"></i><span class="d-inline"> Add New User Group</span></a>
    </div>
  </div>
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
</main>
<style>

</style>
@endsection