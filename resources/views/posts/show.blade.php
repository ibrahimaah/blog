@extends('main')

@isset($post)
    @section('title',' Post '. $post->id)
@endisset 

@section('content')

@if($errors->any())
  <ul>
  @foreach($errors as $error)
    <li>
      <div class="alert alert-danger">{{$error}}</div>
    </li>
  @endforeach
  </ul>
@endif

@if(session()->has('success_update'))
  <div class="alert alert-success">{{ session('success_update') }}</div>
@endif


<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> 
           @isset($post)
             {{$post->title}} 
           @endisset
         </h4>
         <div class="mb-4">
            <span class="text-secondary font-size-18">By {{$post->user->name}} / </span>
            <span class="text-secondary font-size-18">
                {{ date("j M Y ",strtotime($post->created_at))}} 
            </span> 
         </div>

        @isset($post->img)
          <img src="{{ asset('img/'.$post->img) }}" alt="POST IMAGE" class="card-img-top mb-4">
        @endisset

        <p class="card-text">
          @isset($post)
            {!! $post->body !!} 
          @endisset
        </p>
        
        @foreach($post->tags as $tag)
        <span class="badge badge-secondary">{{ $tag->name }}</span>
        @endforeach
      </div>
    </div>
    <div class="row mt-4">
      <a href="{{ url()->previous() }}" class="btn btn-danger"><< Back</a>
    </div>
  </div>
  <div class="col-md-5">
    <div class="card">
      <div class="card-body">
        <div class="card-title text-center font-weight-bold">POST INFORMATION</div>
        <div class="card-text">
          <ul class="list-group">

            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                 Post URL
                </div>
                <div class="col-md-8">
                  @isset($post)
                  <a href="{{ route('blog.single',$post->slug) }}" target='_blank'>
                    {{ route('blog.single',$post->slug) }}
                  </a> 
                  @endisset
                </div>
              </div>
            </li>

            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                  Category
                </div>
                <div class="col-md-8">
                  @isset($post)
                   {{ $post->category->name }} 
                   @endisset
                </div>
              </div>
            </li>
            
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                 Created At
                </div>
                <div class="col-md-8">
                  @isset($post)
                   {{ date("j M Y / g:i a",strtotime($post->created_at))}} 
                   @endisset
                </div>
              </div>
            </li>

            <?php 
                /* If u want to convert the date in the database to a date formate that
                  u want then first u have to convert the database date to timestamp then
                  using that timestamp to create a readable date with the formate u want
                */
                /*
                  If u want to compare two dates then u have to convert both to timestamp then
                  do compare
                */
                /*
                  u can use timestamp also if u want thing for example that
                  happened in the past two weeks
                */
            ?>
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-4 font-weight-bold">
                 Updated At
                </div>
                <div class="col-md-8">
                  @isset($post)
                   {{ date("j M Y / g:i a",strtotime($post->updated_at))}} 
                   @endisset
                </div>
              </div>
            </li>

          </ul>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-6">
           @isset($post)
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-block">
            Edit Post <i class="fa fa-edit"></i>
            </a>
           @endisset
          </div>
          <div class="col-md-6">
          @isset($post)
            <a href="{{ route('delete_post', $post->id) }}" class="btn btn-danger btn-block">
            Delete Post <i class="fa fa-trash"></i>
            </a>
          @endisset
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <a href="{{ route('posts.create') }}" 
            class="btn btn-block btn-primary mt-4">Create New Post 
           <i class="fa fa-plus"></i> 
          </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <a href="{{ route('posts.index') }}" 
            class="btn btn-block btn-info mt-4">Show All Posts >>
          </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection