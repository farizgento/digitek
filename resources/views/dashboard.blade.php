ini dashboard user
@if (auth()->check())
    ,user telah melakukan login dengan role
    {{ auth()->user()->getRoleNames() }}
@endif