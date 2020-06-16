@extends('main')

@section('title',' Comments')

@section('style')
<style></style>
@endsection

@section('content')


    @if(session('success_spam'))
            <div class="alert alert-success">{{session('success_spam')}}</div>
    @endif
    <div class="display-4 mb-4">Comments Management</div>

@isset($comments)
   <table class="table table-striped table-hover table-bordered text-center">
    <thead>
        <th>#</th>
        <th>Comment body</th>
        <th>Commented by</th>
        <th>Commented on</th>
        <th>Commented at</th>
        <th>Actions</th> 
    </thead>
    <tbody>
    @foreach($comments as $comment)
        <tr>
            <td>{{ $comment->id }}</td>
            <td class="text-left">
            {{ substr(utf8_decode($comment->comment) ,0,50)}}{{ strlen(utf8_decode($comment->comment))>=50 ? '...' : ''  }}
            </td>
            <td>{{ $comment->user->name }}</td>
            <td>
                <a href="{{ route('show_comment',['slug'=>$comment->post->slug,'comment_id'=>$comment->id]) }}">
                {{ substr($comment->post->title ,0,20)}}{{ strlen($comment->post->title)>=20 ? '...' : ''  }}
                </a>
            </td>
            <td>{{date('j M Y | H:i a',strtotime($comment->created_at)) }}</td>
            <td>

                <form action="{{route('admin_delete_comment',$comment->id)}}" 
                      method="POST" class="float-left ml-2">
                 @csrf
                 @method('DELETE')
                 <input type="submit" class="btn btn-danger btn-sm" value="spam">
                </form>
            </td>
        </tr>
    @endforeach

    </tbody>
   </table>
@else 
    <div class="alert alert-warining">There are no Comments</div>
@endisset

@endsection

@section('script')
<script>

</script>
@endsection