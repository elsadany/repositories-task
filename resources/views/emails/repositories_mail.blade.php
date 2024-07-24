@component('mail::message')
    <p>Dears</p>
    <p>
        Below the excel link for your search
    </p>
    <a href="{{url(Storage::url($path))}}" target="_blank">go</a>
@endcomponent
