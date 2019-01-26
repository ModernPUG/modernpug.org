@extends('common.layout')

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-80vh bg-img background-overlay"
         style="background-image: url(/img/author-blog-businesswoman-267569.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-body">
                                <h4>{{ __('Verify Your Email Address') }}</h4>
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }}, <a
                                        href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
