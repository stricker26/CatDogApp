<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('layout.includes.head')
</head>
<body>
   <main role="main">
      @include('layout.includes.navigation')
      @yield('content')
   </main>
   <footer>
      @include('layout.includes.footer')
   </footer>
   @include('layout.includes.scripts')
</body>
</html>