@php
$title = '';
@endphp
@foreach ($thesis as $thesi)
    @if ($title != $thesi['title'])
        <h1>{{ $thesi['title'] }}</h1>
        @foreach ($thesis as $part)
            @if ($key > 0 && $part['salto_de_pagina'])
                <div class="page-break" style="page-break-after:always;"><span style="display:none;">&nbsp;</span></div>
            @endif
            <li>
                @if ($part['show_description'])
                    {{ $part['number_order'] . ' ' . $part['description'] }}
                @endif
                {!! $part['content'] !!}
                {!! $part['items'] !!}
            </li>
        @endforeach
    @endif
    @php
        $title = $thesi['title'];
    @endphp
@endforeach
