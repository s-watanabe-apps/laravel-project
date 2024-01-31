<header>
    <div class="flex-contents">
        <div class="logo">
            <a href="/">{{$settings['site_name']}}</a>
        </div>
        <div id="hamburger">
            <div class="icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="sm">
            <ul>
                @foreach ($navigations as $nav)
                <li><a href="{{$nav['link']}}">{{$nav['name']}}</a></li>
                @endforeach
            </ul>
        </nav>
        <nav class="pc">
            <ul>
                @foreach ($navigations as $nav)
                <li><a href="{{$nav['link']}}">{{$nav['name']}}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
<script>
    $('#hamburger').on('click', function(){
        $('.icon').toggleClass('close');
        $('.sm').slideToggle();
    });
</script>