@extends('main')

@section('title'," $tag->name Tag")

@section('content')

@if($errors->any())
    <ul>
        @foreach($errors as $error)
            <li class="alert alert-danger">{{$error}}</li>
        @endforeach
    </ul>
@endif

@if(session()->has('success_update_tag'))
<div class="alert alert-success">
    {{session('success_update_tag')}}
</div>
@endif

<div class="row">
    <div class="col-md-8">
        <h2 class="h1">
            {{ $tag->name }} Tag 
            <small class="text-muted">
                {{ $tag->posts->count() }} Posts
            </small>
        </h2>
    </div>
    <div class="col-md-4 text-right">
        <a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('delete_tag',$tag->id) }}" class="btn btn-danger">Delete</a>
    </div>
</div>


<div class="row">
    <table class="table table-striped table-bordered table-hover text-center mt-4">
        <thead>
            <th>#</th>
            <th>Title</th>
            <th>Tag</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php 
            /**
             * posts is a dynamic property
             * u can access to posts related to one tag directly and vice versa
             */
        ?>
            @foreach($tag->posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>
                        @foreach($post->tags as $tag)
                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('posts.show',$post->id) }}" 
                          class="btn btn-success btn-sm">view</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
<div class="row">
    <a href="{{ route('tags.index') }}" class="btn btn-danger"><< Back</a>
</div>

    

@endsection