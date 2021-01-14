@extends('layouts.app')

@section('content')
    <div class="container my-5 py-5">
       <div class="col-md-8">
          <div class="card">
             <div class="card-header">
                Change Password
             </div>
             <div class="card-body">
                <form action="{{route('account.edit')}}" method="POST">
                 @csrf
                 @method('patch')
                    <div class="form-group">
                       <label for="old_password">Old Password</label>
                       <input type="password" name="old_password" id="old_password" class="form-control">
                       @error('old_password')
                       <div class="text-danger">
                          {{$message}}
                       </div>
                       @enderror
                     </div>
                     <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                        <div class="text-danger">
                           {{$message}}
                        </div>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="password_confirmation">Old Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                        @error('password_confirmation')
                        <div class="text-danger">
                           {{$message}}
                        </div>
                        @enderror
                     </div>

                     <button type="submit" class="btn btn-secondary rounded-0">Change</button>
                 </form>
              </div>
          </div>
       </div>
    </div>
@endsection