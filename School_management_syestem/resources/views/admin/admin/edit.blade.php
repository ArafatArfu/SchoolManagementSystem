@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">

                
              <form method="post" action="">                      {{--Added--}}

                {{ csrf_field() }}                                {{--Added--}}

                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name',$getRecord->name) }}" required placeholder="Name">
                      </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('emil',$getRecord->email) }}" required placeholder="Email">
                    <div style="color:red">{{ $errors->first('email') }}</div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <p>Do you want to change password so please add new password</p>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection