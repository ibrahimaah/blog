
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<!--<script src="/js/fontawesome.js"></script>-->
<script src="/js/script.js"></script> 
<script>
$(function(){
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
});
</script>


<!-- For Sharing Links -->
<!--<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->
<script src="{{ asset('js/share.js') }}"></script>


@yield('script')