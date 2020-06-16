@extends('main')

@section('title',' Create a new post')

@section('style')
<link rel="stylesheet" href="/css/parsley.min.css">
<link rel="stylesheet" href="/css/select2.css">

<!--<script src="/js/tinymce/js/tinymce/tinymce.min.js"></script>-->
<script>
    //tinymce.init({
    //selector: '#id_body',  // change this value according to your HTML
    //plugins:"link code",
    //menubar:false
    //});

</script>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
    <h2 class="display-4">Create New Post </h2>
    
        <form action="{{ route('posts.store') }}" 
              method="POST" 
              class="border p-4" 
              data-parsley-validate 
              enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_title">Title :</label>
                <input type="text" name="title" value="{{ old('title') }}" id="id_title" class="form-control" 
                       data-parsley-required="true" data-parsley-maxlength="255">
            </div>

            <div class="form-group">
                <label for="id_body">Body :</label>
                <textarea name="body" id="id_body" rows="5" class="form-control" data-parsley-required>{{ old('body') }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="id_slug">URL :</label>
                <input type="text" name="slug" value="{{ old('slug') }}" id="id_slug" class="form-control" 
                       data-parsley-required="true" data-parsley-maxlength="255">
            </div>

            <div class="form-group">
                <label for="id_slug">Category :</label>
                <select name="category_id" id="" class="form-control">
                @isset($categories)
                    @foreach($categories as $category)
                        <option 
                         value="{{ $category->id ?? '' }}" 
                         {{ (old('category_id') == $category->id) ? 'selected' : ''}}>
                         {{ $category->name ?? '' }}
                        </option>
                    @endforeach
                @endisset
                </select>
            </div>

            <div class="form-group">
                <label>Tags :</label>
                <select 
                    class="select-multiple form-control"
                    name="tags[]"  
                    multiple="multiple">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="custom-file mb-4">
                <input type="file" class="custom-file-input" 
                       id="customFile" name="post_img"
                       value="{{ old('post_img') }}">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>

            <div class="form-group">
                <input type="submit" value="Create A New Post" class="btn btn-success btn-lg btn-block">
            </div>

        </form>
    </div>
</div>
<div class="row">
    <a href="{{ url()->previous() }}" class="btn btn-danger"><< Back</a>
</div>

@endsection

@section('script')
<!--<script src="/js/parsley.min.js"></script>-->
<script src="/js/select2.js"></script>
<script>

$(function(){

    $('.select-multiple').select2();

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    
});

</script>
@endsection
