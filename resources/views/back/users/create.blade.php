@extends('back.master')

@section('title','Create User Page')
@section('users','active')

@section('content')

<div class="card">
  
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5>Create User</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.users.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
    <form action="{{ route('back.users.store') }}" method="POST">
      <div class="row card-body">
        @csrf

        <div class="col-md-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Enter a name">

          <div class="form-text text-danger">
            @if ($errors->has('name'))
                @foreach( $errors->get('name') as $error)
                <p>{{ $error }}</p>
                @endforeach
            @endif
          </div>

        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="text" name="email" class="form-control" id="email" placeholder="Enter an email">

          <div class="form-text text-danger">
            @if($errors->has('email'))
            @foreach($errors->get('email') as $error)
            <p>{{ $error }}</p>
            @endforeach
            @endif
          </div>

        </div>

        <div class="my-3 form-password-toggle">

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
            />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
          </div>
          
          <div class="form-text text-danger">
            @if($errors->has('password'))
            @foreach($errors->get('password') as $error)
            <p>{{ $error }}</p>
            @endforeach
            @endif
          </div>

        </div>

        <div class="d-flex justify-content-between align-items-center">
          <div class=""></div>
          <button type="submit" class="btn btn-primary rounded-pill">Update</button>
        </div>

      </div>
    </form>

  

</div>

@endsection