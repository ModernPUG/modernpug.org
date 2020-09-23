@php
    /**
     * @var \App\Models\User[] $facilitators
     */
@endphp

<section class="contact-area section-padding-50">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form Area -->
            <div class="col-12 col-md-12 col-lg-12">
                <h4>Facilitators</h4>

                <div class="row">

                    @foreach($facilitators as $facilitator)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <!-- Single Blog Post -->
                            <div class="single-blog-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail" style="width:70%; margin:auto;padding:5px;">
                                    <img src="{{ $facilitator->avatar_url }}" alt="{{ $facilitator->name }}">
                                </div>
                                <!-- Post Content -->

                                <div class="post-content text-center">
                                    <h5>
                                        {{ $facilitator->name }}
                                    </h5>
                                    <div>
                                        @if($facilitator->github_url)
                                            <a class="text-primary" target="_blank"
                                               href="{{ $facilitator->github_url }}">
                                                <i class="fa fa-github"></i>
                                            </a>
                                        @endif
                                        @if($facilitator->facebook_url)
                                            <a class="text-primary" target="_blank"
                                               href="{{ $facilitator->facebook_url }}">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        @endif
                                        @if($facilitator->twitter_url)
                                            <a class="text-primary" target="_blank"
                                               href="{{ $facilitator->twitter_url }}">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        @endif
                                        @if($facilitator->homepage_url)
                                            <a class="text-primary" target="_blank"
                                               href="{{ $facilitator->homepage_url }}">
                                                <i class="fa fa-home"></i>
                                            </a>
                                        @endif
                                    </div>
                                    @if($facilitator->comment)
                                    <div>
                                        <i class="fa fa-commenting"></i>
                                        {{ $facilitator->comment }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</section>
