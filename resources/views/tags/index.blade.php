@extends('main')
@section('title',' Tags')

@section('style')
<style>

</style>
@endsection


@section('content')

@if($errors->any())
    <ul>
        @foreach($errors as $error)
            <li class="alert alert-danger">{{$error}}</li>
        @endforeach
    </ul>
@endif

@if(session()->has('success_save_tag'))
<div class="alert alert-success">
    {{session('success_save_tag')}}
</div>
@endif

@if(session()->has('success_delete_tag'))
<div class="alert alert-success">
    {{ session('success_delete_tag') }}
</div>
@endif
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <th>#</th>
                <th>Tag Name</th>
            </thead>
            <tbody>
            @isset($tags)
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td><a href="{{route('tags.show',$tag->id)}}">{{ $tag->name }}</a></td>
                </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
    <div class="offset-md-1"></div>
    <div class="col-md-5">
    <h2>Add New tag</h2>
    <form action="{{route('tags.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Tag name : </label>
            <input type="text" name="name" class="form-control" 
                   placeholder="Add A New tag">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Add tag">
        </div>
    </form>
    </div>
</div>
@endsection