@extends($layout)

@php      
    $random_related = (isset($random_related))?$random_related:random_related($niche,10,'keyword, slug');
    $related        = collect($random_related);
    $sentences      = collect($sentences);
    $images         = collect($images);    
    $image          = $images->shuffle()->shift();
    $max_image      = MAX_IMAGE_RESULT;
    $ads_link       = ADS_LINK;
    $cover_img      = cdn_image($image['url']);
@endphp

@section('title')
{{ imake_stringcase("ucwords", $keyword) }} at {{ imake_stringcase("ucwords", $niche) }}
@endsection

@section('head')
@include('json_id')
<link rel="preconnect" href="https://i2.wp.com">
<link rel="dns-prefetch" href="https://i2.wp.com">
<link rel="preconnect" href="https://i.pinimg.com">
<link rel="dns-prefetch" href="https://i.pinimg.com">
<link rel="preload" href="{{ $cover_img }}" as="image" media="(max-width: 420px)">
<link rel="preload" href="{{ $cover_img }}" as="image" media="(min-width: 420.1px)" >
@endsection

@section('content')
<article>
    <p><strong>{{ imake_stringcase("ucwords", $keyword) }}</strong>. {{ $sentences->shuffle()->take(2)->implode(' ') }}</p>
    @if($image)
    <figure>
        <img class="v-cover ads-img" src="{{ $cover_img }}" alt="{{ $image['title'] }}" width="640" height="360" />
        <br>
        <figcaption>{{ $image['title'] }} from {{ $image['domain'] }}</figcaption>
    </figure>
    @endif
    <p>
        {{ $sentences->shuffle()->take(3)->implode(' ') }}
    </p>
    <h3>{{ $image['title'] }}</h3>
    <p>{{ $sentences->shuffle()->pop() }} {{ $sentences->shuffle()->take(3)->implode(' ') }}</p>
</article>

<section>
@foreach($images->shuffle()->take($max_image) as $n =>  $image)
@php
    $mobile_img     = cdn_image($image['url']);

    $sentences_p    = $sentences->shuffle()->take(5)->implode(' ');
    $sentences_txt  = word_limiter($sentences_p, 60,'.');
@endphp

    <aside>
        <img class="v-image ads-img lazyload" alt="{{ $image['title'] }}" data-src="{{ $mobile_img }}" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" width="640" height="360" />
        <small>Source: {{ $image['domain'] }}</small>
            @if(strpos($ads_link, '//') !== false)
            <center>
                <button class="btn btn-sm btn-success ads-img">Check Details</button>
            </center>
            @endif
        <p align="justify">{{ $sentences_txt }}</p>
    </aside>
@endforeach
</section>

<section>
    <article>
        <p>
        @foreach($related->shuffle()->take(10) as $i => $info)
            @php
                $slug     = $info['slug'];
                $kw       = $info['keyword'];
                $post_url = imake_url($niche,$slug);
            @endphp  
            @if($kw !== $keyword)    
      
                <a href="{{ $post_url }}"><i>{{ $kw }}</i></a>
                @if(!$loop->last) - @endif 
            @endif
        @endforeach
        </p>
    </article>
</section>
@endsection