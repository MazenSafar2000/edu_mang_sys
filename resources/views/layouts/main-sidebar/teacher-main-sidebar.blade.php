<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>

        <!-- Sections -->
        <li>
            <a href="{{ route('sections') }}"><i class="fas fa-chalkboard"></i><span
                    class="right-nav-text">{{ trans('main_trans.sections') }}</span></a>
        </li>

        <!-- Students -->
        <li>
            <a href="{{ route('student.index') }}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{ trans('main_trans.Students') }}</span></a>
        </li>

        <!-- Exams -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{ trans('main_trans.Exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('quizzes.index') }}">{{ trans('Teacher_trans.exams_list') }}</a></li>
                <!-- <li><a href="{{ route('questions.index')}}">قائمة الاسئلة</a></li> -->
            </ul>
        </li>

        <!-- Homeworks -->
        <li>
            <a href="{{ route('teacher.homeworks.index') }}">
                <i class="fas fa-book"></i>
                <span class="right-nav-text">{{ trans('Teacher_trans.Homeworks') }}</span>
            </a>
        </li>

        <!-- Library -->
        <li>
            <a href="{{ route('library.index') }}">
                <i class="fas fa-book"></i>
                <span class="right-nav-text">{{ trans('main_trans.library') }}</span>
            </a>
        </li>

        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ trans('Teacher_trans.Videoclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('online_zoom_classes.index') }}">{{ trans('Teacher_trans.Live_classes') }}</a></li>
                <li> <a href="{{ route('recorded-classes.index')}}">{{ trans('Teacher_trans.recorded_classes') }}</a></li>
            </ul>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('profile.show') }}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>


{{-- <div class="sidebar bg-white p-20 p-relative">
    <ul>
        <li>
            <a class="active d-flex align-center fs-14 c-black rad-6 p-10" href="{{ url('/dashboard') }}">
                <span>{{ trans('Teacher_trans.dashboard') }}</span>
                <i class="fa-solid fa-cogs"></i>

            </a>
        </li>

        <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="{{ route('sections') }}">
                <span>{{ trans('Teacher_trans.section') }}</span>
                <i class="fas fa-chalkboard"></i>

            </a>
        </li>

        <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="{{ route('student.index') }}">
                <span>{{ trans('Teacher_trans.students') }}</span>
                <i class="fa-solid fa-user-graduate"></i>

            </a>
        </li>

        <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="{{ route('quizzes.index') }}">
                <span>{{ trans('Teacher_trans.exams') }}</span>
                <i class="fas fa-book-reader"></i>

            </a>
        </li>

        <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="{{ route('teacher.homeworks.index') }}">
                <span>{{ trans('Teacher_trans.Homeworks') }}</span>
                <i class="fas fa-book-reader"></i>

            </a>
        </li>

        <li>
            <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="{{ route('library.index') }}">
                <span>{{ trans('Teacher_trans.books') }}</span>
                <i class="fas fa-book"></i>

            </a>
        </li>

        <li class="dropdown">
            <a href="#" class="d-flex align-center fs-14 c-black rad-6 p-10">
                <i class="fa-solid fa-caret-down arrow"></i>
                <span>{{ trans('Teacher_trans.Videoclasses') }}</span>
                <i class="fa-solid fa-video"></i>

            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('online_zoom_classes.index') }}">{{ trans('Teacher_trans.Live_classes') }}</a>
                </li>
                <li><a href="{{ route('recorded-classes.index') }}">{{ trans('Teacher_trans.recorded_classes') }}</a>
                </li>
            </ul>
        </li>

        <!-- <li class="dropdown">
                <a href="#" class="d-flex align-center fs-14 c-black rad-6 p-10">
                    <i class="fa-solid fa-caret-down arrow"></i>
                    <span>المادة الدراسية</span>
                    <i class="fa-solid fa-file-pen"></i>

                </a>
                <ul class="dropdown-menu">
                    <li><a href="teacher_lessons.html">الدروس</a></li>
                    <li><a href="teacher_hw.html"> الواجبات</a></li>
                    <li><a href="teacher_exams.html">الاختبارات</a></li>
                </ul>
            </li> -->

        <li>
            <a href="{{ route('profile.show') }}"class="d-flex align-center fs-14 c-black rad-6 p-10">
                <span>{{ trans('Teacher_trans.profile') }}</span>
                <i class="fa-solid fa-user"></i>
            </a>
        </li>

    </ul>
</div> --}}
