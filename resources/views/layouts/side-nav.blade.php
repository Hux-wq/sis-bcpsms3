<!-- ======= Enhanced Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Logo Section -->
        <div class="sidebar-logo">
            <div class="logo-container">
                <img src="https://elc-public-images.s3.ap-southeast-1.amazonaws.com/bcp-olp-logo-mini2.png" alt="Logo" class="logo-img">
            </div>
        </div>

        <!-- User Profile Section -->
        <div class="user-profile-section">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            
            @if (Auth::User()->isAdmin())
                <div class="user-info">
                    <div class="user-name">
                        {{Auth::User()->name}}
                    </div>
                    <div class="user-id">
                        ID: {{Auth::User()->id}}
                    </div>
                    <div class="user-role admin-role">
                        <i class="fas fa-crown"></i> Administrator
                    </div>
                </div>
            @elseif (Auth::User()->isStudent())
                @php
                $id = Auth::user()->linking_id;
                $student = App\Models\Student::findOrFail($id); 
                @endphp
                <div class="user-info">
                    <div class="user-name">
                        {{ $student->first_name }} 
                        {{ $student->middle_name }} 
                        {{ $student->last_name }}
                    </div>
                    <div class="user-id">
                        {{ $student->student_number }}
                    </div>
                    <div class="user-role student-role">
                        <i class="fas fa-graduation-cap"></i> Student
                    </div>
                </div>  
            @elseif (Auth::User()->isTeacher())
                <div class="user-info">
                    <div class="user-name">
                        {{Auth::User()->name}}
                    </div>
                    <div class="user-id">
                        ID: {{Auth::User()->id}}
                    </div>
                    <div class="user-role teacher-role">
                        <i class="fas fa-chalkboard-teacher"></i> Teacher
                    </div>
                </div>
            @endif
        </div>

        <!-- Navigation Menu -->
        <div class="nav-menu">
            <!-- Dashboard Section -->
            <div class="nav-section">
                <div class="nav-section-title">
                    <i class="fas fa-home"></i>
                    Dashboard
                </div>

                @if(Auth::check() && Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-chart-pie"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(Auth::check() && Auth::user()->isTeacher())
                    <li class="nav-item">
                        <a href="{{ route('teacher.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-chart-pie"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if(Auth::check() && Auth::user()->isStudent())
                    <li class="nav-item">
                        <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-chart-pie"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                @endif
            </div>

            @if(Auth::check())
                @if(Auth::user()->isAdmin())
                    <!-- Students Section -->
                    <div class="nav-section">
                        <div class="nav-section-title">
                            <i class="fas fa-users"></i>
                            Management
                        </div>

                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle" data-bs-toggle="collapse" href="#studentsSubmenu" role="button" aria-expanded="false" aria-controls="studentsSubmenu">
                                <div class="nav-link-content">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Students</span>
                                    <i class="fas fa-chevron-down arrow-icon"></i>
                                </div>
                            </a>
                            <ul class="collapse submenu" id="studentsSubmenu">
                                <li><a class="submenu-link" href="{{ route('admin.student') }}">
                                    <i class="fas fa-circle submenu-dot"></i>Enrolled (Regular)
                                </a></li>
                                <li><a class="submenu-link" href="{{ route('admin.returnee') }}">
                                    <i class="fas fa-circle submenu-dot"></i>Returnee
                                </a></li>
                                <li><a class="submenu-link" href="{{ route('admin.transferee') }}">
                                    <i class="fas fa-circle submenu-dot"></i>Transferee
                                </a></li>
                                <li><a class="submenu-link" href="{{ route('admin.octoberian')}}">
                                    <i class="fas fa-circle submenu-dot"></i>Octoberian
                                </a></li>
                                <li><a class="submenu-link" href="{{ route('admin.graduated')}}">
                                    <i class="fas fa-circle submenu-dot"></i>Graduated
                                </a></li>
                                <li><a class="submenu-link" href="{{ route('admin.droppedout')}}">
                                    <i class="fas fa-circle submenu-dot"></i>Dropped Out
                                </a></li>
                                <li><a class="submenu-link" href="{{ route('admin.failed')}}">
                                    <i class="fas fa-circle submenu-dot"></i>Failed
                                </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.teachers.index') }}">
                                <div class="nav-link-content">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Teachers</span>
                                </div>
                            </a>
                        </li>
                    </div>
                @endif
            @endif

            @if(Auth::check() && Auth::user()->isTeacher())
                <!-- Teacher Section -->
                <div class="nav-section">
                    <div class="nav-section-title">
                        <i class="fas fa-chalkboard"></i>
                        Teaching Tools
                    </div>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.grades.input') }}">
                            <div class="nav-link-content">
                                <i class="fas fa-pen"></i>
                                <span>Input Grades</span>
                            </div>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.attendance.input') }}">
                            <div class="nav-link-content">
                                <i class="fas fa-calendar-check"></i>
                                <span>Input Attendance</span>
                            </div>
                        </a>
                    </li>
                </div>
            @endif

            @if(!Auth::user()->isTeacher())
                <!-- Documents Section -->
                <div class="nav-section">
                    <div class="nav-section-title">
                        <i class="fas fa-folder-open"></i>
                        Documents
                    </div>

                    <li class="nav-item">
                        <a href="{{ route('admin.document') }}" class="nav-link {{ request()->routeIs('document') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-folder"></i>
                                <span>Documents</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.request') }}" class="nav-link {{ request()->routeIs('request') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-search"></i>
                                <span>Requests</span>
                            </div>
                        </a>
                    </li>
                </div>
            @endif

            @if(Auth::check() && Auth::user()->isAdmin())
                <!-- Reports Section -->
                <div class="nav-section">
                    <div class="nav-section-title">
                        <i class="fas fa-chart-bar"></i>
                        Analytics
                    </div>

                    <li class="nav-item">
                        <a href="{{ route('admin.report') }}" class="nav-link {{ request()->routeIs('report') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-chart-simple"></i>
                                <span>Reports</span>
                            </div>
                        </a>
                    </li>
                </div>
            @endif

            <!-- Settings Section -->
            <div class="nav-section">
                <div class="nav-section-title">
                    <i class="fas fa-cog"></i>
                    Settings
                </div>

                @if(Auth::user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('admin.account.creation') }}" class="nav-link {{ request()->routeIs('account.creation') ? 'active' : '' }}">
                            <div class="nav-link-content">
                                <i class="fas fa-user-plus"></i>
                                <span>Account Creation</span>
                            </div>
                        </a>
                    </li>
                @endif

                <li class="nav-item logout-item">
                    <a class="nav-link logout-link" href="#" onclick="confirmLogout(event)">
                        <div class="nav-link-content">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Log Out</span>
                        </div>
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </div>
        </div>
    </ul>

    <script>
        function confirmLogout(event) {
            event.preventDefault();
            
            Swal.fire({
                title: "Logout?", 
                text: "You are about to logout!", 
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Logout!",
                customClass: {
                    popup: 'swal-popup',
                    title: 'swal-title',
                    content: 'swal-content'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                    
                    Swal.fire({
                        title: "Logged Out!",
                        text: "You have been successfully logged out.",
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        }

        // Enhanced dropdown functionality
        document.addEventListener('DOMContentLoaded', function () {
            var collapseElements = document.querySelectorAll('.collapse');
            
            collapseElements.forEach(function(collapseElement) {
                var toggle = document.querySelector('[href="#' + collapseElement.id + '"]');
                var arrowIcon = toggle.querySelector('.arrow-icon');

                collapseElement.addEventListener('show.bs.collapse', function () {
                    arrowIcon.classList.add('rotate');
                    toggle.classList.add('expanded');
                });

                collapseElement.addEventListener('hide.bs.collapse', function () {
                    arrowIcon.classList.remove('rotate');
                    toggle.classList.remove('expanded');
                });
            });

            // Add hover effects
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'translateX(5px)';
                    }
                });
                
                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.transform = 'translateX(0)';
                    }
                });
            });
        });
    </script>

    <style>
        .sidebar {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar {
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-nav {
            padding: 0;
            margin: 0;
            list-style: none;
            height: auto;
            overflow: visible;
        }

        /* Custom Scrollbar - Apply to sidebar container only */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Logo Section */
        .sidebar-logo {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.15);
        }

        .logo-img {
            width: 30px;
            height: auto;
        }

        /* User Profile Section */
        .user-profile-section {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1.5rem;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            font-size: 32px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            border: 3px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .user-avatar::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
            opacity: 0;
        }

        .user-avatar:hover::before {
            opacity: 1;
            animation: shimmer 1.5s ease-in-out;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .user-info {
            color: white;
        }

        .user-name {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.25rem;
            color: #f8fafc;
        }

        .user-id {
            font-size: 0.85rem;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }

        .user-role {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-role {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: #1f2937;
        }

        .teacher-role {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .student-role {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
        }

        /* Navigation Menu */
        .nav-menu {
            padding: 0 1rem;
        }

        .nav-section {
            margin-bottom: 2rem;
        }

        .nav-section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-section-title i {
            font-size: 0.9rem;
            color: #64748b;
        }

        .nav-item {
            margin-bottom: 0.25rem;
            list-style: none;
        }

        .nav-link {
            display: block;
            padding: 0.75rem 1rem;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            transform: translateX(5px);
        }

        .nav-link-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-link-content i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
        }

        .nav-link-content span {
            font-weight: 500;
        }

        /* Submenu Styles */
        .has-submenu .nav-link {
            position: relative;
        }

        .submenu-toggle .arrow-icon {
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 0.8rem;
        }

        .submenu-toggle.expanded .arrow-icon,
        .arrow-icon.rotate {
            transform: rotate(180deg);
        }

        .submenu {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            margin: 0.5rem 0;
            padding: 0.5rem 0;
            border-left: 3px solid #3b82f6;
            margin-left: 1rem;
        }

        .submenu-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 1rem;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-radius: 6px;
            margin: 0.1rem 0.5rem;
        }

        .submenu-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(3px);
        }

        .submenu-dot {
            font-size: 0.4rem;
            color: #64748b;
        }

        .submenu-link:hover .submenu-dot {
            color: #3b82f6;
        }

        /* Logout Special Styling */
        .logout-item {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-link {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .logout-link:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border-color: rgba(239, 68, 68, 0.5);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .user-avatar {
                width: 60px;
                height: 60px;
                font-size: 24px;
            }

            .user-name {
                font-size: 0.9rem;
            }

            .nav-link {
                padding: 0.6rem 0.8rem;
            }

            .nav-section-title {
                font-size: 0.8rem;
                padding: 0.6rem 0.8rem;
            }
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Sweet Alert Custom Styling */
        .swal-popup {
            background: #1e293b !important;
            color: #e2e8f0 !important;
        }

        .swal-title {
            color: #f8fafc !important;
        }

        .swal-content {
            color: #cbd5e1 !important;
        }
    </style>
</aside>