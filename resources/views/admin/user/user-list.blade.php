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
          <div class="card-body">
            <table class="table table-bordered" id="userTable">
              <thead>
                <tr>
                  <th class="d-none d-xl-table-cell text-center">Name</th>
                  <th class="d-none d-xl-table-cell text-center">Status</th>
                  <th class="d-none d-xl-table-cell text-center">User Group</th>
                  <th class="d-none d-xl-table-cell text-center">Action</th>
                </tr>
              </thead>

            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</main>
@push('scripts')
<script>
  $(document).ready(function() {
    $('#userTable').DataTable({
      data: @json($data['users']),
      columnDefs: [{
        "className": "dt-center",
        "targets": "_all"
      }],
      columns: [{
          data: 'name'
        },
        {
          data: 'user_group'
        },
        {
          data: 'status'
        },
        {
          data: 'action'
        }
      ]
    });
  });
</script>
@endpush
@endsection