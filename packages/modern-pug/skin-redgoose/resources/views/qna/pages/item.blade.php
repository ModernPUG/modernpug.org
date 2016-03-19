@extends('ncells::app')

@section('content')
<div class="page-qna view">
	<!-- Question -->
	<section class="question">
		<header>
			<h1>{{ $q->title }}</h1>
			<div class="metas">
				<p><span>{{ $q->created_at->diffForHumans() }}</span></p>
				<p><span>{{ $q->viewCounts->count() }}명이 읽음</span></p>
			</div>
		</header>
		<div class="item">
			@include('ncells::qna.parts.vote', ['type' => 'question', 'id' => $q->id, 'count' => $q->votes->sum('grade')])
			<div class="body">{!! $q->md_content !!}</div>
			@if (count($q->tags) > 0)
			<nav class="tags">
				{!! $q->tags_html !!}
			</nav>
			@endif
			<div class="profile">
				<div class="user">
					<dl>
						<dt><img src="{{ $q->writer->avatar }}"/></dt>
						<dd>
							@include('ncells::qna.parts.user_small', ['user' => $q->writer])<br/>
							<span>{{ $q->created_at->diffForHumans() }}</span>
						</dd>
					</dl>
				</div>
				@can('qna-edit', $q)
				<div class="control">
					<a href="#writeAnswer" class="rg-btn size-small color-key">WRITE ANSWER</a>
					<a href="/qs/{{ $q->id }}/edit" class="rg-btn size-small">EDIT</a>
					<a href="#" data-href="/qs/{{ $q->id }}/delete" class="rg-btn size-small" data-action="delete">REMOVE</a>
				</div>
				@endcan
			</div>
			<article class="comments">
				<h1><span>Comments</span><em>{{ $q->comments->count() }}</em></h1>
				<div class="wrap">
					<ul class="index">
						@if (count($q->comments) > 0)
						@foreach($q->comments as $c)
						<li>
							<div class="meta">
								<span class="name">@include('ncells::qna.parts.user_small', ['user' => $c->writer])</span>
								<span>{{ $c->created_at->diffForHumans() }}</span>
								<span>@include('ncells::qna.parts.vote_c', ['type' => 'comment', 'id' => $c->id, 'count' => $c->votes->sum('grade')])</span>
								@can('qna-edit', $c)
								<span><a href="/comments/{{ $c->id }}/edit" class="button" data-action="editComment">EDIT</a></span>
								<span><a href="#" data-href="/comments/{{ $c->id }}/delete" class="button" data-action="deleteComment">REMOVE</a></span>
								@endcan
							</div>
							<div class="bd">{!! $c->md_content !!}</div>
							@can('qna-edit', $c)
							<form action="" class="edit-comment-form" style="display: none;">
								<div>
									<span class="area-input"><input type="text" name="asdasd" class="form-control" value="{!! $c->md_content !!}"></span>
									<span class="area-btn"><button type="submit" class="rg-btn color-key">Edit</button></span>
								</div>
							</form>
							@endcan
						</li>
						@endforeach
						@endif
					</ul>
					@can('qna-write')
					{!! (count($q->comments) > 0) ? '<hr/>' : '' !!}
					<form method="post" action="/comments/write">
						{{ csrf_field() }}
						<input type="hidden" name="commentable_id" value="{{ $q->id }}" />
						<input type="hidden" name="commentable_type" value="question" />
						<fieldset>
							<legend class="blind">write short comment</legend>
							<div>
								<span class="area-input">
									<input type="text" class="form-control" name="content" placeholder="write comment"/>
								</span>
								<span class="area-btn">
									<button type="submit" class="rg-btn color-key">Write comment</button>
								</span>
							</div>
						</fieldset>
					</form>
					@endcan
				</div>
			</article>
		</div>
	</section>
	<!-- // Question -->

	@if (count($q->answers) > 0)
	<!-- Answers -->
	<p class="bar">{{ $q->answers->count() }} Answers</p>
	<div class="answers">
		@foreach($q->answers as $a)
		<div class="answer" id="answer-{{ $a->id }}">
			<div class="item">
				<aside class="side-control">
					@include('ncells::qna.parts.vote', ['type' => 'answer', 'id' => $a->id, 'count' => $a->votes->sum('grade')])
				</aside>
				<div class="body">
					{!! $a->md_content !!}
				</div>
				<div class="profile">
					<div class="user">
						<dl>
							<dt><img src="{{ $a->writer->avatar }}"/></dt>
							<dd>
								<a href="#"><strong>{{ $a->writer->name }}</strong></a><br/>
								<span>{{ $a->created_at->diffForHumans() }}</span>
							</dd>
						</dl>
					</div>
					@can('qna-edit', $a)
					<div class="control">
						<a href="/as/{{ $a->id }}/edit" class="rg-btn size-small">EDIT</a>
						<a href="#" data-href="/as/{{ $a->id }}/delete" class="rg-btn size-small">REMOVE</a>
					</div>
					@endcan
				</div>
				<article class="comments">
					<h1><span>Comments</span><em>{{ $a->comments->count() }}</em></h1>
					<div class="wrap">
						<ul class="index">
							@if (count($a->comments) > 0)
							@foreach($a->comments as $c)
							<li>
								<div class="meta">
									<span class="name">@include('ncells::qna.parts.user_small', ['user' => $c->writer])</span>
									<span>{{ $c->created_at->diffForHumans() }}</span>
									<span>@include('ncells::qna.parts.vote_c', ['type' => 'comment', 'id' => $c->id, 'count' => $c->votes->sum('grade')])</span>
									@can('qna-edit', $c)
									<span><a href="/comments/{{ $c->id }}/edit" class="button" data-action="editComment">EDIT</a></span>
									<span><a href="#" data-href="/comments/{{ $c->id }}/delete" class="button" data-action="deleteComment">REMOVE</a></span>
									@endcan
								</div>
								<div class="bd">{!! $c->md_content !!}</div>
							</li>
							@endforeach
							@endif
						</ul>

						@can('qna-write')
						{!! (count($a->comments) > 0) ? '<hr/>' : '' !!}
						<form method="post" action="/comments/write">
							{{ csrf_field() }}
							<input type="hidden" name="commentable_id" value="{{ $a->id }}" />
							<input type="hidden" name="commentable_type" value="answer" />
							<fieldset>
								<legend class="blind">write short comment</legend>
								<div>
								<span class="area-input">
									<input type="text" class="form-control" name="content" placeholder="write comment"/>
								</span>
								<span class="area-btn">
									<button type="submit" class="rg-btn color-key">Write comment</button>
								</span>
								</div>
							</fieldset>
						</form>
						@endcan
					</div>
				</article>
			</div>
		</div>
		@endforeach
	</div>
	<!-- // Answers -->
	@endif

	<!-- Write answer -->
	@can('qna-write')
	<div class="write-answer-wrap">
		<p class="bar">Write answers</p>
		<form method="POST" action="/as/write" class="write-answer" id="writeAnswer">
			{{ csrf_field() }}
			<input type="hidden" name="q_id" value="{{ $q->id }}" />
			<fieldset>
				<legend class="blind">Write answer</legend>
				<textarea class="form-control" name="content" placeholder="답변 작성하기" rows="4"></textarea>
			</fieldset>
			<nav>
				<button type="submit" class="rg-btn color-key">Write answer</button>
			</nav>
		</form>
	</div>
	@endcan
	<!-- // Write answer -->
</div>
@endsection

@section('script')
@parent
<script>
$(function () {
	$('[data-action=voteUp]').click(function () {
		var votable_id = $(this).data('id'),
			votable_type = $(this).data('type');
		vote(votable_id, votable_type, 'up');
		return false;
	});

	$('[data-action=voteDown]').click(function () {
		var votable_id = $(this).data('id'),
			votable_type = $(this).data('type');
		vote(votable_id, votable_type, 'down');
		return false;
	});

	// like comment
	$('[data-action=likeCommentUp]').on('click', function(){
		var $this = $(this);
		if ($this.hasClass('disabled')) return false;
		vote($(this).data('id'), $(this).data('type'), 'up', function(data){
			$this.addClass('disabled');
			$this.children('em').text(data.count);
		});
		return false;
	});

	// pick answer
	$('[data-action=pickAnswer]').on('click', function(){
		var $this = $(this);
		$this.toggleClass('active');
	});

	// edit comment
	$('[data-action=editComment]').on('click', function(){
		var $li = $(this).closest('li');
		$(this).toggleClass('off');
		$li.find('form').toggle();
		return false;
	});

	// delete comment
	$('[data-action=deleteComment]').click(function () {
		if (!confirm('삭제하시겠습니까?')) return false;

		var href = $(this).data('href');

		$.ajax({
			url: href,
			type: "POST",
			data: {_method: 'DELETE'},
			success: function (data, textStatus, jqXHR) {
				var redirect = data.redirect;
				if (redirect.indexOf('#') == -1) {
					window.location.href = redirect;
				} else {
					var hash = redirect.split('#')[1];
					window.location.hash = hash;
					window.location.reload();
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {}
		});

		return false;
	});

	// vote
	function vote(votable_id, votable_type, grade, callback) {
		var formData = {
			votable_id: votable_id,
			votable_type: votable_type
		};

		$.ajax({
			url: "/vote/" + grade,
			type: "POST",
			data: formData,
			success: function (data, textStatus, jqXHR) {
				if (callback)
				{
					callback(data);
				}
				else
				{
					$('#label-' + votable_type + '-' + votable_id).text(data.count);
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	}
});
</script>
@endsection
