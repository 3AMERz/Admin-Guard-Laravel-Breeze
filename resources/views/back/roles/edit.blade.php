@extends('back.master')

@section('title','Edit Role Page')
@section('roles','active')

@section('content')

<div class="card">
  
  <div class="card-header d-flex justify-content-between align-items-center pb-0">
    <h5>Edit Role</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.roles.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
    <form action="{{ route('back.roles.update', $role->id) }}" method="POST">
      <div class="row card-body">
        @csrf
        {{ method_field('PUT') }}


        <div class="col-md-4 mb-4">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="Enter a name" value="{{ old('name') ? old('name') : $role->name}}">
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
          <input type="text" name="description" class="form-control" id="description" placeholder="Enter a description" value="{{  old('description') ? old('description') : $role->description}}">
          <div class="form-text text-danger">
            @if ($errors->has('description'))
                @foreach( $errors->get('description') as $error)
                <p>{{ $error }}</p>
                @endforeach
            @endif
          </div>
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

            <div class="row" style="max-height: 260px; overflow-y:auto">
            @foreach($permissions as $permission)
            <div class="col-4 my-2">
              <div class="form-check custom-option custom-option-basic 
              @if(is_array(old('permissions')) && in_array($permission->name, old('permissions')))
              checked
              @else
              @checked($role->hasPermissionTo($permission->name) && is_null(old('_token')))
              @endif">
                <label class="form-check-label custom-option-content" for="customCheck{{ $permission->id }}">

                  <input id="customCheck{{ $permission->id }}" 
                  class="form-check-input checkbox-input" 
                  type="checkbox" 
                  name="permissions[]" 
                  value="{{ $permission->name }}"
                  @if(is_array(old('permissions')) && in_array($permission->name, old('permissions')))
                  checked
                  @else
                  @checked($role->hasPermissionTo($permission->name)  && is_null(old('_token')))
                  @endif
                  >
                  
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
        </div>
          
          

        <div class="col-md-12 mb-3">
          <div class="row">
            <label class="form-label m-0">Icon</label>

            <div class="form-text text-danger">
              @if($errors->has('icon'))
              @foreach($errors->get('icon') as $error)
                <p>{{ $error }}</p>
              @endforeach
              @endif
            </div>

            
            <div class="row" style="max-height: 146px; overflow-y:auto">
              @foreach($icons as $icon)
              <div class="col-1 my-2 mx-1 p-0">
                <div class="form-check custom-option custom-option-image custom-option-image-radio 
                @if(old('icon') ==  $icon)
                checked
                @else
                @checked($icon == $role->icon && is_null(old('icon')))
                @endif
                ">

                  <label class="form-check-label custom-option-content radio-lable d-flex justify-content-center align-items-center" style="height: 50px;" for="customRadio_{{ $icon }}">
                    <span class="custom-option-body">
                      <i class="bx bx-{{ $icon }}" style="font-size:25px"></i>
                    </span>
                  </label>

                  <input id="customRadio_{{ $icon }}" class="form-check-input radio-input" name="icon" type="radio" value="{{ $icon }}"
                  @if(old('icon') ==  $icon)
                  checked
                  @else
                  @checked($icon == $role->icon && is_null(old('icon')))
                  @endif >

                </div>
              </div>
              @endforeach            
            </div>
          </div>
        </div>


        <div class="d-flex justify-content-between align-items-center">
          <div class=""></div>
          <button type="submit" class="btn btn-primary rounded-pill">Update</button>
        </div>

      </div>
    </form>

  

</div>


<script>

  $(".checkbox-input").change(function() {
    let CheckboxCard = $(this).parent().closest('.custom-option');
    if(this.checked) {
        $(CheckboxCard).addClass('checked');
    }else{
      $(CheckboxCard).removeClass('checked');
    }
  });

  $(".radio-input").change(function() {
    let radioCard = $(this).parent().closest('.custom-option-image-radio');
    let radioCards = $('.custom-option-image-radio');

    $(radioCards).removeClass('checked');
    $(radioCard).addClass('checked');
  });

</script>

@endsection