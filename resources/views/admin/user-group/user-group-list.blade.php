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
          <table class="table table-bordered" id="userGroupTable">
              <thead>
                <tr>
                  <th class="d-none d-xl-table-cell text-center">Name</th>
                  <th class="d-none d-xl-table-cell text-center">Permission Type</th>
                  <th class="d-none d-xl-table-cell text-center">Action</th>
                </tr>
              </thead>

            </table>
        </div>
      </div>

    </div>
  </div>
</main>
@push('scripts')
<script>
  $(document).ready(function() {
    $('#userGroupTable').DataTable({
      data: @json($data['user_groups']),
      columnDefs: [{
        "className": "dt-center",
        "targets": "_all"
      }],
      columns: [{
          data: 'name'
        },
        {
          data: 'permission_type'
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