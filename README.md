# modernpug.org

[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=flat-square)](http://makeapullrequest.com)
![GitHub issues](https://img.shields.io/github/issues/ModernPug/modernpug.org.svg)
![GitHub](https://img.shields.io/github/license/ModernPug/modernpug.org.svg)
[![CircleCI](https://circleci.com/gh/ModernPUG/modernpug.org/tree/v2.svg?style=svg)](https://circleci.com/gh/ModernPUG/modernpug.org/tree/v2)
[![StyleCI](https://styleci.io/repos/54202989/shield)](https://styleci.io/repos/54202989)
[![codecov](https://codecov.io/gh/ModernPUG/modernpug.org/branch/v2/graph/badge.svg)](https://codecov.io/gh/ModernPUG/modernpug.org)

[https://modernpug.org](https://modernpug.org)의 소스코드를 관리하기 위한 프로젝트입니다


## 프로젝트 설치
### 요구사항
- php
  - composer.json의 require 참조
- database
  - mysql 5.7

### Install
- `git clone https://github.com/ModernPUG/modernpug.org.git`
- `cd modernpug`
- `chmod 777 bootstrap/cache`
- `chmod -R 777 storage`
- `composer install --no-scripts`
- `cp .env.example .env` 
- `php artisan key:generate` 후 `.env` 하단의 환경설정하기를 참고하여 수정
- `cp .env.testing.example .env.testing` 후 `.env.testing` 내용을 테스트 환경에 맞게 수정
- `php artisan migrate`
- `php artisan db:seed`

### 환경설정하기

#### 기본

```dotenv
APP_NAME=Laravel
APP_ENV=local #개발환경은 local을 그대로 둡니다
APP_KEY=#키는 `php artisan key:generate`를 통해 자동생성 됩니다
APP_DEBUG=true
APP_URL=http://modernpug.org #개발하면서 사용할 URL을 입력합니다
```
#### Mysql
- dotenv에서 설정한 스키마를 생성해 준다. 기본값이 laravel 이며, 변경 가능하다.

```
DB_DATABASE=laravel
``` 
- 최초 설정시 dotenv 를 통해 설정한 스키마(기본 laravel)를 생성해 준다.
- `php artisan migrate` 수행 이전에 실행되어야 한다.
```
mysql> create database laravel;
```

#### Captcha
- https://www.google.com/recaptcha
- 새 사이트 등록 (reCAPTCHA v3 발급)
  - 아래의 내용을 참고하여 `.env`를 수정해줍니다
    - `GOOGLE_RECAPTCHA_KEY=사이트키`
    - `GOOGLE_RECAPTCHA_SECRET=비밀키`

#### Sentry
- https://sentry.io/
- 새 조직 생성
- 라라벨로 신규 프로젝트 생성
- 하단에 표시되는 `SENTRY_LARAVEL_DSN=https://~~~~@sentry.io/~~~~`의 형태로 표시되는 DSN을 복사 후 .env에 추가/수정

#### Slack
- https://slack.com/
- 새로운 워크스페이스 생성
- https://api.slack.com/apps
- Create New App 을 통해 신규 앱 생성

- Oauth
  - OAuth & Permissions -> Redirect URLs
    - `https://modernpug.org/login/slack/callback` 와 같이 자신의 도메인에 맞는 콜백 주소 추가
  - 아래의 내용을 참고하여 `.env`를 수정
    - `SLACK_CLIENT_ID=Basic Information의 Client ID`
    - `SLACK_CLIENT_SECRET=Basic Information의 Client Secret`
    - `SLACK_CLIENT_REDIRECT_URI=https://modernpug.org/login/slack/callback` 
- Incoming Webhooks
  - Incoming Webhooks -> Add New Webhook to Workspace
  - 생성된 url을 `.env`파일 내 `SLACK_WEBHOOK_URL`값에 추가
- Slash Commands
  - Slash Commands -> Create New Command


#### Email

공식 매뉴얼 또는 구글에서 `laravel aws ses`나 `laravel mailgun` 등 검색 후 참고 
 
#### Tag Manager
태그매니저는 `Google Analytics` 등을 조금 더 효율적으로 관리하기 위한 툴입니다. 
태그매니저를 등록 후 `Google Analytics`를 사용하는 것은 별도의 문서를 참고하시기 바랍니다 

- https://tagmanager.google.com/
- 계정 생성(일종의 회사 or 조직 or 그룹) -> 컨테이너 생성 (관리대상이 될 사이트)
- 생성된 컨테이너 ID를 `.env` 파일 내 `TAG_MANAGER`에 추가



### Resource Build 
- `npm ci`
- `npm run watch` or `npm run prod`


## Testing

- `.env.testing.example` 파일을 복사하여 `.env.testing` 파일을 생성하고 테스트 환경을 수정해주세요
- 일부 마이그레이션과 쿼리로 인해 sqlite는 지원하지 않으니 mysql을 사용해주세요
  - 추후 관련기능 수정예정

```bash
./vendor/bin/phpunit
```

## Contributing

- [기여가이드](CONTRIBUTING.md)
- [기여자 행동 강령 규약](CODE_OF_CONDUCT.md)

## Support

- [지원요청](SUPPORT.md)

## License
- [MIT](license.md)
