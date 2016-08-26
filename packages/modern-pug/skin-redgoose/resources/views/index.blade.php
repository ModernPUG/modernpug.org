@extends('ncells::app')

@section('content')
<article class="page-main">
	<div class="spot">
		<div class="body">
			<h1>ModernPUG</h1>
			<p>ModernPUG 는 Modern Php User Group 을 의미하며<br/>
				현대적인 PHP 개발 방식에 관심을 갖고 발전시켜 나가는 사람들을 위한 커뮤니티 입니다.</p>
		</div>
	</div>

	<div class="links row">
		<a href="/wiki" class="col-sm-6">
			<dl>
				<dt><span class="icon"><i class="lnr lnr-book"></i></span></dt>
				<dd>
					<h2>PugWiki</h2>
					<p>각종 PHP 읽을거리를 작성해둔 곳.</p>
				</dd>
			</dl>
		</a>
		<a href="https://wiki.modernpug.org/" class="col-sm-6">
			<dl>
				<dt><span class="icon"><i class="lnr lnr-question-circle"></i></span></dt>
				<dd>
					<h2>Q&A</h2>
					<p>웹 개발에 관련된 다양한 문제에 대하여 질문하세요.</p>
				</dd>
			</dl>
		</a>
		<a href="http://allblog.modernpug.org" target="_blank" class="col-sm-6">
			<dl>
				<dt><span class="icon"><i class="lnr lnr-leaf"></i></span></dt>
				<dd>
					<h2>Allblog</h2>
					<p>한국 PHP 블로거들의 포스트를 모아보는 곳.</p>
				</dd>
			</dl>
		</a>
		<a href="/qs" class="col-sm-6">
			<dl>
				<dt><span class="icon"><i class="lnr lnr-question-circle"></i></span></dt>
				<dd>
					<h2>Old Q&A</h2>
					<p>예전 질문/답변 게시판입니다. 새로운 Q&A를 사용해보세요.</p>
				</dd>
			</dl>
		</a>
		<a href="https://www.facebook.com/groups/655071604594451/" target="_blank" class="col-sm-6">
			<dl>
				<dt><span class="icon"><i class="lnr lnr-users"></i></span></dt>
				<dd>
					<h2>ModernPUG Facebook group</h2>
					<p>Modern Php User Group 입니다.</p>
				</dd>
			</dl>
		</a>
		<a href="http://slack-invite.modernpug.org/" target="_blank" class="col-sm-6">
			<dl>
				<dt><span class="icon"><i class="lnr lnr-bubble"></i></span></dt>
				<dd>
					<h2>Invite slack</h2>
					<p>ModernPUG 회원을 위한 채팅공간 입니다.</p>
				</dd>
			</dl>
		</a>
	</div>
</article>
@endsection
