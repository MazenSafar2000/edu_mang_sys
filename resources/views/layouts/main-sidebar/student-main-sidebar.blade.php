<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ route('dashboard.Students') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>

        <!-- Subjects -->
        <li>
            <a href=""><i class="fas fa-book"></i><span
                    class="right-nav-text">{{ __('Students_trans.subjects') }}</span></a>
        </li>

        <!-- Exams-->
        <li>
            <a href="{{ route('student_exams.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ __('Students_trans.exams') }}</span></a>
        </li>

        <!-- Homework -->
        <li>
            <a href="{{ route('student.submissions.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ __('Students_trans.Homeworks') }}</span></a>
        </li>

        <!-- Books -->
        <li>
            <a href="{{ route('student.library.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ __('Students_trans.Books') }}</span></a>
        </li>

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ trans('Teacher_trans.Videoclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="">{{ trans('Teacher_trans.Live_classes') }}</a>
                </li>
                <li> <a href="">{{ trans('Teacher_trans.recorded_classes') }}</a>
                </li>
            </ul>
        </li>


        <!-- Profile-->
        <li>
            <a href="{{ route('profile-student.index') }}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{ __('Students_trans.profile') }}</span></a>
        </li>




    </ul>
</div>
