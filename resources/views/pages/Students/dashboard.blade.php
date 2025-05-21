<!DOCTYPE html>
<html lang="en">
@section('title')
    {{ trans('main_trans.Main_title') }}
@stop

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('1a06a2c635266cba345c', {
            cluster: 'ap1',
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });

        // Assuming you have a JS variable of student ID
        var studentId = {{ auth()->user()->id }};
        var channel = pusher.subscribe('private-App.Models.Student.' + studentId);

        channel.bind('new-book', function(data) {
            // Add notification to the bell dropdown
            const notificationList = document.getElementById('notification-list');
            const notificationCount = document.getElementById('notification-count');

            const newItem = document.createElement('li');
            newItem.classList.add('dropdown-item');
            newItem.textContent = `New Book: ${data.content}`;
            notificationList.prepend(newItem);

            // Update counter
            let currentCount = parseInt(notificationCount.innerText);
            notificationCount.innerText = currentCount + 1;
        });
    </script>

</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--================================= preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')

        <!--================================= Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">{{ __('Students_trans.welcome') }}:
                            {{ auth()->user()->name }}</h4>
                    </div><br><br>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <livewire:student-subjects />
            {{-- <div class="calendar-main mb-30">
                <livewire:calendar-student />
            </div> --}}

            <!--================================= wrapper -->

            <!--================================= footer -->

            @include('layouts.footer')
        </div>
        <!-- main content wrapper end-->
    </div>
    </div>
    </div>
    <!--================================= footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')
</body>

</html>
