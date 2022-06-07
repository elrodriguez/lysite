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
            <ul>
                @foreach ($thesis as $part)
                    <li>
                        {{ $part['number_order'] . ' ' . $part['description'] }}
                        <div>{{ html_entity_decode($part['content'], ENT_QUOTES, 'UTF-8') }}</div>
                        {!! $part['items'] !!}
                    </li>
                @endforeach
            </ul>
        @endif
        @php
            $title = $thesi['title'];
        @endphp
    @endforeach
</body>

</HTML>
