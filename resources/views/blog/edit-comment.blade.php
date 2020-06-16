@extends('main')

@section('title',' Edit Comment')


@section('style')
<style>
</style>
@endsection

@section('content')

<div class="row">
 <form action="{{route('update_comment',['comment_id' => $comment->id])}}"
       method="POST">
 @csrf
 @method('PUT')
 <div class="display-5 mb-4">Edit Comment</div>
 <div class="form-group">
    <textarea class="p-2" name="comment" id="" cols="100" rows="3">{{utf8_decode(old('comment',$comment->comment))}}</textarea>
 </div>
 <div class="form-group">
    <input type="submit" value="save" class="btn btn-primary">
    <a href="{{route( 'blog.single' , ['slug' => $comment->post->slug] )}}" 
       class="btn btn-danger">cancel</a>
 </div>
 </form>   
    
</div>


@endsection

@section('script')
<script src="/emojis/emoji.js"></script>
<script>
$(function(){
    $('textarea').emoji({
        place:'after'
    });
});
</script>
@endsection