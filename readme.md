# modernpug.org

## 설치방법
- `git clone https://github.com/ModernPUG/modernpug.org.git`
- `chmod 777 bootstrap/cache`
- `chmod -R 777 storage`
- `composer install --no-scripts`
- `.env.example` 을 참고하여 `.env` 작성 (db, github, log)
- `php artisan key:generate`
- `php artisan vendor:publish`
- `php artisan migrate`

## scss to css
- `npm ci`
- `npm run watch` or `npm run prod`



## 코드 컨셉
- PSR을 충실히 따른다
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
  - ex:) ~~~.com/latest-posts
  
