<ul class="items">
    @foreach($qs as $q)
		<div class="item">
			<a href="/qs/{{ $q->id }}" class="col count">
				<em>{{ $q->num_votes_with_pad }}</em>
				<span>votes</span>
			</a>
			<a href="/qs/{{ $q->id }}" class="col count">
				<em>{{ $q->answers->count() }}</em>
				<span>answers</span>
			</a>
			<div class="col body">
				<a href="/qs/{{ $q->id }}" class="title">{{ $q->title }}</a>
				<div class="bd">
					<div class="tags">
						{!! $q->tags_html !!}
					</div>
					<div class="metas">
						<p><strong>{{ $q->writer->name }}</strong></p>
						<p>{{ $q->created_at->diffForHumans() }}</p>
						<p>
							<span>조회수</span>
							<em>{{ $q->viewCounts->count() }}</em>
						</p>
					</div>
				</div>
			</div>
		</div>
    @endforeach

	@if (count($qs) == 0)
		<p class="empty">
			<i class="lnr lnr-cross"></i>
			<span>Not found article</span>
		</p>
	@endif
</ul>

<nav class="paginate">
	{!! $qs->links() !!}
</nav>