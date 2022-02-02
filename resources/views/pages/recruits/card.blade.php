@php
    /**
     * @var \App\Models\Recruit $recruit
     */
@endphp

<!-- Single Blog Post -->
<div class="single-blog-post recruit">
    <!-- Post Thumbnail -->
    <div class="post-thumbnail">
        <img src="{{ $recruit->image_url??"/img/adult-article-assortment-1496183.jpg" }}" alt="{{ $recruit->title }}">
        <!-- category -->
        <div class="label">
            @if($recruit->expired_at=='9999-12-31 23:59:59')
                상시 채용
            @else
                {{ $recruit->expired_at->format('Y-m-d 마감') }}
            @endif
        </div>
    </div>
    <!-- Post Content -->
    <div class="post-content">
        <h5>
            {{ $recruit->title }}
            -
            {{ $recruit->company_name }}
        </h5>
        @if($recruit->address)
            <address>
                {{ $recruit->address }}
            </address>
        @endif
        @if($recruit->min_salary && $recruit->max_salary)
            <p>
                {{ number_format($recruit->min_salary) }}~{{ number_format($recruit->max_salary) }}만원
            </p>
        @endif

        <p style="max-height:200px;overflow-y: scroll">
            {!! nl2br(e($recruit->description)) !!}
        </p>

        <div class="tags">
            @foreach(explode(',',$recruit->skills) as $skill)
                <div class="btn btn-xs btn-outline-secondary">
                    {{ $skill }}
                </div>
            @endforeach
        </div>


        <div class="text-right mt-4 mb-4">

            @if($recruit->id)
                <a href="{{ $recruit->link }}" class="btn btn-outline-primary w-100 btn-sm" target="_blank">
                    <i class="fa fa-external-link"></i>
                    지원하기
                </a>
                @can('update', $recruit)
                    <a href="{{ route('recruits.edit',[$recruit->id])}}" target="_blank"
                       class="btn btn-sm btn-success">
                        수정
                    </a>
                @endcan
                @can('delete', $recruit)
                    <form class="d-inline-block"
                          action="{{ route('recruits.destroy', [$recruit->id] ) }}"
                          method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" class="btn btn-danger btn-sm" value="삭제">
                    </form>
                @endcan
            @else
                <a href="{{ $recruit->link }}" class="btn btn-outline-info w-100 btn-sm" target="_blank">
                    <i class="fa fa-external-link"></i>
                    지원하고 취업 축하금 받기
                </a>
            @endif
        </div>
        @if($recruit->entry_user)
            <div class="text-right">
                <small class="text-secondary">
                    {{ $recruit->entry_user->name }} 님이 등록하였습니다
                </small>
            </div>
        @endif
    </div>
</div>
