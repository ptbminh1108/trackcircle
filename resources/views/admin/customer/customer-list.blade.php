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

            <h5 class="card-title mb-0">Manufacturers</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="customerTable">
              <thead>
                <tr>
                  <th class="d-none d-xl-table-cell text-center">Name</th>
                  <th class="d-none d-xl-table-cell text-center">Customer Number</th>
                  <th class="d-none d-xl-table-cell text-center">Customer Email</th>
                  <th class="d-none d-xl-table-cell text-center">Customer Type</th>
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
    $('#customerTable').DataTable({
      data: @json($data['customers']),
      columnDefs: [{
        "className": "dt-center",
        "targets": "_all",
      }],
      columns: [{
          data: 'name'
        },
        {
          data: 'customer_number'
        },
        {
          data: 'customer_email'
        },
        {
          data: 'customer_type'
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