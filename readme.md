# modernpug.org

[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com)
![GitHub issues](https://img.shields.io/github/issues/ModernPug/modernpug.org.svg)
![GitHub](https://img.shields.io/github/license/ModernPug/modernpug.org.svg)
[![CircleCI](https://circleci.com/gh/ModernPUG/modernpug.org/tree/v2.svg?style=svg)](https://circleci.com/gh/ModernPUG/modernpug.org/tree/v2)
[![StyleCI](https://styleci.io/repos/54202989/shield)](https://styleci.io/repos/54202989)
[![codecov](https://codecov.io/gh/ModernPUG/modernpug.org/branch/v2/graph/badge.svg)](https://codecov.io/gh/ModernPUG/modernpug.org)

[https://modernpug.org](https://modernpug.org)의 소스코드를 관리하기 위한 프로젝트입니다


## 설치방법
- `git clone https://github.com/ModernPUG/modernpug.org.git`
- `chmod 777 bootstrap/cache`
- `chmod -R 777 storage`
- `composer install --no-scripts`
- `cp .env.example .env` 후 `.env` 내용 수정
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`

## scss to css
- `npm ci`
- `npm run watch` or `npm run prod`



## 코드 컨셉
- [PSR](https://www.php-fig.org/psr/)을 충실히 따른다
- CSS와 JS는 모두 resources에 작성한 후 컴파일 하여 사용한다
- IDE에서 자동완성이 될 수 있도록 충분한 타입힌팅(or phpdoc)을 작성한다
  - IDE마다 지원하는 기능이 미묘하게 달라서 다르게 표현해야 하는 경우 PHPStorm이 기준이 된다 

## 아키텍쳐 컨셉

### Console 과 HttpController
- 각각 console과 웹을 통한 사용자의 요청을 담당한다
- 각각 사용자의 값을 정제하여 서비스 로직을 호출한다
- 직접적으로 서비스 로직을 가지지 않는다

### Http Request
- 사용자의 입력값에 대한 서버단계의 1차 검증을 한다

### Middleware
- 라우트 레벨에서 여러 컨트롤러에 일관적으로 검증되어야 하는 로직을 추가한다

### Model
- 가장 기본이 되는 객체로써의 존재
- 도메인 객체간의 관계를 정리한다
- 해당 객체가 가져야 하는 역할 및 속성을 같이 정리한다
- 모델은 생각보다 무거운 존재가 된다

### Services
- 현재 시스템이 사용자에게 제공하는 모든 로직을 담당한다
- 로우레벨 로직을 지양한다
- 데이터에 관련되는 로직은 모두 모델에서 처리한다

### View와 Assets
- 벤더가 제공하는 모든 view와 assets은 직접 수정하지 않고 별도의 파일을 만들어서 오버라이딩해서 사용한다

### Database Migration
- 마이그레이션은 항상 migrate와 rollback 정상적으로 수행될 수 있도록 하는 모든 로직이 들어있어야한다
- 마이그레이션이 될 때 기존의 저장된 데이터가 컨버팅 되어야 할 경우 해당 마이그레이션 파일에 같이 작성한다
- 데이터 시딩은 시스템이 정상적으로 수행되기 위해 필요한 모든 기초값을 포함한다
- 로컬 개발 및 테스팅을 위해서 필요한 mock 데이터는 factories에 작성하고 별도로 개발자가 직접 실행을 통해 사용한다


### Exceptions
- 심포니에서 제공하는 기본 exception을 확장하여 사용한다

### 테스트 
- 라라벨에서 제공해주는 테스트 기능을 적극 사용한다
- Unit에서는 class에 대한 Unit 테스트를 수행한다
  - 서비스로직은 모두 유닛테스트를 작성한다
- Feature에서는 특정한 기능에 대한 통합테스트를 수행한다
  - 컨트롤러는 통합테스트만 작성한다
  
  
  
## URL 작성 규칙

- 라라벨에서 제공하는 restful 컨트롤러의 동작에 맞춘다
  - 이 과정에서 restful api의 규칙을 지킬 수 있다면 지킨다
  - 단 이 규칙에 과도하게 집착할 필요는 없다
- url에는 복수형 단어를 사용한다
- 표현가능한 단어가 복합 언어일 경우 하이픈(-)을 이용하여 구분한다
  - ex) ~~~.com/latest-posts
  

## 커밋 규칙
- 첫줄에는 해당 커밋이 어떠한 의미를 가지는 지 한줄로 요약하여 작성한다
  - ex) readme.md 내용 정리
  - ex) 오타수정
  - ex) Article 단어 복수형으로 변경 
  
- 첫줄만으로는 커밋의 내용을 전부 표현할 수 없을 경우 한줄의 공백줄 이후 3번째 줄부터 "-"을 이용하여 수정내역을 기입한다
  - ```
    readme.md 내용 정리
    
    - 커밋작성규칙 추가
    - contributor 안내 추가
    - 라이센스 표시추가
    ``` 
  
- 커밋은 유의미한 최소단위의 커밋으로 커밋한다.
  - feature 개발을 진행할 경우 해당 feature가 완료되는 시점까지의 과정을 유의미하게 분할 하여 커밋한다
  - ```
      - 모델 추가
      - 컨트롤러 추가
      - 라우터 추가
      - 뷰 추가
    ```
    
  - 위의 과정은 예시이며 유의미한 커밋(변경내역 자체가 의미가 있는 내용이며 각 커밋이 코드리뷰를 하기에 너무 크거나 작지 않은 크기) 라고 판단한다면 작업자의 판단에 의해 조정하면 됩니다
    - 피쳐 개발을 다 끝낸 이후 `xxx 피쳐 추가` 라고 커밋을 할 경우 리뷰자의 경우 확인해야 할 범위나 사이트 이펙트의 발생여부에 대해 고려사항이 많아지므로 그만큼 리뷰 시간이 오래걸리게 되고 해당 커밋은 적절한 시점에 merge 되지 않을 가능성이 높아집니다 
 
- fixed #123 같은 커밋을 통한 이슈트래커를 컨트롤 하는 커밋은 하지 않습니다. 

### 레퍼런스
- https://edykim.com/ko/post/writing-good-commit-messages/
- http://blog.naver.com/PostView.nhn?blogId=tmondev&logNo=220763012361
