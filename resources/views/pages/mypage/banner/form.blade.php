@extends('common.layout')

@section('title', '배너 관리' )

@php
    /**
     * @var \App\Models\Banner $banner
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
                            <h4>Banner</h4>
                            @if($banner->id)
                                <form method="POST" action="{{ route('mypage.banners.update', [$banner]) }}"
                                      enctype="multipart/form-data">
                                    @method('put')
                                    @else
                                        <form method="POST" action="{{ route('mypage.banners.store') }}"
                                              enctype="multipart/form-data">
                                            @endif
                                            @csrf


                                            <div class="form-group row">
                                                <label for="position" class="col-md-4 col-form-label text-md-right">게시
                                                    위치</label>
                                                <div class="col-md-6">

                                                    <select name="position" id="position" class="form-control">
                                                        @foreach(\App\Models\Banner::POSITIONS as $positionKey => $positionName)
                                                            <option
                                                                value="{{ $positionKey }}" {{ $positionKey===$banner->position?"selected":"" }}>{{ $positionName }}</option>
                                                        @endforeach
                                                    </select>

                                                    @if($errors->has('position'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('position') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="title"
                                                       class="col-md-4 col-form-label text-md-right">제목</label>
                                                <div class="col-md-6">
                                                    <input id="title" type="text"
                                                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                           name="title" value="{{ old('title', $banner->title) }}"
                                                           required autofocus>

                                                    @if($errors->has('title'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="url"
                                                       class="col-md-4 col-form-label text-md-right">링크</label>
                                                <div class="col-md-6">
                                                    <input id="url" type="url"
                                                           class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                                                           name="url" value="{{ old('url', $banner->url) }}" required>

                                                    @if($errors->has('url'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="started_at" class="col-md-4 col-form-label text-md-right">게시
                                                    시작일</label>
                                                <div class="col-md-6">
                                                    <input id="started_at" type="date"
                                                           class="form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                                           name="started_at"
                                                           value="{{ old('started_at', $banner->started_at) }}"
                                                           required>

                                                    @if($errors->has('started_at'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('started_at') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="closed_at" class="col-md-4 col-form-label text-md-right">게시
                                                    종료일</label>
                                                <div class="col-md-6">
                                                    <input id="closed_at" type="date"
                                                           class="form-control{{ $errors->has('closed_at') ? ' is-invalid' : '' }}"
                                                           name="closed_at"
                                                           value="{{ old('closed_at', $banner->closed_at) }}" required>

                                                    @if($errors->has('closed_at'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('closed_at') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="image"
                                                       class="col-md-4 col-form-label text-md-right">이미지</label>
                                                <div class="col-md-6">

                                                    @foreach($banner->images as $image)
                                                        <div>
                                                            <img src="{{ asset($image->file_path) }}">
                                                            <div data-id="{{ $image->id }}"
                                                                 data-url="{{ route('mypage.banners.images.destroy', [$banner, $image]) }}"
                                                                 class="btn btn-xs btn-danger delete-image">삭제
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <input type="file" name="image" {{ $banner->images?"":"required" }}
                                                    class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                                    @if($errors->has('image'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('image') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            @if($banner->id)

                                                <div class="form-group row">
                                                    <label for="closed_at"
                                                           class="col-md-4 col-form-label text-md-right">승인
                                                        상태</label>
                                                    <div class="col-md-6">
                                                        @if($banner->approved_at)
                                                            {{ $banner->approved_at }}
                                                            {{ $banner->approve_user->name }} 승인
                                                        @else
                                                            대기
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif


                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Update
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


@push('js')
    <script>
        $('.delete-image').on('click', function () {
            let url = $(this).data('url');
            let $div = $(this).parent();

            $.ajax({
                url: url,
                type: 'delete',
                dataType: 'json'
            }).done(function (status) {
                $div.remove();
            });
        });
    </script>
@endpush
