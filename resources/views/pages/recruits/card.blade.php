@php
/**
 * @var \App\Recruit $recruit
 */
@endphp

<!-- Single Blog Post -->
<div class="single-blog-post recruit">
    <!-- Post Thumbnail -->
    <div class="post-thumbnail">
        <img src="{{ $recruit->image_url??"/img/adult-article-assortment-1496183.jpg" }}" alt="{{ $recruit->title }}">
        <!-- category -->
        <div class="label">
            {{ $recruit->expired_at->format('Y-m-d 마감') }}
        </div>
    </div>
    <!-- Post Content -->
    <div class="post-content">
        <h5>
            {{ $recruit->title }}
            -
            {{ $recruit->company_name }}
        </h5>
        <p>
            {{ $recruit->min_salary }}~{{ $recruit->max_salary }}만원
        </p>
        <p>
            {{ $recruit->description }}
        </p>
        <!-- Post Meta -->
        <address>
            {{ $recruit->address }}
        </address>

        <div class="tags">
            @foreach(explode(',',$recruit->skills) as $skill)
                <div class="btn btn-xs btn-outline-secondary">
                    {{ $skill }}
                </div>
            @endforeach
        </div>


        <div class="text-right">

            <a href="{{ $recruit->link }}" class="btn btn-primary btn-sm" target="_blank">
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
        </div>
    </div>
</div>
