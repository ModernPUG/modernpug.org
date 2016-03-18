<a href="#" data-id="{{ $id }}" data-type="{{ $type }}" aria-hidden="true" data-action="likeCommentUp" title="Like it">
	<i class="lnr lnr-thumbs-up"></i>
	<em id="{{ 'label-'.$type.'-'.$id }}" data-id="{{ $id }}" data-type="{{ $type }}">{{ $count }}</em>
</a>