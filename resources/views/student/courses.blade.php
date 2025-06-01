<x-app-layout>
    <x-page-title header="Courses" :links="['Courses' => '/courses']"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <div class="bg-light min-vh-100 py-4">
        <div class="container-fluid">
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h2 class="display-5 fw-bold text-primary mb-2">
                                <i class="fas fa-graduation-cap me-2"></i>Your Courses
                            </h2>
                            <p class="text-muted fs-5">Track your academic progress and manage your coursework</p>
                        </div>
                        <div class="d-none d-md-block">
                            @if(isset($courses) && count($courses) > 0)
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center p-3">
                                        <div class="text-primary fw-bold fs-4">{{ count($courses) }}</div>
                                        <small class="text-muted">Total Courses</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Filter and Search Bar -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" id="searchCourses" 
                                       placeholder="Search courses..." onkeyup="filterCourses()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter" onchange="filterCourses()">
                                <option value="">All Status</option>
                                <option value="Completed">Completed</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Not Started">Not Started</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-outline-secondary active" onclick="toggleView('grid')">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" onclick="toggleView('list')">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(isset($courses) && count($courses) > 0)
                <!-- Courses Container -->
                <div id="coursesContainer">
                    <div class="row g-4" id="coursesGrid">
                        @foreach($courses as $course)
                            <div class="col-lg-4 col-md-6 course-card" 
                                 data-title="{{ strtolower($course->title ?? '') }}" 
                                 data-code="{{ strtolower($course->course_code ?? '') }}"
                                 data-status="{{ $course->status_text ?? '' }}">
                                <div class="card h-100 shadow-sm border-0 course-item">
                                    <!-- Course Header -->
                                    <div class="card-header bg-gradient bg-primary text-white border-0 py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-book me-2"></i>
                                                <span class="badge bg-light text-primary fw-bold">
                                                    {{ $course->course_code ?? 'N/A' }}
                                                </span>
                                            </div>
                                            @if(isset($course->status_text))
                                                @php
                                                    $statusConfig = [
                                                        'Completed' => ['class' => 'success', 'icon' => 'check-circle'],
                                                        'In Progress' => ['class' => 'warning', 'icon' => 'clock'],
                                                        'Not Started' => ['class' => 'secondary', 'icon' => 'pause-circle']
                                                    ];
                                                    $status = $statusConfig[$course->status_text] ?? ['class' => 'info', 'icon' => 'info-circle'];
                                                @endphp
                                                <span class="badge bg-{{ $status['class'] }}">
                                                    <i class="fas fa-{{ $status['icon'] }} me-1"></i>
                                                    {{ $course->status_text }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Course Body -->
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-dark fw-bold mb-3">
                                            <i class="fas fa-bookmark text-primary me-2"></i>
                                            {{ $course->title ?? 'Untitled Course' }}
                                        </h5>
                                        
                                        <p class="card-text text-muted flex-grow-1 course-description">
                                            {{ $course->description ?? 'No description available.' }}
                                        </p>
                                        
                                        <div class="d-flex align-items-center mb-3 text-muted">
                                            <i class="fas fa-credit-card me-2"></i>
                                            <span class="fw-semibold">{{ $course->credits ?? 'N/A' }} Units</span>
                                        </div>
                                    </div>

                                    <!-- Course Footer -->
                                    <div class="card-footer bg-transparent border-0 pt-0">
                                        <div class="d-grid gap-2 d-md-flex">
                                            <button class="btn btn-primary flex-fill" onclick="viewGrades('{{ $course->id ?? '' }}')">
                                                <i class="fas fa-chart-bar me-2"></i>View Grades
                                            </button>
                                            <div class="btn-group">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" 
                                                        data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" onclick="viewDetails('{{ $course->id ?? '' }}')">
                                                        <i class="fas fa-info-circle me-2"></i>Course Details
                                                    </a></li>
                                                    <li><a class="dropdown-item" href="#" onclick="viewSchedule('{{ $course->id ?? '' }}')">
                                                        <i class="fas fa-calendar me-2"></i>Schedule  
                                                    </a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" onclick="downloadSyllabus('{{ $course->id ?? '' }}')">
                                                        <i class="fas fa-download me-2"></i>Download Syllabus
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm text-center py-5">
                            <div class="card-body">
                                <div class="mb-4">
                                    <i class="fas fa-graduation-cap text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="card-title text-muted mb-3">No Courses Available</h4>
                                <p class="card-text text-muted mb-4">
                                    You haven't enrolled in any courses yet. Start your learning journey today!
                                </p>
                                <button class="btn btn-primary btn-lg" onclick="browseCourses()">
                                    <i class="fas fa-plus me-2"></i>Browse Courses
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Course filtering functionality
        function filterCourses() {
            const searchTerm = document.getElementById('searchCourses').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const courseCards = document.querySelectorAll('.course-card');
            
            courseCards.forEach(card => {
                const title = card.dataset.title;
                const code = card.dataset.code;
                const status = card.dataset.status;
                
                const matchesSearch = title.includes(searchTerm) || code.includes(searchTerm);
                const matchesStatus = !statusFilter || status === statusFilter;
                
                if (matchesSearch && matchesStatus) {
                    card.style.display = 'block';
                    // Add fade-in animation
                    card.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // View toggle functionality
        function toggleView(viewType) {
            const gridContainer = document.getElementById('coursesGrid');
            const buttons = document.querySelectorAll('.btn-group button');
            
            // Update button states
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            if (viewType === 'list') {
                gridContainer.className = 'row g-2';
                document.querySelectorAll('.course-card').forEach(card => {
                    card.className = 'col-12 course-card';
                });
            } else {
                gridContainer.className = 'row g-4';
                document.querySelectorAll('.course-card').forEach(card => {
                    card.className = 'col-lg-4 col-md-6 course-card';
                });
            }
        }

        // Course action functions
        function viewGrades(courseId) {
            // Add loading state
            event.target.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            
            // Simulate API call
            setTimeout(() => {
                alert(`Viewing grades for course ID: ${courseId}`);
                event.target.innerHTML = '<i class="fas fa-chart-bar me-2"></i>View Grades';
            }, 1000);
        }

        function viewDetails(courseId) {
            alert(`Viewing details for course ID: ${courseId}`);
        }

        function viewSchedule(courseId) {
            alert(`Viewing schedule for course ID: ${courseId}`);
        }

        function downloadSyllabus(courseId) {
            // Show toast notification
            showToast('Downloading syllabus...', 'info');
        }

        function browseCourses() {
            alert('Redirecting to course catalog...');
        }

        // Toast notification function
        function showToast(message, type = 'success') {
            const toastContainer = document.createElement('div');
            toastContainer.className = `toast align-items-center text-white bg-${type} border-0`;
            toastContainer.setAttribute('role', 'alert');
            toastContainer.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-info-circle me-2"></i>${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            document.body.appendChild(toastContainer);
            const toast = new bootstrap.Toast(toastContainer);
            toast.show();
            
            // Remove toast after it's hidden
            toastContainer.addEventListener('hidden.bs.toast', () => {
                toastContainer.remove();
            });
        }

        // Add hover effects with JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const courseItems = document.querySelectorAll('.course-item');
            
            courseItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.transition = 'all 0.3s ease';
                    this.classList.add('shadow-lg');
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.classList.remove('shadow-lg');
                });
            });
        });
    </script>

    <!-- Custom CSS -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .course-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }

        .card-header.bg-gradient {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%) !important;
        }

        .course-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .course-item:hover {
            border-color: #0d6efd !important;
        }

        .btn-group .btn {
            transition: all 0.2s ease;
        }

        .input-group-text {
            border-right: none;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
        }
    </style>
</x-app-layout>