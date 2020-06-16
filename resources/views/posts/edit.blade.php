@extends('main')

@section('title',' Edit Post')

@section('style')
<link rel="stylesheet" href="/css/parsley.min.css">
<link rel="stylesheet" href="/css/select2.css">
@endsection

@section('content')
<?php
    $arr_id_tags=[];
    foreach($post->tags as $tag)
    {
        $arr_id_tags[]=$tag->id;
    }
    $tag_Ids = implode('' , $arr_id_tags);
    //var_dump($tag_Ids);
    //dd($arr_id_tags);
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
    <h2 class="display-4">Edit Post </h2>
    
        <form action="{{ route('posts.update',$post->id) }}"
              method="POST" 
              class="border p-4" 
              data-parsley-validate
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="id_title">Title :</label>
                <input type="text" name="title"
                value="{{ old('title',$post->title) }}" 
                id="id_title" class="form-control" 
                data-parsley-required="true" data-parsley-maxlength="255">

            </div>

            <div class="form-group">
                <label for="id_body">Body :</label>
                <textarea name="body" id="id_body" rows="5" class="form-control" 
                data-parsley-required>{{old('body',$post->body)}}
                </textarea>
            </div>

            <div class="form-group">
                <label for="id_slug">URL :</label>
                <input type="text" name="slug" value="{{ old('slug',$post->slug) }}" 
                       id="id_slug" class="form-control" data-parsley-required="true" 
                       data-parsley-maxlength="255">
            </div>

            <div class="form-group">
                <label for="">Category : </label>
                <select name="category_id" id="" class="form-control">
                @if(is_null(old('category_id')))
                    @foreach($categories as $id => $cat_name)
                        <option value="{{ $id }}" 
                            {{ ( $post->category_id == $id) ? 'selected' : ''}}>
                            {{$cat_name}}
                        </option>
                    @endforeach
                @else
                    @foreach($categories as $id => $cat_name)
                        <option value="{{ $id }}" 
                            {{ (old('category_id') == $id) ? 'selected' : ''}}>
                            {{$cat_name}}
                        </option>
                    @endforeach
                @endif

                </select>
            </div>
            
            <div class="form-group">
                <label>Tags :</label>
                <select 
                    class="select-multiple form-control"
                    name="tags[]"  
                    multiple="multiple">
                    
                    @foreach($tags as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
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
                <input type="submit" value="Save" class="btn btn-success ">
                <a href="{{ route('posts.show',$post->id) }}" class="btn btn-danger">Cancel</a>
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
    var x = ({{ ((is_null($tag_Ids) || !isset($tag_Ids) || $tag_Ids=='')) ? '0' : $tag_Ids}} ).toString();
    //if the post has no tags releted to it
    if(x!=0)
    {
        $('.select-multiple').val(x.split("")).trigger('change');
    }

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
</script>
@endsection
