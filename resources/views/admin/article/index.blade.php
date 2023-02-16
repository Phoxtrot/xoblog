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
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Articles</h4>
                                  </div>
                                  <div>
                                    <a href="{{route('article.create')}}">
                                    <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add new Article</button>
                                    </a>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table table-hover select-table">
                                    <thead>
                                      <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Published</th>
                                        <th>Featured</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($articles as $article)

                                        <tr>
                                        <td>
                                          <h6>{{ $article->id }}</h6>
                                        </td>
                                        <td>
                                          <h6>{{ $article->title }}</h6>
                                        </td>
                                        <td>
                                          <h6>{{ $article->user->name }}</h6>
                                        </td>
                                        <td>
                                            @if ($article->published == 1)
                                            <label class="badge badge-success">Yes</label>
                                            @else
                                            <label class="badge badge-danger">No</label>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($article->featured == 1)
                                            <label class="badge badge-success">Yes</label>
                                            @else
                                            <label class="badge badge-danger">No</label>
                                            @endif
                                        </td>
                                        <td>
                                            <h6>{{$article->created_at->format("d/m/Y")}}</h6>
                                        </td>
                                        <td class='d-flex justify-content-between'>
                                        <a href="{{ route('article.edit',$article->slug) }}">
                                            <button class="btn btn-success btn-lg text-white mb-0 me-0" type="button"></i>Edit</button>
                                        </a>
                                        <a href="{{ route('article.show',$article->slug) }}">
                                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"></i>View</button>
                                        </a>
                                        <form action="{{route('article.destroy',$article->slug)}}" method="post">
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
                                {{ $articles->links() }}
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
