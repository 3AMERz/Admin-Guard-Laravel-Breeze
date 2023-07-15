@extends('back.master')

@section('title','Edit Permission Page')
@section('permissions','active')

@section('content')

<div class="card">
  
  <div class="card-header d-flex justify-content-between align-items-center pb-0">
    <h5>Edit Permission</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.permissions.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
    <form action="{{ route('back.permissions.update', $permission->id) }}" method="POST">
      <div class="row card-body">
        @csrf
        {{ method_field('PUT') }}

        <div class="col-md-4 mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="name" value="{{ old('name') ? old('name') : ucwords(str_replace('_', ' ', $permission->name))}}" placeholder="Enter a name">

          <div class="form-text text-danger">
            @if($errors->has('name'))
            @foreach($errors->get('name') as $error)
            <p>{{ $error }}</p>
            @endforeach
            @endif
          </div>
        </div>

        <div class="col-md-8 mb-4">
          <label for="description" class="form-label">Description</label>
          <input type="text" name="description" class="form-control" id="description" placeholder="Enter a description" value="{{ old('description') ? old('description') : $permission->description}}">

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
          <button type="submit" class="btn btn-primary rounded-pill">Update</button>
        </div>

      </div>
    </form>

  

</div>

@endsection