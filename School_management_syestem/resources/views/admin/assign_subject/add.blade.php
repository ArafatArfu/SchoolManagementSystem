@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Assign Subject</h1>
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
                        <label>Class Name</label>
                        <select class="form-control" name="class_id" required>
                            <option value="">Select Class</option>

                            @foreach ($getClass as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>        {{--Added--}}
                                
                            @endforeach
                        </select>
                
                    </div>

                    <div class="form-group">
                        <label>Class Name</label>

                            @foreach ($getSubject as $subject)
                                <div>
                                    <label style="font-weight: normal">
                                        <input type="checkbox" value="{{ $subject->id }}" name="subject_id[]"> {{ $subject->name }}  {{--Added--}}
                                    </label>
                                    
                                </div>
                            @endforeach

                
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>


            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection