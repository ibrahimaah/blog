@extends('main')
@section('title',' All Users')

@section('style')
<style>

</style>
@endsection

@section('content')


<div class="row">
    <div class="col-md-10">
        <h2 class="display-4">Users Management</h2>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover text-center">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </thead>
            <tbody>
            @isset($users)
             @foreach($users as $user)
                <tr>
                    <td> {{ $user->id }}    </td>
                    <td> {{ $user->name }}  </td>
                    <td> {{ $user->email }} </td>
                    <!-- we use pluck to retrieve data from array of objects -->
                    <!-- $user->roles i.e $user->roles()->get() -->
                    <!-- toArray() function convert collection to array -->
                    <td> {{ implode(' - ',$user->roles->pluck('role_name')->toArray()) }} </td>
                    <td>
                    @can('edit-user')
                        <a href="{{route('users.edit',$user->id)}}" class="btn btn-warning float-left">
                            Edit
                        </a>
                    @endcan
                    @can('delete-user')
                        <form action="{{route('users.destroy',$user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger float-left ml-2">
                        </form>
                    @endcan
                    </td>
                </tr>
             @endforeach
            @endisset
            </tbody>
        </table>
        
    </div>
</div>



@endsection