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
- php7.3 (php의 버전 및 익스텐션의 경우 문서의 내용보다 composer.json을 더 우선하십시오)
- mysql

### Install
- `git clone https://github.com/ModernPUG/modernpug.org.git`
- `chmod 777 bootstrap/cache`
- `chmod -R 777 storage`
- `composer install --no-scripts`
- `cp .env.example .env` 후 `.env` 내용 수정
- `cp .env.testing.example .env.testing` 후 `.env` 내용 수정
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:seed`

### scss to css
- `npm ci`
- `npm run watch` or `npm run prod`


## Testing

- .env.testing.example 파일을 복사하여 .env.testing 파일을 생성하고 테스트 환경을 수정해주세요
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
