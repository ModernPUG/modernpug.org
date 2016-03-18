@extends('ncells::jumbotron.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div>
            @include('ncells::member.parts.member_tab', ['member_id' => $member_id, 'tabitem_key' => 'qna'])
            <div class="tab-content">
                <br/>
                <div role="tabpanel" class="tab-pane active">
                    <h4>점수:</h4>
                    <ul>
                        <li>질문 점수: {{ $grade_qs }}</li>
                        <li>답변 점수: {{ $grade_as }}</li>
                        <li>댓글 점수: {{ $grade_cs }}</li>
                    </ul>

                    <article class="page-qna index">
                        <h4>질문:</h4>
                        @include('mpug::qna.parts.list', ['qs' => $qs])
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
