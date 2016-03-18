@extends('ncells::jumbotron.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">홈</a></li>
    <li><a href="/qs">Q&A</a></li>
    <li><a href="/qs/{{ $a->question->id }}#{{ $a->id }}">답변</a></li>
    <li class="active">답변 수정하기</li>
</ol>

<h2>답변 수정하기</h2>

<form method="post" action="/as/{{ $a->id }}/edit">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="content">내용</label>
        <textarea class="form-control" id="content" name="content" placeholder="내용"
                  rows="20">{{ $a->content }}</textarea>
    </div>
    <button type="submit" class="btn btn-default">저장</button>
</form>

@endsection