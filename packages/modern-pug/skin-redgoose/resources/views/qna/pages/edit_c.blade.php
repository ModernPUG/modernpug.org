@extends('ncells::app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">홈</a></li>
    <li><a href="/qs">Q&A</a></li>
    <li><a href="/qs/{{ $c->url }}">코멘트</a></li>
    <li class="active">코멘트 수정하기</li>
</ol>

<h2>코멘트 수정하기</h2>

<form method="post" action="/comments/{{ $c->id }}/edit">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="content">내용</label>
        <input type="text" class="form-control" id="content" name="content" placeholder="내용" value="{{ $c->content }}">
    </div>
    <button type="submit" class="btn btn-default">저장</button>
</form>
@endsection
