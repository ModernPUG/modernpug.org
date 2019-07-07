@extends('common.layout')

@section('title', '사용자 관리' )

@php
    /**
     * @var App\User[]|Illuminate\Database\Eloquent\Collection|Illuminate\Contracts\Pagination\LengthAwarePaginator $users
     */
@endphp

@section('content')
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area height-300 bg-img background-overlay"
         style="padding-top:75px;background-image: url(/img/accounting-analytics-apple-572056.jpg);">

        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 ">
                    <div class="single-blog-title text-center">
                        <h3>User</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ********** Hero Area End ********** -->

    <section class="contact-area section-padding-50">
        <div class="container">
            <div class="row">


                <div class="col-12 col-lg-8">
                    <div class="title mb-30">
                        <h2>Users</h2>
                    </div>

                    <div class="row">
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>아바타</th>
                                <th>이름</th>
                                <th>email</th>
                                <th>블로그</th>
                                <th>Role</th>
                                <th>가입일</th>
                                <th>삭제일</th>
                                <th>삭제/복구</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($users as $user)
                                <tr class="{{ $user->deleted_at?'bg-danger':'' }}">

                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        @if($user->avatar_url)
                                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                                 style="max-width:30px;">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                        <i class="fa fa-check {{ $user->email_verified_at?"text-success":"text-danger" }}"
                                           aria-hidden="true"
                                           title="verified at {{ $user->email_verified_at->format('y-m-d H:i:s') }}"></i>
                                    </td>
                                    <td>
                                        {{ number_format($user->blogs->count()) }}
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            <div class="btn-group">
                                                <div class="btn btn-xs btn-info">
                                                    {{ $role->name }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('y-m-d') }}
                                    </td>
                                    <td>
                                        {{ $user->deleted_at?$user->deleted_at->format('y-m-d'):'' }}
                                    </td>
                                    <td>
                                        @if($user->deleted_at)
                                            <form class="d-inline-block"
                                                  action="{{ route('mypage.users.restore', [$user->id]) }}"
                                                  method="post">
                                                @csrf
                                                @method("PATCH")
                                                <input type="submit" class="btn btn-info btn-sm" value="복구">
                                            </form>
                                        @else
                                            <a href="{{ route('mypage.users.edit',[$user->id]) }}"
                                               class="btn btn-primary btn-sm">
                                                수정하기
                                            </a>
                                            <form class="d-inline-block"
                                                  action="{{ route('mypage.users.destroy', [$user->id] ) }}"
                                                  method="post">
                                                @csrf
                                                @method("DELETE")
                                                <input type="submit" class="btn btn-danger btn-sm" value="삭제">
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        사용자가 없습니다
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                            <tfoot>

                            <tr>
                                <td colspan="9" class="text-center">
                                    @if($users->count())
                                        {!! $users->appends(Request::except('page'))->render() !!}
                                    @endif
                                </td>
                            </tr>
                            </tfoot>
                        </table>


                    </div>


                </div>


                @include('pages.mypage.widget.lnb')


            </div>
        </div>
    </section>
@endsection
