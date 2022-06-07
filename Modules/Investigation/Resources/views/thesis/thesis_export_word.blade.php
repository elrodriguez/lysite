@php
$title = '';
@endphp
@foreach ($thesis as $thesi)
    @if ($title != $thesi['title'])
        <h1>{{ $thesi['title'] }}</h1>
        @foreach ($thesis as $part)
            <li style="list-style-type: none">
                {{ $part['number_order'] . ' ' . $part['description'] }}
                {!! $part['items'] !!}
            </li>
        @endforeach
    @endif
    @php
        $title = $thesi['title'];
    @endphp
@endforeach