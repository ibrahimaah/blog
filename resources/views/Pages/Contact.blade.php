@extends('main')

@section('title',' Contact')


@section('style')
<style></style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="display-4 mb-4 text-center">Contact Us</h2>
        <form action="">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" placeholder="Enter email" id="email">
            </div>
            <div class="form-group">
                <label for="pwd">Subject:</label>
                <input type="text" class="form-control" placeholder="Enter subject" id="subj">
            </div>
            <div class="form-group">
                <label for="txt-area">Message</label>
                <textarea class="form-control" id="txt-area" rows="3" placeholder="Enter Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    //confirm("Hello from Blade");
</script>
@endsection
