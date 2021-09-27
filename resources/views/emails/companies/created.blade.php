@component('mail::message')


{{ __('messages.created_msg') }}

@component('mail::table')
    |                    |                            |
    |:------------------ |:-------------------------- |
    | **{{ __('messages.name') }}**           | {{$company->name}}       |
    | **{{ __('messages.email') }}**          | {{$company->email}}      |
    | **{{ __('messages.date') }}**          | {{$company->created_at}} |
    | **{{ __('messages.phone') }}**       | {{ $company->phone }} |
    | **{{ __('messages.website') }}**        | {{ $company->website ?? 'N/a'}} |
@endcomponent

Thanks,<br>
{{$company->name}}  
@endcomponent
