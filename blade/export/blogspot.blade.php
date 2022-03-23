@php
	$backdate 	= BACK_DATE;
	$schedule 	= SHEDULE_DATE;
	$wp_cat 	= $niche??WP_CATEGORY;
@endphp
{!! '<' . '?' . "xml version='1.0' encoding='UTF-8'?>" !!}
<ns0:feed xmlns:ns0="http://www.w3.org/2005/Atom">
<ns0:title type="html">wpan.com</ns0:title>
<ns0:generator>Blogger</ns0:generator>
<ns0:link href="http://localhost/wpan" rel="self" type="application/atom+xml" />
<ns0:link href="http://localhost/wpan" rel="alternate" type="text/html" />
<ns0:updated>2016-06-10T04:33:36Z</ns0:updated>
@foreach($sub_data as $key => $info)
	@php

		$data 				= json_decode($info['json_images'],TRUE);

		if(!is_array($data)){continue;}

		$images_count 		= count($data['images']);

		if($images_count < 1){continue;}	

		$sentences 			= json_decode($info['json_sentences'],TRUE);

		if(!is_array($sentences)){continue;}

		$sentences_count 	= count($sentences);

		if($sentences_count < 1){continue;}

		$data['sentences'] 	= $sentences;

		$keyword 			= $info['keyword'];	
		$title 				= imake_stringcase("ucwords", $keyword);
		$slug 				= slug_imake($keyword);

		$data['title'] 		= $title;
		$data['keyword'] 	= $keyword;

		$content 			= view('export.post',$data,TRUE);
		$content 			= Minify_Html($content);

		$date 				= date('Y-m-d\TH:i:s\Z', rand(strtotime($backdate), strtotime($schedule)));

		$arr_tags 			= explode('-',$slug);
		$arr_tags 			= array_unique($arr_tags);
	@endphp
	<ns0:entry>
		@foreach($arr_tags as $tag)
		@if(strlen($tag) <= 3)
			@continue
		@endif
		<ns0:category scheme="http://www.blogger.com/atom/ns#" term="{{ $tag }}" />
		@endforeach
		<ns0:category scheme="http://schemas.google.com/g/2005#kind" term="http://schemas.google.com/blogger/2008/kind#post" />
		<ns0:id>post-{{ $key }}</ns0:id>
		<ns0:author>
		<ns0:name>admin</ns0:name>
		</ns0:author>
		<ns0:content type="html"><![CDATA[{!! $content !!}]]></ns0:content>
		<ns0:published>{{$date}}</ns0:published>
		<ns0:title type="html"><![CDATA[{{ $title }}]]></ns0:title>
		<ns0:link href="http://localhost/wpan/{{$key}}/" rel="self" type="application/atom+xml" />
		<ns0:link href="http://localhost/wpan/{{$key}}/" rel="alternate" type="text/html" />
	</ns0:entry>
@endforeach
</ns0:feed>