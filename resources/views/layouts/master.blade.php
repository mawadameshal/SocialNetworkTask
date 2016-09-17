<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('css/main.css') }}">
    <title>@yield('title')</title>


</head>
<body>
   @include('includes.header')
     <div class="container">
         @yield('content')

     </div>
</body>
</html>
