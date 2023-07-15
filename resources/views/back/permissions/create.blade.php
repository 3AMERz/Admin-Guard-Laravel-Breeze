@extends('back.master')

@section('title','Create Permission Page')
@section('permissions','active')

@section('content')

<div class="card">
  
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5>Create Permission</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.permissions.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
    <form action="{{ route('back.permissions.store') }}" method="POST">
      <div class="row card-body">
        @csrf

        <div class="col-md-4 mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="name" value="{{ old('name') ?: old('name') }}" placeholder="Enter a name">
          <div class="form-text text-danger">
            @if ($errors->has('name'))
                @foreach( $errors->get('name') as $error)
                <p>{{ $error }}</p>
                @endforeach
            @endif
          </div>
        </div>

        <div class="col-md-8 mb-4">
          <label for="description" class="form-label">Description</label>
          <input type="text" name="description" class="form-control" id="description" value="{{ old('description') ?: old('description') }}" placeholder="Enter a description">
          <div class="form-text text-danger">
            @if ($errors->has('description'))
                @foreach( $errors->get('description') as $error)
                <p>{{ $error }}</p>
                @endforeach
            @endif
          </div>
        </div>

        
        <div class="d-flex justify-content-between align-items-center">
          <div class=""></div>
          <button type="submit" class="btn btn-primary rounded-pill">Create</button>
        </div>

      </div>
    </form>

  

</div>

@endsection