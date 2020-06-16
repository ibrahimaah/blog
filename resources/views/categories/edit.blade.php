@extends('main')

@section('title',' Categories')

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

@if(session('success_save_category'))
<div class="alert alert-success">
    {{session('success_save_category')}}
</div>
@endif



<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead>
                <th>#</th>
                <th>Category</th>
                <th>Action</th>
            </thead>
            <tbody>
            @isset($categories)
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit',$category->id) }}"
                           class="btn btn-warning float-left">
                           Edit
                        </a>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger float-left ml-2">
                        </form>
                    </td>
                </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
    <div class="offset-md-1"></div>
    <div class="col-md-5">
    <h2>Edit Category</h2>
 
    <form action="{{route('categories.update',$cat->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>category name : </label>
            <input type="text" name="name" class="form-control" value="{{ old('name',$cat->name) }}">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Save">
            <a href="{{ route('categories.index') }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
    </div>
</div>
@endsection