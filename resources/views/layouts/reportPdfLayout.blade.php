<html dir="rtl">
        <head>
            @include('layouts.partials.report_style')
        </head>
        <br />
    <body >
        @include('layouts.partials.report_top_header')
        @yield('filter-description')
        @yield('content')
        @include('layouts.partials.report_footer')
    </body>

</html>