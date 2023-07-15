@extends('back.master')

@section('title','Users Page')
@section('users','active')

@section('content')

<div class="card">
  
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5>Users</h5>

    <div>
      @if(permission('add_user'))
      <button type="button" class="btn btn-primary" onclick="location.href='{{ route('back.users.create') }}'">Add New</button>
      @endif
    </div>

  </div>
  

  <div class="card-body">

    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>created_at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ date("Y-m-d", strtotime($user['created_at'])) }}</td>
                <td>
                  
                  @if(permission('show_user'))
                  <button type="button" class="btn btn-info" style="margin-right: 5px;" onclick="location.href='{{ route('back.users.show',  $user['id']) }}'">
                    <i class="fa-regular fa-eye"></i>
                  </button>
                  @endif

                  @if(permission('edit_user'))
                  <button type="button" class="btn btn-success" style="margin-right: 5px; background:#09d309" onclick="location.href='{{ route('back.users.edit',  $user['id']) }}'">
                    <span class="tf-icons bx bx-edit m-auto"></span>
                  </button>
                  @endif

                  @if(permission('delete_user'))
                  <form class="d-inline deleteForm" action="{{ route('back.users.destroy', $user['id']) }}" method="POST">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn rounded-pill btn-danger">
                    <span class="tf-icons bx bx-trash"></span></button>
                  </form>
                  @endif

                </td>
            </tr>
            @endforeach
        </tfoot>
    </table>
    

  </div>

</div><div class="col"></div>


  <script>
  let table = new DataTable('#myTable', {
    aoColumnDefs: [
        { "bSortable": false, "aTargets": [ 4 ] }, 
    ],
    dom: "<'row mb-2 justify-content-between align-items-center'<'col-md-8'B><'col-md-3'f>> <'clear'> rt<'mb-4'i> <'row justify-content-between align-items-center'<'col'l><'col'p>>",
    buttons: [
        {
            extend: 'copyHtml5',
            className: 'btn-primary',
            text: '<i class="fas fa-copy"></i> Copy',
            titleAttr: 'Copy'
        },
        {
            extend: 'excelHtml5',
            className: 'btn-primary',
            text: '<i class="fas fa-file-excel"></i> Excel',
            titleAttr: 'Excel'
        },
        {
            extend: 'csvHtml5',
            className: 'btn-primary',
            text: '<i class="fas fa-file-csv"></i> CSV',
            titleAttr: 'CSV'
        },
        {
            extend: 'pdfHtml5',
            className: 'btn-primary',
            text: '<i class="fas fa-file-pdf"></i> PDF',
            titleAttr: 'PDF'
        },
        {
            extend: 'print',
            className: 'btn-primary',
            text: '<i class="fas fa-print"></i> Print',
            titleAttr: 'Print'
        }
    ]
  });

  $(document).ready(function() {
    $(".deleteForm").submit(function(e){
      if(!confirm('Do you want to delete ?')){
        e.preventDefault(e);
      }
    });
  });

  </script>
@endsection