@php
    /**
     * @var \App\Models\Recruit $recruit
     */
@endphp
<div class="col-12">
    <div class="group">
        <input type="text" name="company_name" id="company_name"
               value="{{ old('company_name',$recruit->company_name) }}"
               placeholder="(주) 모던퍼그"
               required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>채용하는 회사의 이름을 입력해주세요</label>

        @if ($errors->has('company_name'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('company_name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <input type="text" name="address" id="address" value="{{ old('address',$recruit->address) }}" required
               placeholder="서울시 마포구" >
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>근무하게 될 위치를 입력해주세요</label>

        @if ($errors->has('address'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('address') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <input type="text" name="title" id="title" value="{{ old('title',$recruit->title) }}"
               placeholder="PHP 개발자를 찾습니다"
               required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>채용공고명을 입력해주세요</label>

        @if ($errors->has('title'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('title') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <input type="text" name="expired_at" id="expired_at"
               value="{{ old('expired_at',optional($recruit->expired_at)->format('Y-m-d')) }}"
               placeholder="YYYY-MM-DD"
               required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>채용 종료일을 입력해주세요</label>

        @if ($errors->has('expired_at'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('expired_at') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-6">
    <div class="group">
        <input type="number" name="min_salary" id="min_salary"
               value="{{ old('min_salary',$recruit->min_salary) }}"
               placeholder="3000"
               required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>최소 연봉을 만원단위로 입력해주세요</label>

        @if ($errors->has('min_salary'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('min_salary') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-6">
    <div class="group">
        <input type="number" name="max_salary" id="max_salary"
               value="{{ old('max_salary',$recruit->max_salary) }}"
               placeholder="10000"
               required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>최대 연봉을 만원단위로 입력해주세요</label>

        @if ($errors->has('max_salary'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('max_salary') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <input type="url" name="link" id="link" value="{{ old('link',$recruit->link) }}" required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>채용공고가 연결될 url을 입력해주세요</label>

        @if ($errors->has('link'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('link') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <input type="url" name="image_url" id="image_url" value="{{ old('image_url',$recruit->image_url) }}">
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>
            채용공고에 쓰일 배경이미지의 URL을 입력해주세요.
            345x200px 사이즈를 권장합니다.
            입력하지 않을 경우 기본 이미지가 노출됩니다
        </label>

        @if ($errors->has('image_url'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('image_url') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <input type="text" name="skills" id="skills" value="{{ old('skills',$recruit->skills) }}"
               placeholder="PHP, Laravel, Composer, Vuejs, Devops, Docker, K8S 등을 콤마로 구분하여 입력해주세요"
               required>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>우대하는 기술에 대해서 작성해주세요</label>

        @if ($errors->has('skills'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('skills') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
<div class="col-12">
    <div class="group">
        <textarea name="description" id="description"
                  placeholder="ex)성장하는 스타트업에서 기술리딩을 해주실 분을 구합니다. 자율출퇴근 가능"
                  required>{{ old('description',$recruit->description) }}</textarea>
        <span class="highlight"></span>
        <span class="bar"></span>
        <label>채용 포지션에 대해 간단히 설명해주세요</label>

        @if ($errors->has('description'))
            <div class="text-danger mb-5 small" role="alert">
                @foreach($errors->get('description') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>
</div>
