@component('mail::message')
# Your Post Was Liked

{{ $liker->name }} liked one of your posts.

@component('mail::button', ['url' => route('posts.show', $post)])
    View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
