@extends('back.master')

@section('title','Show Role Page')
@section('roles','active')

@section('content')

<div class="card">
  
  <div class="card-header pb-2 d-flex justify-content-between align-items-center">
    <h5>Show Role</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.roles.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
      <div class="row card-body">

        <div class="col-md-4 mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Enter a name" value="{{ $role->name }}" disabled>
        </div>

        <div class="col-md-8 mb-4">
          <label for="description" class="form-label">Description</label>
          <input type="text" name="description" class="form-control" id="description" placeholder="Enter a description" value="{{ $role->description }}" disabled>
          
        </div>

        <div class="col-md-12 mb-3">
          <div class="row">
            <label class="form-label m-0">Permissons</label>

            <div class="form-text text-danger">
              @if($errors->has('permissions'))
              @foreach($errors->get('permissions') as $error)
                <p>{{ $error }}</p>
              @endforeach
              @endif
            </div>

            @foreach($permissionsOfRole as $permission)
            <div class="col-4 my-2">
              <div class="form-check custom-option custom-option-basic checked ">
                <label class="form-check-label custom-option-content" 
                for="customCheck{{ $permission->id }}"
                style="cursor: auto;">

                  <input id="customCheck{{ $permission->id }}" class="form-check-input checkbox-input" type="checkbox" checked disabled>
                  
                  <span class="custom-option-header">
                    <span class="fw-semibold">{{ ucwords(str_replace('_', ' ', $permission->name))  }}</span>
                    {{-- <span class="fw-semibold">Free</span> --}}
                  </span>
                  <span class="custom-option-body">
                    <small> 
                      {{ $permission->description }}
                      {{-- Get Updates regarding related products.  --}}
                    </small>
                  </span>
                </label>
              </div>            
            </div>
            @endforeach

          </div>
        </div>
          
          

        <div class="col-md-12 mb-3">
          <div class="row">
            <div class="col">
              <label class="form-label m-0">Icon</label>
              
              <div class="col-1 my-2 mx-1 p-0">
                <div class="form-check custom-option custom-option-image custom-option-image-radio checked">

                  <label class="form-check-label custom-option-content radio-lable d-flex justify-content-center align-items-center"
                   style="height: 50px; cursor: auto;" 
                   for="customRadio_{{ $role->icon }}">
                    <span class="custom-option-body">
                      <i class="bx bx-{{ $role->icon }}" style="font-size:25px"></i>
                    </span>
                  </label>

                  <input id="customRadio_{{ $role->icon }}" class="form-check-input radio-input" name="icon" type="radio" value="{{ $role->icon }}">

                </div>
              </div>
            </div>
          </div>
          
          
          





        </div>

        
        <div class="col-md-6 mb-4">
          <label for="created_at" class="form-label">Created At</label>
          <input type="text" class="form-control" id="created_at" value="{{ date("Y-m-d (h:ia)", strtotime($role->created_at)) }}" readonly>
        </div>
        
        <div class="col-md-6 mb-4">
          <label for="updated_at" class="form-label">Updated At</label>
          <input type="text" class="form-control" id="updated_at" value="{{ date("Y-m-d (h:ia)", strtotime($role->updated_at)) }}" readonly>
        </div>

      </div>

      

  

</div>

@endsection