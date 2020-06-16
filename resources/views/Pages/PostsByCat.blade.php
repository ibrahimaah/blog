@extends('main')


@section('title', $category->name)


@section('style')
<style>
    .display-4
    {
        font-size:2.5rem
    }
    .pagination
    {
        justify-content:center
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
</style>
@endsection



@section('content')


<div class="row">
    <div class="col-md-12">
    @isset($posts)
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
    @endisset
    {{$posts}}
    </div>
</div>


@endsection

@section('script')

<script>


</script>
@endsection