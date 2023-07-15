@extends('back.master')

@section('title','Show User Page')
@section('users','active')

@section('content')

<div class="card">
  
  <div class="card-header pb-2 d-flex justify-content-between align-items-center">
    <h5>Show User</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.users.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
      <div class="row card-body">

        <div class="col-md-6 mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
        </div>

        <div class="col-md-6 mb-4">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>

        <div class="col-md-6 mb-4 form-password-toggle">
          <div class="d-flex justify-content-between">
            <label class="form-label" for="password">Password</label>
            <div></div>
          </div>

          <div class="input-group input-group-merge">
            <input
              type="password"
              id="password"
              class="form-control"
              name="password"
              placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
              aria-describedby="password"
              value="{{ $user->password }}"
              readonly
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
        </div>

        
        <div class="col-md-6 mb-4">
          <label for="created_at" class="form-label">Created At</label>
          <input type="text" class="form-control" id="created_at" value="{{ date("Y-m-d (h:ia)", strtotime($user->created_at)) }}" readonly>
        </div>
        
        <div class="col-md-6 mb-4">
          <label for="updated_at" class="form-label">Updated At</label>
          <input type="text" class="form-control" id="updated_at" value="{{ date("Y-m-d (h:ia)", strtotime($user->updated_at)) }}" readonly>
        </div>

      </div>

      

  

</div>

@endsection