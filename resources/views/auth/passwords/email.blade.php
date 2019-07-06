@extends('common.layout')

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-80vh bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/author-blog-businesswoman-267569.jpg);">
        <!-- ********** Hero Area End ********** -->
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-body">
                                <h4>{{ __('Reset Password') }}</h4>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
@endsection
