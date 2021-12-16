<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <meta name="description" content="It's like a phonebook. But just for you." />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="PhoneBook" />
    <meta property="og:description" content="It's like a phonebook. But just for you." />
    <meta property="og:url" content="https://phonebookdev/" />
    <meta property="og:site_name" content="PhoneBook" />
    <meta property="og:image" content="https://phonebookdev/images/social-share.jpg" />
    <meta property="og:image:secure_url" content="https://phonebookdev/images/social-share.jpg" />
    <meta name="twitter:text:title" content="PhoneBook" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="https://phonebookdev/images/social-share.jpg" />
    <meta name="twitter:image:alt" content="Blue background with a notebook emoji and PhoneBook in text">
    <!-- End Open Graph Tags -->
    
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📔</text></svg>">

    <meta name="description" content="" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PhoneBook</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Global site tag (gtag.js) - Google Analytics -->

</head>
<body>
  <div id="app">
    <app></app>
  </div>
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
