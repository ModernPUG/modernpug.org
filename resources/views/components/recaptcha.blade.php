@push('css')
    <style>
        .grecaptcha-badge {
            display: none;
        }
    </style>
@endpush

@push('js')
    @if(config('recaptcha.key'))
        <script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.key') }}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ config('recaptcha.key') }}', {action: 'homepage'}).then(function (token) {
                    $("form").append('<input type="hidden" name="{{ config('recaptcha.validation-key') }}" value="' + token + '">');
                });
            });
        </script>
    @endif
@endpush

@if ($errors->has(config('recaptcha.validation-key')))
    <span class=”invalid-feedback” role="alert">
        <strong>{{ $errors->first(config('recaptcha.validation-key')) }}</strong>
    </span>
@endif

