@extends('main')
@section('title',' All Posts')

@section('style')
<style>
.pagination {
   justify-content: center;
}
</style>
@endsection

@section('content')

@if(session('success_delete'))
<div class="alert alert-danger">{{session('success_delete') }}</div>
@endif

<div class="row">
    <div class="col-md-10">
        <h2 class="display-4">All Posts</h2>
    </div>
    <div class="col-md-2">
        <a href="{{ route('posts.create') }}" 
        class="btn btn-block btn-primary mt-4">Create New Post</a>
    </div>
</div>
@if(!$posts->isEmpty())
<div class="row mt-2">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created At</th>
                <th>Action</th>
            </thead>
            <tbody>
            @isset($posts)
             @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>
                       {{ substr($post->title,0,15) }} {{ (strlen($post->title)>=15)?'...':'' }}
                    </td>
                    <?php 
                    // we dont want to show ... in post body which length is less of 50 chars
                    // OR <?=(strlen($post->body)>=50)?'...':''?>
                    <td class="text-left">
                        {!! substr($post->body,0,50) !!} {!! (strlen($post->body)>=50)?'...':'' !!}
                    </td>
                    <td>{{ date('j M Y',strtotime($post->created_at)) }}</td>
                    <td>
                        <a href="{{ route('posts.show',$post->id) }}" 
                           class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('posts.edit',$post->id) }}" 
                           class="btn btn-sm btn-warning">Edit  <i class="fa fa-edit"></i></a>
                        <a href="{{ route('delete_post',$post->id) }}" 
                        class="btn btn-sm btn-danger" >
                        Delete  <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
             @endforeach
            @endisset
            </tbody>
        </table>
        <div class="text-center">{{$posts->links()}}</div>
        <div class="text-center lead">
            Page  {{$posts->currentPage()}}  Of  {{$posts->lastPage()}} 
        </div>
    </div>
</div>

@else
<div class="alert alert-info display-4">Sorry There Are No Posts :( </div>
@endif

@endsection