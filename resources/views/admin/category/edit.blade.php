@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Edit Category</h4>
                  <form method='post' action="{{route('category.update', $category->id)}}" class="forms-sample ">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                      <input type="text" class="form-control " name="title" id="exampleInputUsername1" placeholder="Title" value="{{$category->title}}">
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
