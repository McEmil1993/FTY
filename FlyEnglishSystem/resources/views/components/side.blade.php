<!-- Sidebar Menu -->
<aside class="main-sidebar sidebar-light-primary elevation-3">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset ('dist/img/Fly.png') }}" alt="FlyEnglish Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bolder">ESL - Fly English</span>
    </a>
    <div class="sidebar"><!-- Sidebar -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{route ('Home') }}" class="nav-link" id="active_dashboard">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route ('Students') }}" class="nav-link" id="active_student">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            My Students
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route ('Type_Of_Feedbacks') }}" class="nav-link" id="active_tof">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Type of Feedbacks
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route ('Books') }}" class="nav-link" id="active_book">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Books
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route ('Manage_Feedbacks') }}" class="nav-link" id="active_mf">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Manage Feedbacks
                        </p>
                    </a>
                </li>
            </ul>
        </nav><!-- /.sidebar-menu -->
    </div><!-- /.sidebar -->
</aside>