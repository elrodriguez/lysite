<HTML>

<head>
    <title>Export</title>
    <style>
        li {
            list-style: none;
        }

    </style>
</head>

<body>
    @php
        $title = '';
    @endphp
    @foreach ($thesis as $thesi)
        @if ($title != $thesi['title'])
            <h1>{{ $thesi['title'] }}</h1>
            @foreach ($thesis as $part)
                <li>
                    {{ $part['number_order'] . ' ' . $part['description'] }}
                    {!! $part['items'] !!}
                </li>
            @endforeach
        @endif
        @php
            $title = $thesi['title'];
        @endphp
    @endforeach
</body>

</HTML>
