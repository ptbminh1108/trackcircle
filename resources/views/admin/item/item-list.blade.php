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

            <h5 class="card-title mb-0">Item</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered" id="itemTable">
              <thead>
                <tr>
                  <th class="d-none d-xl-table-cell text-center">Trade Name</th>
                  <th class="d-none d-xl-table-cell text-center">SKU</th>
                  <th class="d-none d-xl-table-cell text-center">Purchase Price</th>
                  <th class="d-none d-xl-table-cell text-center">Purchase Currency</th>
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
    $('#itemTable').DataTable({
      data: @json($data['items']),
      columnDefs: [{
        "className": "dt-center",
        "targets": "_all",
      }],
      columns: [{
          data: 'trade_name'
        },
        {
          data: 'sku'
        },
        {
          data: 'purchase_price'
        },
        {
          data: 'purchase_currency'
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