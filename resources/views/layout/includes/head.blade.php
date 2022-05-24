<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}" />
<title>Pet Shop | {{ $title }}</title>
<meta name="description" content="{{ $description }}" />
<link rel="canonical" href="{{ url()->current() }}" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $title }}" />
<meta property="og:description" content="{{ $description }}" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="Pet Shop" />
<meta property="og:image" content="{{ $image }}" />
<meta property="og:image:width" content="1152" />
<meta property="og:image:height" content="768" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:description" content="{{ $description }}" />
<meta name="twitter:title" content="{{ $title }}" />
<meta name="twitter:image" content="{{ $image }}" />
<link rel="icon" href="{{ asset('images/favicon.ico') }}" />
<link rel="stylesheet" href="{{ asset('css/app.css') }}" />