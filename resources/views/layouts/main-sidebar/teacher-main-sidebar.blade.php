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
                {{-- <li><a href="{{ route('questions.index')}}">قائمة الاسئلة</a></li> --}}
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
                        class="right-nav-text">{{ trans('main_trans.Onlineclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('online_zoom_classes.index') }}">{{ trans('main_trans.Onlineclasses') }}</a>
                </li>
            </ul>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('profile.show') }}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.profile') }}</span></a>
        </li>

    </ul>
</div>
