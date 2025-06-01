<x-app-layout>
    <x-page-title header="Teacher Dashboard" :links="['teacher.dashboard' => '/teacher/dashboard']"/>

    <section class="section dashboard">
        <!-- Welcome Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card welcome-card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-1">Welcome back, Teacher!</h3>
                                <p class="mb-0 opacity-75">Here's an overview of your classes and students</p>
                            </div>
                            <div class="d-none d-md-block">
                                <i class="fas fa-chalkboard-teacher fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <!-- Sections Card -->
            <div class="col-xxl-4 col-md-6 mb-3">
                <div class="card stats-card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fa-solid fa-chalkboard-teacher text-primary fa-2x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="text-muted mb-0 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Sections</h6>
                                </div>
                                <h2 class="mb-2 fw-bold text-dark">{{ $sectionsCount }}</h2>
                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#sectionsScheduleModal">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    View Schedule
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Card -->
            <div class="col-xxl-4 col-md-6 mb-3">
                <div class="card stats-card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fa-solid fa-user-graduate text-success fa-2x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="text-muted mb-0 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Students</h6>
                                </div>
                                <h2 class="mb-2 fw-bold text-dark">{{ $studentsCount }}</h2>
                                <small class="text-muted">
                                    <i class="fas fa-users me-1"></i>
                                    Total enrolled students
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="col-xxl-4 col-md-12 mb-3">
                <div class="card stats-card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stats-icon bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                <i class="fa-solid fa-bolt text-info fa-2x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="text-muted mb-2 text-uppercase fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">Quick Actions</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <button class="btn btn-outline-primary btn-sm rounded-pill">
                                        <i class="fas fa-plus me-1"></i>
                                        Add Student
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill">
                                        <i class="fas fa-file-export me-1"></i>
                                        Export
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students List -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1 fw-bold">Students in Your Sections</h5>
                                <p class="text-muted mb-0">Manage and view all students across your sections</p>
                            </div>
                            <div class="d-flex gap-2">
                                <form method="GET" action="{{ route('teacher.dashboard') }}" class="d-flex" id="searchForm" onsubmit="return false;">
                                    <input type="text" name="search" id="searchInput" class="form-control form-control-sm rounded-pill me-2" placeholder="Search students..." value="{{ request('search') }}" autocomplete="off">
                                </form>
                                <button class="btn btn-outline-primary btn-sm rounded-pill">
                                    <i class="fas fa-filter me-1"></i>
                                    Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        @if($sections->isEmpty())
                            <div class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Students Found</h5>
                                    <p class="text-muted">No students found in your sections.</p>
                                </div>
                            </div>
                        @else
                            <!--  Tab Navigation -->
                            <div class="px-4 pt-3">
                                <ul class="nav nav-pill nav-fill" id="dashboardSectionTabs" role="tablist">
                                    @foreach ($sections as $index => $section)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill mx-1 @if($index == 0) active @endif" 
                                                id="dashboard-tab-{{ $section->id }}" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#dashboard-section-{{ $section->id }}" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="dashboard-section-{{ $section->id }}" 
                                                aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                            <i class="fas fa-chalkboard me-2"></i>
                                            Section {{ $section->section }}
                                            <span class="badge bg-light text-dark ms-2">{{ $section->students->count() }}</span>
                                        </button>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Tab Content -->
                            <div class="tab-content mt-3" id="dashboardSectionTabsContent">
                                @foreach ($sections as $index => $section)
                                <div class="tab-pane fade @if($index == 0) show active @endif" 
                                     id="dashboard-section-{{ $section->id }}" 
                                     role="tabpanel" 
                                     aria-labelledby="dashboard-tab-{{ $section->id }}">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="px-4 py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">No.</small>
                                                    </th>
                                                    <th class="py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">Student Number</small>
                                                    </th>
                                                    <th class="py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">Name</small>
                                                    </th>
                                                    <th class="py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">Program</small>
                                                    </th>
                                                    <th class="py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">Actions</small>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($section->students as $studentIndex => $student)
                                                    <tr class="student-row">
                                                        <td class="px-4 py-3 align-middle">
                                                            <span class="badge bg-light text-dark rounded-pill">{{ $studentIndex + 1 }}</span>
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            <span class="fw-medium">{{ $student->student_number }}</span>
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-placeholder bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                                    <span class="text-primary fw-bold">
                                                                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                                                    </span>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-medium">{{ $student->first_name }} {{ $student->last_name }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            <span class="badge bg-secondary bg-opacity-20 text-dark rounded-pill px-3">
                                                                {{ $student->program ? $student->program->name : 'N/A' }}
                                                            </span>
                                                        </td>
                                                        <td class="py-3 align-middle">
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-secondary btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                    <i class="fas fa-ellipsis-h"></i>
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="/student/profile/{{$student->id}}"><i class="fas fa-eye me-2"></i>View Profile</a></li>
                                                                    <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                                                    <li><hr class="dropdown-divider"></li>
                                                                    <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Remove</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center py-4">
                                                            <div class="text-muted">
                                                                <i class="fas fa-user-slash fa-2x mb-2"></i>
                                                                <p>No students in this section yet.</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Sections Schedule -->
    <div class="modal fade" id="sectionsScheduleModal" tabindex="-1" aria-labelledby="sectionsScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title" id="sectionsScheduleModalLabel">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Sections Schedule
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    @if($sections->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Sections Found</h5>
                            <p class="text-muted">You don't have any sections assigned yet.</p>
                        </div>
                    @else
                        <div class="row">
                            @foreach ($sections as $section)
                                <div class="col-lg-6 mb-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-header bg-light border-0">
                                            <h6 class="mb-0 fw-bold">
                                                <i class="fas fa-chalkboard me-2 text-primary"></i>
                                                Section {{ $section->section }}
                                            </h6>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="border-0 py-3">
                                                                <small class="text-muted fw-bold text-uppercase">Day</small>
                                                            </th>
                                                            <th class="border-0 py-3">
                                                                <small class="text-muted fw-bold text-uppercase">Time</small>
                                                            </th>
                                                            <th class="border-0 py-3">
                                                                <small class="text-muted fw-bold text-uppercase">Room</small>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-3">
                                                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">Monday</span>
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-clock me-2 text-muted"></i>
                                                                8:00 AM - 9:30 AM
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                                                Room 201
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-3">
                                                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Tuesday</span>
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-clock me-2 text-muted"></i>
                                                                10:00 AM - 11:30 AM
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                                                Room 305
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-3">
                                                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Wednesday</span>
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-clock me-2 text-muted"></i>
                                                                1:00 PM - 2:30 PM
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                                                Room 110
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-3">
                                                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">Thursday</span>
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-clock me-2 text-muted"></i>
                                                                3:00 PM - 4:30 PM
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                                                Room 220
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-3">
                                                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Friday</span>
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-clock me-2 text-muted"></i>
                                                                8:00 AM - 9:30 AM
                                                            </td>
                                                            <td class="py-3">
                                                                <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                                                Room 101
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .welcome-card {
            transition: transform 0.2s ease;
        }
        .welcome-card:hover {
            transform: translateY(-2px);
        }
        
        .stats-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent !important;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .stats-icon {
            transition: all 0.3s ease;
        }
        .stats-card:hover .stats-icon {
            transform: scale(1.1);
        }
        
        .nav-pills .nav-link {
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link:hover {
            transform: translateY(-2px);
        }
        
        .student-row {
            transition: all 0.2s ease;
        }
        .student-row:hover {
            background-color: rgba(0, 123, 255, 0.05) !important;
            transform: translateX(5px);
        }
        
        .avatar-placeholder {
            transition: all 0.3s ease;
        }
        .student-row:hover .avatar-placeholder {
            transform: scale(1.1);
        }
        
        .table th {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .modal-content {
            border-radius: 15px;
        }
        
        .empty-state i {
            opacity: 0.3;
        }
        
        .badge {
            font-weight: 500;
        }
        
        .btn-sm.rounded-pill {
            padding: 0.375rem 1rem;
        }
        
        .dropdown-toggle::after {
            display: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            let timeout = null;

            searchInput.addEventListener('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    performSearch(searchInput.value);
                }, 300); // debounce delay 300ms
            });
        });

        async function performSearch(query) {
            const url = new URL("{{ route('teacher.dashboard.search') }}", window.location.origin);
            url.searchParams.set('search', query);

            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                updateStudentTabs(data.sections);
            } catch (error) {
                console.error('Error fetching search results:', error);
            }
        }

        function updateStudentTabs(sections) {
            const tabsContainer = document.getElementById('dashboardSectionTabs');
            const tabsContentContainer = document.getElementById('dashboardSectionTabsContent');

            // Clear existing tabs and content
            tabsContainer.innerHTML = '';
            tabsContentContainer.innerHTML = '';

            if (sections.length === 0) {
                tabsContentContainer.innerHTML = `
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Students Found</h5>
                            <p class="text-muted">No students found in your sections.</p>
                        </div>
                    </div>
                `;
                return;
            }

            sections.forEach((section, index) => {
                // Create tab button
                const tabButton = document.createElement('button');
                tabButton.className = 'nav-link rounded-pill mx-1' + (index === 0 ? ' active' : '');
                tabButton.id = `dashboard-tab-${section.id}`;
                tabButton.setAttribute('data-bs-toggle', 'tab');
                tabButton.setAttribute('data-bs-target', `#dashboard-section-${section.id}`);
                tabButton.type = 'button';
                tabButton.role = 'tab';
                tabButton.setAttribute('aria-controls', `dashboard-section-${section.id}`);
                tabButton.setAttribute('aria-selected', index === 0 ? 'true' : 'false');
                tabButton.innerHTML = `<i class="fas fa-chalkboard me-2"></i>Section ${section.section} <span class="badge bg-light text-dark ms-2">${section.students.length}</span>`;

                const tabListItem = document.createElement('li');
                tabListItem.className = 'nav-item';
                tabListItem.role = 'presentation';
                tabListItem.appendChild(tabButton);
                tabsContainer.appendChild(tabListItem);

                // Create tab content pane
                const tabPane = document.createElement('div');
                tabPane.className = 'tab-pane fade' + (index === 0 ? ' show active' : '');
                tabPane.id = `dashboard-section-${section.id}`;
                tabPane.role = 'tabpanel';
                tabPane.setAttribute('aria-labelledby', `dashboard-tab-${section.id}`);

                // Build table rows for students
                let rowsHtml = '';
                if (section.students.length === 0) {
                    rowsHtml = `
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-2"></i>
                                    <p>No students in this section yet.</p>
                                </div>
                            </td>
                        </tr>
                    `;
                } else {
                    section.students.forEach((student, studentIndex) => {
                        rowsHtml += `
                            <tr class="student-row">
                                <td class="px-4 py-3 align-middle">
                                    <span class="badge bg-light text-dark rounded-pill">${studentIndex + 1}</span>
                                </td>
                                <td class="py-3 align-middle">
                                    <span class="fw-medium">${student.student_number}</span>
                                </td>
                                <td class="py-3 align-middle">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-placeholder bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <span class="text-primary fw-bold">
                                                ${student.first_name.charAt(0).toUpperCase()}${student.last_name.charAt(0).toUpperCase()}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="fw-medium">${student.first_name} ${student.last_name}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 align-middle">
                                    <span class="badge bg-secondary bg-opacity-20 text-dark rounded-pill px-3">
                                        ${student.program_name}
                                    </span>
                                </td>
                                <td class="py-3 align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>View Profile</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Remove</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                }

                tabPane.innerHTML = `
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 border-0">
                                        <small class="text-muted fw-bold text-uppercase">No.</small>
                                    </th>
                                    <th class="py-3 border-0">
                                        <small class="text-muted fw-bold text-uppercase">Student Number</small>
                                    </th>
                                    <th class="py-3 border-0">
                                        <small class="text-muted fw-bold text-uppercase">Name</small>
                                    </th>
                                    <th class="py-3 border-0">
                                        <small class="text-muted fw-bold text-uppercase">Program</small>
                                    </th>
                                    <th class="py-3 border-0">
                                        <small class="text-muted fw-bold text-uppercase">Actions</small>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                ${rowsHtml}
                            </tbody>
                        </table>
                    </div>
                `;

                tabsContentContainer.appendChild(tabPane);
            });
        }
    </script>

</x-app-layout>
