@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Assign Subject</h1>
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

                                <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>        {{--Added--}}
                                
                            @endforeach
                        </select>
                
                    </div>

                    <div class="form-group">
                      <label>Subject Name</label>
                      <select class="form-control" name="subject_id" required>
                          <option value="">Select Subject</option>

                          @foreach ($getSubject as $subject)

                              <option {{ ($getRecord->subject_id == $subject->id) ? 'selected' : '' }} value="{{ $subject->id }}">{{ $subject->name }}</option>        {{--Added--}}
                              
                          @endforeach
                      </select>
              
                  </div>





                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                            <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                        </select>
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