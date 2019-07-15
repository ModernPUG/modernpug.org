@extends('common.layout')

@section('title', '프로필 수정' )

@php
    /**
     * @var \App\User $user
     */
@endphp
@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/author-blog-businesswoman-267569.jpg);">
        <div class="container" style="padding-top:50px;padding-bottom:50px;">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-body">
                            <h4>Update User Profile</h4>
                            <form method="POST" action="{{ route('mypage.profile.update') }}">
                                @method('put')
                                @csrf

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               name="name" value="{{ old('name', $user->name) }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="email" value="{{ $user->email }}" required readonly>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif


                                        @if(!$user->email_verified_at)
                                            <span class="text-danger" role="alert">
                                                아직 이메일을 인증받지 않았습니다.
                                                <a href="{{ route('verification.resend') }}" class="btn btn-warning btn-xs">
                                                    인증메일 전송
                                                </a>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">New {{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="github_url"
                                           class="col-md-4 col-form-label text-md-right">Github</label>

                                    <div class="col-md-6">
                                        <input id="github_url" type="url"
                                               class="form-control{{ $errors->has('github_url') ? ' is-invalid' : '' }}"
                                               value="{{ old('github_url',$user->github_url) }}"
                                               placeholder="url을 입력하세요"
                                               name="github_url">

                                        @if ($errors->has('github_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('github_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="facebook_url"
                                           class="col-md-4 col-form-label text-md-right">Facebook</label>

                                    <div class="col-md-6">
                                        <input id="facebook_url" type="url"
                                               class="form-control{{ $errors->has('facebook_url') ? ' is-invalid' : '' }}"
                                               value="{{ old('facebook_url',$user->facebook_url) }}"
                                               placeholder="url을 입력하세요"
                                               name="facebook_url">

                                        @if ($errors->has('facebook_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('facebook_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="twitter_url"
                                           class="col-md-4 col-form-label text-md-right">Twitter</label>

                                    <div class="col-md-6">
                                        <input id="twitter_url" type="url"
                                               class="form-control{{ $errors->has('twitter_url') ? ' is-invalid' : '' }}"
                                               value="{{ old('twitter_url',$user->twitter_url) }}"
                                               placeholder="url을 입력하세요"
                                               name="twitter_url">

                                        @if ($errors->has('twitter_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('twitter_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="homepage_url"
                                           class="col-md-4 col-form-label text-md-right">Homepage</label>

                                    <div class="col-md-6">
                                        <input id="homepage_url" type="url"
                                               class="form-control{{ $errors->has('homepage_url') ? ' is-invalid' : '' }}"
                                               value="{{ old('homepage_url',$user->homepage_url) }}"
                                               placeholder="url을 입력하세요"
                                               name="homepage_url">

                                        @if ($errors->has('homepage_url'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('homepage_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="comment"
                                           class="col-md-4 col-form-label text-md-right">자기소개</label>

                                    <div class="col-md-6">
                                        <textarea name="comment" id="comment"
                                                  class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                        >{{ old('comment', $user->comment) }}</textarea>
                                        @if ($errors->has('comment'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="col-md-6 offset-md-4">

                                    @foreach($user->oauth_identities as $oauthIdentity)

                                        <div class="btn btn-outline-secondary btn-block">
                                            <strong>
                                                <i class="fa fa-{{ $oauthIdentity->provider }} icon"></i> Connected with
                                                {{ ucfirst($oauthIdentity->provider) }}
                                            </strong>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
