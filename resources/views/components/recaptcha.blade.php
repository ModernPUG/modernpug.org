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
                    $("{{$formSelector}}").append('<input type="hidden" name="recaptcha-token" value="' + token + '">');
                });
            });
        </script>
    @endif
@endpush

@if ($errors->has($inputName))
    <span class=”invalid-feedback” role="alert">
        <strong>{{ $errors->first($inputName) }}</strong>
    </span>
@endif

