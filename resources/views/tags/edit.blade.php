@extends('main')

@section('title',' Edit Tag')

@section('style')
@endsection

@section('content')
    <div class="row">
        <form action="{{ route('tags.update',$tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Tag name : </label>
                <input type="text" name="name" value="{{ old('name',$tag->name) }}" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="save" class="btn btn-success">
                <a href="{{ route('tags.show',$tag->id) }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('script')
<!--<script src="/js/parsley.min.js"></script>-->
<script>

</script>
@endsection