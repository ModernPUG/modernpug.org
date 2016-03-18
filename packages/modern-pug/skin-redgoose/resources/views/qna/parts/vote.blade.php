<aside class="side-control">
	<nav class="vote">
		<i data-id="{{ $id }}" data-type="{{ $type }}" aria-hidden="true" data-action="voteUp" class="lnr lnr-chevron-up" title="vote up"></i>
		<em id="{{ 'label-'.$type.'-'.$id }}" data-id="{{ $id }}" data-type="{{ $type }}">{{ $count }}</em>
		<i data-id="{{ $id }}" data-type="{{ $type }}" aria-hidden="true" data-action="voteDown" class="lnr lnr-chevron-down" title="vote down"></i>
	</nav>
	<nav class="pick">
		<i class="lnr lnr-checkmark-circle" data-action="pickAnswer" title="choice answer"></i>
	</nav>
</aside>
