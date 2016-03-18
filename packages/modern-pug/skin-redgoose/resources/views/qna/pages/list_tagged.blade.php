@extends('ncells::jumbotron.app')

@section('content')
<article class="page-qna index">
    <header class="page-headding">
        <h1>Tag result '{{ $tag->name }}'</h1>
    </header>
    <dl class="tabs">
        <dt>
            <nav>
                <a href="#">Newstest</a>
                <a href="#">Tags</a>
            </nav>
        </dt>
        @if(Auth::check())
        <dd>
            <nav>
                <a href="/qs/write">Write</a>
            </nav>
        </dd>
        @endif
    </dl>

    @include('ncells::qna.parts.list', ['qs' => $qs])
</article>
@endsection
