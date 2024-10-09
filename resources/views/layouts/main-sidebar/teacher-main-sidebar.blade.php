<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('main_trans.Programname')}} </li>

        <!-- الطلاب-->
        <li>
            <a target="_blank" href="{{route('teacherstudents.index')}}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">{{trans('main_trans.Student_List')}}</span></a>
        </li>


         <!-- الاختبارات-->
         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i><span
                        class="right-nav-text">{{trans('main_trans.Quizzes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('quizzes.index')}}">{{trans('main_trans.Quizzes_List')}}</a></li>
                <li><a href="#">{{trans('main_trans.Questions_List')}}</a></li>
            </ul>

        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{route('profile.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">الملف الشخصي</span></a>
        </li>
    </ul>
</div>
