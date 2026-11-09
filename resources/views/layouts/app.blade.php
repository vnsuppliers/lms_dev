@include('layouts.user.header')
@yield('content')
@yield('script')
{{-- @include('layouts.partials.browser-close-tracker') --}}
@include('layouts.user.footer') 


@include('layouts.admin.header')
@yield('content')
@yield('script')
@include('layouts.partials.browser-close-tracker')
@include('layouts.admin.footer') 