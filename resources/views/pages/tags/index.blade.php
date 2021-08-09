@extends('common.layout')

@section('title', 'Tags' )

@php
/**
 * @var \App\Models\Tag[]|\Illuminate\Database\Eloquent\Collection $allTags
 */
@endphp

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/author-blog-businesswoman-267569.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-8">
                    <div class="single-blog-title text-center">
                        <h3>메타블로그에서 관리하고 있는 태그의 리스트 입니다</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <section class="contact-area section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Contact Form Area -->
                <div class="col-12 col-md-12 col-lg-12 ubuntu-fonts">

                    <h4>Managed Tags</h4>

                    @foreach($managedTags as $primaryTag => $tags)

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">
                            <a href="{{ route('posts.search',[$primaryTag]) }}" class="btn btn-sm btn-outline-primary">{{ $primaryTag }}</a>
                        </label>
                        <div class="col-md-10">

                            @foreach($tags as $tag)
                            <a href="{{ route('posts.search',[$tag]) }}" class="btn btn-sm btn-outline-dark">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                    <h4>All Tags</h4>
                    <div class="row">
                        <p>
                        @foreach($allTags as $tag)
                            @if($tag->name)
                                <a href="{{ route('posts.search',[$tag->name]) }}" class="btn btn-sm btn-outline-dark">{{ $tag->name }}</a>
                            @endif
                        @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
