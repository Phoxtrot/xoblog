@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Category</h4>
                  <form method='post' action="{{route('category.store')}}" class="forms-sample ">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                      <input type="text" class="form-control " name="title" id="exampleInputUsername1" placeholder="Title" value="{{old('title')}}">
                      @error('title')
                    	<p class="error" style="color: #ed3c0d;text-align: left;">
                   		{{ $message }}
                    	</p>
                      @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>


          </div>
        </div>

@endsection
