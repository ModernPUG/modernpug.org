@extends('common.layout')

@section('title', 'Role 관리' )

@php
    /**
     * @var \App\Models\Role[]|Illuminate\Database\Eloquent\Collection $roles
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
                        <h3>Roles</h3>
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
                        <h2>Roles</h2>
                    </div>

                    <div class="row">


                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Users</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($roles as $role)
                                <tr>
                                    <td>
                                        {{ $role->name }}
                                    </td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <div class="btn btn-xs btn-outline-dark">
                                                {{ $permission->name }}
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($role->users as $user)
                                            <a href="{{ route('mypage.users.edit',[$user]) }}"
                                               class="btn btn-xs btn-outline-primary" target="_blank">
                                                {{ $user->name }}
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        검색 결과가 없습니다
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>

                        </table>

                    </div>
                </div>

                @include('pages.mypage.widget.lnb')


            </div>
        </div>
    </section>
@endsection
