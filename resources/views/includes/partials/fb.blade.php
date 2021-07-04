<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId            : '{{ config('boilerplate.fb_app_id') }}',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v9.0'
        });
    };
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
