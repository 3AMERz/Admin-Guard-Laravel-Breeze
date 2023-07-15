@extends('back.master')

@section('title','Show Permission Page')
@section('permissions','active')

@section('content')

<div class="card">
  
  <div class="card-header pb-2 d-flex justify-content-between align-items-center">
    <h5>Show Permission</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.permissions.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
      <div class="row card-body">

        <div class="col-md-4 mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" value="{{ ucwords(str_replace('_', ' ', $permission->name)) }}" readonly>
        </div>

        <div class="col-md-8 mb-4">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" value="{{ $permission->description }}" readonly>
        </div>
        
        <div class="col-md-6 mb-4">
          <label for="created_at" class="form-label">Created At</label>
          <input type="text" class="form-control" id="created_at" value="{{ date("Y-m-d (h:ia)", strtotime($permission->created_at)) }}" readonly>
        </div>
        
        <div class="col-md-6 mb-4">
          <label for="updated_at" class="form-label">Updated At</label>
          <input type="text" class="form-control" id="updated_at" value="{{ date("Y-m-d (h:ia)", strtotime($permission->updated_at)) }}" readonly>
        </div>

      </div>

      

  

</div>

@endsection