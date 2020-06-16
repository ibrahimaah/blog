<!--
    This view is managed by BlogController
-->
@extends('main')

@section('title',$post->slug)


@section('style')
<style>
    .display-4{
        font-size:2.5rem
    }
    .pagination{
        justify-content:left
    }
    .img-thumbnail-ib {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        width:60px;
        height:60px;
    }
    
    .comment .row img ,  .comment .row h5
    {
        align-self:flex-end;
    }
    .btn-like-result{
        display:none;
    }
    .btn-circle{
        width: 50px; 
        height: 50px; 
        padding: 7px 10px; 
        border-radius: 25px; 
        font-size: 20px; 
        text-align: center;
    }
    .card{
        border: 1px solid #d8d8d8;
        box-shadow: 0 3px 8px rgba(0,0,0,.25);
    }
    /* change tooltip background color */
    .tooltip-inner {
        background-color: #000;
    }
</style>
@endsection

@section('content')


<div class="row">
    <div class="col-md-8">

    @isset($post)
        <div class="card">
            <div class="card-body">

                <h2 class="display-4 mb-2">
                {{$post->title ?? ''}}
                </h2>
                

                <div class="mb-4">
                    <span class="text-secondary font-size-18">By {{$post->user->name}} / </span>
                    <span class="text-secondary font-size-18">
                        {{ date("j M Y ",strtotime($post->created_at))}} /
                    </span> 
                    @foreach($post->tags as $tag)
                    <span>
                        <a href="{{route('get_by_tag',$tag->name)}}">
                            {{$tag->name}}
                        </a>
                    </span>
                        @if(!($loop->last))
                            <span>,</span>
                        @endif
                    @endforeach
                </div>

                @isset($post->img)
                    <img src="{{ asset('img/'.$post->img) }}" alt="POST IMAGE" class="card-img-top mb-4">
                @endisset

                <p class="lead">
                {!! $post->body ?? ''!!}
                </p> 
            
            </div> 
        </div>
    @endisset


        <hr>
            <img src="{{asset('img/icons/eye.png')}}" alt="eye icon" width="20" height="20">
            <span class="num-of-views">{{$post->views ?? "0"}}</span>
        <hr>
        
        <!-- like and dislike buttons -->
        @auth
            <button class="btn {{$liked ? 'btn-primary' : 'btn-light'}} btn-circle mr-2" 
                    id="btn-like">
                <i class='far fa-thumbs-up'></i>
            </button>
            <span id="span-like" class="mr-4">{{ $likes ?? '0' }}</span>
            
            <button class="btn {{$disliked ? 'btn-primary' : 'btn-light'}} btn-circle ml-4 mr-2" 
                    id="btn-dislike">
                <i class='far fa-thumbs-down'></i>
            </button>
            <span id="span-dislike">{{ $dislikes ?? '0' }}</span>
        @endauth

            <div id="btn-result" class="btn-like-result mt-2"></div>

            
        <hr>
    
    <?php 
       // echo Share::page('http://jorenvanhocht.be')->twitter()
       //dd($x);
    ?>

    <div class="d-flex justify-content-left my-4">
        <div id="social-links">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{route('blog.single',$post->slug)}}"
            class="social-button pr-2">
                <img src="{{asset('img/icons/facebook.png')}}" width="40" height="40">  
            </a>
        </div>
        <div id="social-links">
            <a href="https://wa.me/?text={{route('blog.single',$post->slug)}}"
            class="social-button pr-2">
                <img src="{{asset('img/icons/whatsapp.svg')}}" width="40" height="40">
            </a>
        </div>
        <div id="social-links">
            <a href="https://telegram.me/share/url?url={{route('blog.single',$post->slug)}}"
            class="social-button ">
                <img src="{{asset('img/icons/telegram.svg')}}" width="40" height="40">
            </a>
        </div>
    </div>

        @if(session('cannt_comment'))
            <div class="alert alert-warning text-center">
                {{session('cannt_comment')}} &#128517;
            </div>
        @endif
        <div class="display-6 mb-4">Add Comment</div>
        @if(session('success_comment'))
            <div class="alert alert-success">{{session('success_comment')}}</div>
        @endif
        
        <form action="{{ route('add_comment',['post_id'=>$post->id]) }}" method="POST">
        @csrf
            <div class="form-group">
                <textarea class="p-2" 
                          name="comment" 
                          placeholder="Type your comment"
                          rows=4 
                          style="width:100%" 
                          id="txt_comment"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" 
                       class="btn btn-primary" 
                       value="Add Comment">
            </div>
        </form>
        <hr>
        <div class="display-6 mb-4">Comments ({{$comments_count}})</div>
        <div class="all-comments">
        
        @foreach($comments as $comment)
        
            <div class="comment mb-4">
                <div class="row mb-4">
                    <img src="/img/profile.jpg" alt="profile image" class="rounded-circle img-thumbnail-ib" id="{{$comment->id}}">
                    <h5 class="ml-2">{{$comment->user->name}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-8">

                        <div class="mb-4">
                            {{utf8_decode($comment->comment)}}
                        </div>
                    @if(Auth::check())
                        @if(Auth::user()->id == $comment->user->id || Auth::user()->fun_has_role('admin'))
                            <div class="comment-action mt-2">
                               <a href="{{route('edit_comment',['comment_id'=>$comment->id])}}" 
                                   class="btn btn-warning btn-sm float-left">Edit</a>
                               <form action="{{route('delete_comment',['comment_id'=>$comment->id])}}"                      method="post" class="float-left">
                               @csrf
                               @method('DELETE')
                               <input type="submit" class="btn btn-danger btn-sm ml-2" value="Delete">
                               </form>
                            </div>
                        @endif
                    @endif

                    </div>
                </div>
            </div>
            @isset($comment->created_at)
            <small>Commented at - <span class="text-secondary">
                {{date('j M Y | H:i a',strtotime($comment->created_at)) }}</span></small>
            @else
            <small>Commented at - <span class="text-secondary">unKnown</span> </small>
            @endisset
            <hr>
        @endforeach
        </div>
        
        <a href="{{ url()->previous() }}" class="btn btn-danger mt-4 mb-4"><< Back</a>
    </div>
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header text-center">
                Related Posts
            </div>
            <div> 
                <ul class="list-group list-group-flush">
                    @foreach($related_posts as $p)
                    <li class="list-group-item">
                        <a href="{{route('blog.single',$p->slug)}}">
                        >> {!! substr($p->title,0,30) !!} {!! (strlen($p->title)>=30)?'...':'' !!}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    <!--<div class="offset-md-1 col-md-3">
        <h2 class="">Sidebar</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At, quam porro? Tenetur aspernatur eveniet numquam ab quos iusto quidem distinctio sit doloremque. Quae mollitia accusantium ad explicabo reiciendis assumenda natus.</p>
    </div>-->
    
</div>


@stop

@section('script')
<script src="/emojis/emoji.js"></script>

<script>
$(function(){

    $('textarea').emoji({
        place:'after'
    });

    function ajax_like(btn_state)
    {
        $.ajax({
            url     : "{{ route('ajax_like',$post->id) }}" ,
            method  : "GET" ,
            data    : {
                state : btn_state
            },
            success : function(data){
                $('#span-like').text(data.likes);
                $('#span-dislike').text(data.dislikes);
            },
            error : function(){
                alert('error');
            }
        });
    }
    
    function control_class(obj , removed_class , added_class)
    {
        $(obj).removeClass(removed_class).addClass(added_class);
    }

    function addlike()
    {
        ajax_like('add_like');
        control_class('#btn-like','btn-light','btn-primary');
        control_class('#btn-dislike','btn-primary','btn-light');
    }
    function un_like()
    {
        ajax_like('unlike');
        control_class('#btn-like','btn-primary','btn-light');
    }
    function add_dislike()
    {
        ajax_like('add_dislike');
        control_class('#btn-dislike','btn-light','btn-primary');
        control_class('#btn-like','btn-primary','btn-light');
    }
    function un_dislike()
    {
        ajax_like('undislike');
        control_class('#btn-dislike','btn-primary','btn-light');
    }

    $('#btn-like').on('click',function()
    {
        if($(this).hasClass('btn-light')) 
        {
            addlike();
        }    
        else
        {
            un_like();
        }
    });

    $('#btn-dislike').on('click',function()
    {
        if($(this).hasClass('btn-light')) 
        {
            add_dislike();
        }
        else
        {
            un_dislike();
        }
    });
    
    
});

  

</script>
@stop