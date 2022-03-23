@php
    $sentences      = collect($sentences);
    $images         = collect($images);
    $first          = $images->shuffle()->shift();
    $cover_img      = cdn_image($first['url']);
    $max_image      = MAX_IMAGE_RESULT;
@endphp
<article>
    <p><strong>{{ $title }}</strong>. {{ $sentences->shuffle()->take(2)->implode(' ') }}</p>
    @if($first)
    <figure>
        <noscript>
            <img src="{{ $cover_img }}" alt="{{ $first['title'] }}" width="640" height="360" />
        </noscript>
        <img class="v-cover ads-img" src="{{ $cover_img }}" alt="{{ $first['title'] }}" width="100%" style="margin-right: 8px;margin-bottom: 8px;" />
        <figcaption>{{ $first['title'] }} from {{ $first['domain'] }}</figcaption>
    </figure>
    @endif
    <p>{{ $sentences->shuffle()->take(3)->implode(' ') }}</p>
</article>
<!--more-->
<section>
@foreach($images->shuffle()->take($max_image) as $image)
    <aside>
        <img alt="{{ $image['title'] }}" src="{{ cdn_image($image['url']) }}" width="100%" style="margin-right: 8px;margin-bottom: 8px;" />
        <small>Source: <i>{{ $image['domain'] }}</i></small>
        <p>{{ $sentences->shuffle()->take(2)->implode(' ') }}</p>
    </aside>
@endforeach
</section>
<section>
@foreach($sentences->shuffle()->take(20)->chunk(4) as $chunked_sentences)
    @php
        $chunked_sentences  = collect($chunked_sentences);
        $chunked_h3         = $chunked_sentences->shift();
        $chunked_p          = $chunked_sentences->implode(' ');
    @endphp
    <h3>{{ imake_stringcase("ucfirst", $chunked_h3) }}</h3>
    <br/>
    <p>{{$chunked_p}}</p>
@endforeach
</section>
