@extends('main')

@section('title',' Tag')


@section('style')
<link rel="stylesheet" href="/calendar/css/calendar.css">
<style>
     .display-4
    {
        font-size:2.5rem
    }
    .pagination
    {
        justify-content:center
    }
    .pignose-calendar .pignose-calendar-unit
    {
        height:2.8em
    }
    .pignose-calendar
    {
        width:100%;
    }
    .pignose-calendar .pignose-calendar-header{
        font-weight:150;
    }
    .pignose-calendar {
       font-size:92%;
       margin:unset;
    }
    .card{
        border: 1px solid #d8d8d8;
        box-shadow: 0 3px 8px rgba(0,0,0,.25);
    }
    a.anchor-post-title{
        color:#000;
    }
    .anchor-post-title:hover{
        text-decoration:none;
    }
    /* change tooltip background color */
    .tooltip-inner {
        opacity:.9;
    }
</style>
@endsection

@section('content')

@isset($posts)
<div class="row">
    <div class="col-md-8">
        @foreach($posts as $post)
        <div class="card mb-4 p-1 pb-3">
            <div class="card-body">
                <a href="{{ route('blog.single',$post->slug) }}" class="anchor-post-title"> 
                    <h2 class="display-4">
                        {{ substr($post->title ,0,60)}}{{ strlen($post->title)>=60 ? '...' : ''  }}
                    </h2>
                </a>
                <div class="mb-2">
                    <small class="text-secondary">
                    Posted By: {{ $post->user->name ?? 'UnKnown' }}
                    </small>
                    <span> | </span>
                    <small class="text-secondary">
                    {{ date("j M Y ",strtotime($post->created_at))}} 
                    </small> 
                    <span> | </span>
                    <small class="text-secondary">
                    Posted In: {{$post->category->name}}
                    </small>
                </div>
            </div>
            @isset($post->img)
                <div class="card-body py-0">
                    <img src="{{ asset('img/'.$post->img) }}" alt="" class="card-img-top">
                </div>
            @endisset
            <div class="card-body py-0">
                <p class="card-text">
                    <p class="lead text-break">
                        {!! substr($post->body,0,150) !!} {!! (strlen($post->body)>=150)?'...':'' !!}
                    </p>
                    @foreach($post->tags as $tag)
                    <a href="{{route('get_by_tag',$tag->name)}}">
                            <span class="badge badge-secondary">{{$tag->name}}</span>
                        </a>
                    @endforeach
                </p>
                <a href="{{ route('blog.single',$post->slug) }}" 
                    class="btn btn-secondary float-right mt-2">
                    Read More >>
                </a>
            </div>
        </div>

        @endforeach
    </div>

    <div class="col-md-4">
        <div class="mb-4">
            <form method="GET"
                    action="{{route('get_search_res')}}"
                    class="form-inline my-2 my-lg-0 justify-content-center">
                <input class="form-control mr-sm-2" 
                        type="search"
                        name="search_word" 
                        placeholder="Search"
                        aria-label="Search"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Are you looking for Something ? Let's find it &#x1F52D;">
                <button class="btn btn-outline-success my-2 my-sm-0" 
                        type="submit">
                        Search
                </button>
            </form>
        </div>
        <div class="calendar mb-4">
        </div>

        <div class="card mb-4">
            <div class="card-header text-center">
                Popular Posts
            </div>
            <div> 
                <ul class="list-group list-group-flush">
                    @foreach($new_articles as $new_article)
                    <li class="list-group-item">
                        <a href="{{route('blog.single',$new_article->slug)}}">
                        >> {!! substr($new_article->title,0,30) !!} {!! (strlen($new_article->title)>=30)?'...':'' !!}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-center">
                New Articles
            </div>
            <div> 
                <ul class="list-group list-group-flush">
                    @foreach($new_articles as $new_article)
                    <li class="list-group-item">
                        <a href="{{route('blog.single',$new_article->slug)}}">
                        >> {!! substr($new_article->title,0,30) !!} {!! (strlen($new_article->title)>=30)?'...':'' !!}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@else
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-warning">
                <p class="display-1">
                    No Results Found !!
                    <span style='font-size:100px;'>&#128566;</span>
                </p>
            </div>
        </div>
    </div>
@endisset
<div class="row">
    <a href="{{url()->previous()}}" class="btn btn-danger mb-4"><< Back</a>
</div>
@endsection


@section('script')

<script src="/calendar/js/calendar.js"></script>
<script>
$('.calendar').pignoseCalendar();

$('[data-toggle="tooltip"]').mouseenter(function(){
    var that = $(this)
    that.tooltip('show');
    setTimeout(function(){
        that.tooltip('hide');
    }, 2000);
});

$('[data-toggle="tooltip"]').mouseleave(function(){
    $(this).tooltip('hide');
});
/*
$('[data-toggle="tooltip"]').tooltip({
    animation: true,
    trigger : 'hover'
}); */
</script>
@endsection