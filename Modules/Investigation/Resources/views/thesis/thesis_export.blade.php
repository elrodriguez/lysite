@php
$title = '';
@endphp
@foreach ($thesis as $thesi)
    <HTML>
    @php
        $d = $thesis[0]['right_margin'];
        $l = $thesis[0]['left_margin'];
        $m = $thesis[0]['between_lines'];
    @endphp

    <head>
        <title>Export</title>
        <style>
            li {
                list-style: none;
            }

            @page {
                margin-left: {{ $l }}cm;
                margin-right: {{ $d }}cm;
            }
        </style>
    </head>

    <body style="padding: 0">

        @if ($title != $thesi['title'])
            {{-- <h1>{{ $thesi['title'] }}</h1> --}}
            <ol>
                @foreach ($thesis as $part)
                    <li>
                        @if ($part['show_description'])
                        {{ $part['number_order'] . ' ' . $part['description'] }}
                        @endif
                        {!! $part['content'] !!}
                        {!! $part['items'] !!}
                    </li>
                @endforeach
            </ol>
        @endif
        @php
            $title = $thesi['title'];
        @endphp

    </body>

    </HTML>
@endforeach
