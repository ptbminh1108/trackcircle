@extends('layouts.admin.app')

@section('content')

<main>
  <div class="row" style="margin-bottom: 10px">
    <div class="d-flex flex-row-reverse">
      <a class="badge bg-danger " href="{{url('/manufacturer/create')}}"> <i class="d-inline" data-feather="plus"></i><span class="d-inline"> Add New Manufacturer</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
      <div class="card flex-fill">
        <div class="card-header">

          <h5 class="card-title mb-0">Manufacturers</h5>
        </div>
        <table class="table table-hover my-0">
          <thead>
            <tr>
              <th class="d-none d-xl-table-cell text-center">Name</th>
              <th class="d-none d-xl-table-cell text-center">Description</th>
              <th class="d-none d-xl-table-cell text-center">Create Time</th>
              <th class="d-none d-xl-table-cell text-center">Update Time</th>
              <th class="d-none d-xl-table-cell text-center">Action</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($manufacturers as $manufacturer)
            <tr>
              <td class="d-none d-xl-table-cell text-center">{{ $manufacturer->name }}</td>
              <td class="d-none d-xl-table-cell text-center">{{ $manufacturer->description }}</td>
              <td class="d-none d-xl-table-cell text-center">{{ $manufacturer->created_at }}</td>
              <td class="d-none d-xl-table-cell text-center">{{ $manufacturer->updated_at }}</td>
              <td class="d-none d-xl-table-cell text-center"> <a class="badge bg-success" href="{{url('/manufacturer/edit/' . $manufacturer->id)}}">
                  <i data-feather="edit"></i>
                </a>
                <form  method="post" action="{{url('/manufacturer/delete/' . $manufacturer->id)}}" >
                  @csrf
                  <button class="badge bg-danger" type = 'submit'>
                    <i data-feather="trash"></i>
                  </button>
                </form></td>
             
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