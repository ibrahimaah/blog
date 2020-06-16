@extends('main')
@section('title',' All Users')

@section('style')
<style>

</style>
@endsection

@section('content')



       


<div class="row">
    <div class="col-md-6">
        <h2 class="h1">Edit User {{ $user->name }}</h2>
        <form action="{{ route('users.update', $user) }}" method="post">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="">UserName : </label>
                <input type="text" class="form-control" name="name" 
                value="{{old('name',$user->name)}}">
            </div>
            <div class="form-group">
                <label for="">Email : </label>
                <input type="email" class="form-control" name="email" 
                value="{{old('name',$user->email)}}">
            </div>
           
            <label for="">Roles:</label>
            <div class="form-check form-group">
            @foreach($roles as $role)
                <input type="checkbox" name="roles[]" value="{{$role->id}}"
                {{($user->roles->pluck('id')->contains($role->id)) ? 'checked' : ''}}>
                <label for="">{{ $role->role_name }}</label>
            @endforeach
            </div>
            <input type="submit" value="Save" class="btn btn-primary">
        </form>

    </div>
</div>



@endsection