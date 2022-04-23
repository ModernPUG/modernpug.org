@if(config('services.slack.client_id'))

    <a class="btn btn-outline-secondary btn-block"
       href="{{ route('login.social',['slack']) }}">
        <strong>
            <i class="fa fa-slack icon"></i> Login with Slack
        </strong>
    </a>
@endif

@if(config('services.discord.client_id'))

    <a class="btn btn-outline-secondary btn-block"
       href="{{ route('login.social',['discord']) }}">
        <strong>
            <i class="fab fa-discord icon"></i> Login with Discord
        </strong>
    </a>
@endif
