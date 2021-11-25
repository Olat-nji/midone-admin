@component('mail::message')
# Hello

There is new project from {{$project->user->name}}

@component('mail::button', ['url' => url('projects/' . $project->id)])
View
@endcomponent


@endcomponent
