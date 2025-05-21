<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>spark education</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    @if (App::getLocale() == 'en')
        <link href="{{ URL::asset('assets/css/myltr.css') }}" rel="stylesheet">
    @else
        <link href="{{ URL::asset('assets/css/myrtl.css') }}" rel="stylesheet">
    @endif

</head>

<body>
    <!-- Header Section -->
    <header class="header">
        <section class="flex">
            <button id="menu-btn" type="button" class="menu-icon fas fa-bars"></button>
            <nav class="navbar">
                <a href="{{ LaravelLocalization::getLocalizedURL(App::getLocale() == 'ar' ? 'en' : 'ar', null, [], true) }}"
                    id="lang-btn" title="{{ trans('main_trans.change_lang')}}" class="fas fa-language">
                </a>
                <a href="{{ route('aboutUs') }}" id="about-btn" title="{{ trans('main_trans.About_us')}}"
                    class="fas fa-question {{ request()->routeIs('aboutUs') ? 'active' : '' }}"></a>
                <a href="contact.html" id="contact-btn" title="{{ trans('main_trans.Contact_us')}}" class="fas fa-phone"></a>
            </nav>
            <a href="{{ route('loginpage') }}" class="logo"><img src="{{ URL::asset('assets/images/spark.png') }}"
                    alt="spark education"></a>
        </section>
    </header>

    @yield('content')

    <!-- Footer -->
    @if (App::getLocale() == 'en')
        <footer class="footer">
            &copy; {{ trans('main_trans.Copyright_by') }} <span>spark education</span> |
            {{ trans('main_trans.All_rights_reserved') }}
        </footer>
    @else
        <footer class="footer">
            &copy; {{ trans('main_trans.All_rights_reserved') }} | <span>spark education</span>
            {{ trans('main_trans.Copyright_by') }}
        </footer>
    @endif

    <!-- Scripts -->
    <script src="{{ URL::asset('assets/js/new-template/js.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const studentBtn = document.getElementById("student-btn");
            const parentBtn = document.getElementById("parent-btn");
            const studentForm = document.getElementById("student-form");
            const parentForm = document.getElementById("parent-form");

            studentBtn.addEventListener("click", function() {
                studentForm.style.display = "block";
                parentForm.style.display = "none";
                studentBtn.src = "{{ URL::asset('assets/images/std-on.png') }}";
                parentBtn.src = "{{ URL::asset('assets/images/par-off.png') }}";
            });

            parentBtn.addEventListener("click", function() {
                studentForm.style.display = "none";
                parentForm.style.display = "block";
                studentBtn.src = "{{ URL::asset('assets/images/std-off.png') }}";
                parentBtn.src = "{{ URL::asset('assets/images/par-on.png') }}";

            });
        });
    </script>
</body>

</html>
