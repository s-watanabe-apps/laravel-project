@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-blog"></i>&nbsp;
        {{sprintf(__('strings.articles_index_title'), $articles_user['name'])}}
    </div>



    </div>
</div>

@endsection