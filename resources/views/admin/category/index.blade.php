@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
          <div class="row">
          @if (\Session::has('message'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('message') !!}</li>
                </ul>
            </div>
        @endif
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">

                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Categories</h4>
                                  </div>
                                  <div>
                                    <a href="{{route('category.create')}}">
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new Category</button>
                                    </a>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                        <tr>
                                        <td>
                                          <h6>{{ $category->title }}</h6>
                                        </td>
                                        <td>
                                          <h6>{{ $category->user->name }}</h6>
                                        </td>
                                        <td>
                                        <a href="{{ route('category.edit',$category->id) }}">
                                            <button class="btn btn-success btn-lg text-white mb-0 me-0" type="button"></i>Edit</button>
                                        </a>
                                        <form action="{{route('category.destroy',$category->id)}}" method="post">
                                            @method("DELETE")
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-lg text-white mb-0 me-0" type="button"></i>Delete</button>
                                        </form>
                                        </td>
                                      </tr>
                                        @endforeach

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
