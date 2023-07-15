@extends('back.master')

@section('title','Edit Admin Page')
@section('admins','active')

@section('content')

<div class="card">
  
  <div class="card-header d-flex justify-content-between align-items-center pb-0">
    <h5>Edit Admin</h5>
    <div><button type="button" class="btn btn-primary" onclick="location.href = '{{ route('back.admins.index') }}'">
      <div style="font-size:14px; margin-right: 2px" class="fa">&#xf053;</div> <p class="d-inline">Back</p></button>
    </div>
  </div>
  

  
    <form action="{{ route('back.admins.update', $admin->id) }}" method="POST">
      <div class="row card-body">
        @csrf
        {{ method_field('PUT') }}
        <div class="col-md-6">
          <label for="name" class="form-label">Name</label>
          <input type="text" name="name" class="form-control" id="name" value="{{ $admin->name }}" placeholder="Enter a name">

          <div class="form-text text-danger">
            @if($errors->has('name'))
            @foreach($errors->get('name') as $error)
            <p>{{ $error }}</p>
            @endforeach
            @endif
          </div>

        </div>

        <div class="col-md-6">
          <label for="email" class="form-label">Email</label>
          <input type="text" name="email" class="form-control" id="email" value="{{ $admin->email }}" placeholder="Enter an email" aria-describedby="emailDescribe">
          
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
              value="{{ $admin->password }}"
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




        <div class="col-md-12 mb-3">
          <div class="row">
            <label class="form-label m-0">Roles</label>

            <div class="form-text text-danger">
              @if($errors->has('roles'))
              @foreach($errors->get('roles') as $error)
                <p>{{ $error }}</p>
              @endforeach
              @endif
            </div>

            @foreach($roles as $role)
            <div class="col-3 my-2" style="width: 20%">
              <div class="form-check custom-option custom-option-basic custom-option-icon 
              @if(is_array(old('roles')) && in_array($role->name, old('roles')))
              checked
              @else
              @checked($admin->hasRole($role->name) && is_null(old('_token')))
              @endif">
                <label class="form-check-label custom-option-content px-1" for="customCheck{{ $role->id }}">

                  <span class="custom-option-body">
                    <i class="bx bx-{{$role->icon}}"></i>
                    <span class="custom-option-title"> {{ ucwords($role->name)  }} </span>
                    <small>
                      {{ $role->description }}
                      {{-- Get Updates regarding related products. --}}
                    </small>
                  </span>

                  <input id="customCheck{{ $role->id }}" 
                  class="form-check-input checkbox-input" 
                  type="checkbox" 
                  name="roles[]" 
                  value="{{ $role->name }}"
                  @if(is_array(old('roles')) && in_array($role->name, old('roles')))
                  checked
                  @else
                  @checked($admin->hasRole($role->name) && is_null(old('_token')))
                  @endif >

                </label>

              </div>            
            </div>
            @endforeach

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
</script>

@endsection