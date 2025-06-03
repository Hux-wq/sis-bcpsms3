<x-app-layout>
    <x-page-title header="Input Student Attendance" :links="['teacher.dashboard' => '/teacher/dashboard']"/>

    <section class="section">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card attendance-header border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body text-white p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="mb-1">Student Attendance</h3>
                                <p class="mb-0 opacity-75">Mark attendance for your students across all sections</p>
                            </div>
                            <div class="d-none d-md-block">
                                <i class="fas fa-clipboard-check fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="mb-1 fw-bold">Mark Attendance</h5>
                                <p class="text-muted mb-0">Select date and mark attendance for each student</p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="attendance-stats d-flex justify-content-end gap-3">
                                    <div class="stat-item">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">
                                            <i class="fas fa-check me-1"></i>
                                            <span id="present-count">0</span> Present
                                        </span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">
                                            <i class="fas fa-times me-1"></i>
                                            <span id="absent-count">0</span> Absent
                                        </span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>
                                            <span id="late-count">0</span> Late
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('teacher.attendance.store') }}">
                            @csrf
                            <input type="hidden" name="section_id" id="current-section-id" value="{{ $sections[0]->id ?? '' }}">
                            <!-- Controls Section -->
                            <div class="controls-section mb-4 p-4 bg-light rounded-3">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label for="attendance-date" class="form-label fw-medium">
                                            <i class="fas fa-calendar me-2 text-primary"></i>
                                            Select Date
                                        </label>
                                        <input type="date" id="attendance-date" name="attendance_date" 
                                               class="form-control form-control-lg rounded-pill shadow-sm" 
                                               value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="student-search" class="form-label fw-medium">
                                            <i class="fas fa-search me-2 text-primary"></i>
                                            Search Students
                                        </label>
                                        <div class="input-group">
                                            <input type="text" id="student-search" 
                                                   class="form-control form-control-lg rounded-start-pill shadow-sm" 
                                                   placeholder="Search by name or student number...">
                                            <button class="btn btn-outline-primary rounded-end-pill" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-secondary rounded-pill flex-fill" id="clear-all">
                                                <i class="fas fa-eraser me-1"></i>
                                                Clear All
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sections Navigation -->
                            <div class="sections-nav mb-4">
                                <ul class="nav nav-pills nav-fill" id="sectionTabs" role="tablist">
                                    @foreach ($sections as $index => $section)
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill mx-1 @if($index == 0) active @endif" 
                                                id="tab-{{ $section->id }}" 
                                                data-bs-toggle="tab" 
                                                data-bs-target="#section-{{ $section->id }}" 
                                                type="button" 
                                                role="tab" 
                                                aria-controls="section-{{ $section->id }}" 
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
                            <div class="tab-content" id="sectionTabsContent">
                                @foreach ($sections as $index => $section)
                                <div class="tab-pane fade @if($index == 0) show active @endif" 
                                     id="section-{{ $section->id }}" 
                                     role="tabpanel" 
                                     aria-labelledby="tab-{{ $section->id }}">

                                    <!-- Quick Actions for Section -->
                                    <div class="section-controls mb-4 p-3 bg-primary bg-opacity-5 rounded-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <h6 class="mb-0 fw-bold text-primary">
                                                    <i class="fas fa-users me-2"></i>
                                                    Section {{ $section->section }} - Quick Mark All
                                                </h6>
                                                <small class="text-muted">Select an option to mark all students in this section</small>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="d-flex gap-2 justify-content-md-end">
                                                    <button type="button" class="btn btn-success btn-sm rounded-pill select-all-present" data-section-id="{{ $section->id }}">
                                                        <i class="fas fa-check me-1"></i>
                                                        All Present
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm rounded-pill select-all-absent" data-section-id="{{ $section->id }}">
                                                        <i class="fas fa-times me-1"></i>
                                                        All Absent
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm rounded-pill select-all-late" data-section-id="{{ $section->id }}">
                                                        <i class="fas fa-clock me-1"></i>
                                                        All Late
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Students Table -->
                                    <div class="table-responsive">
                                        <table class="table attendance-table mb-0" id="attendance-table-{{ $section->id }}">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="px-4 py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">No.</small>
                                                    </th>
                                                    <th class="py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">Student Number</small>
                                                    </th>
                                                    <th class="py-3 border-0">
                                                        <small class="text-muted fw-bold text-uppercase">Student Name</small>
                                                    </th>
                                                    <th class="py-3 border-0 text-center" style="min-width: 300px;">
                                                        <small class="text-muted fw-bold text-uppercase">Attendance Status</small>
                                                    </th>
                                                    <th class="py-3 border-0 text-center" style="min-width: 200px;">
                                                        <small class="text-muted fw-bold text-uppercase">Course/Subject</small>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($section->students as $studentIndex => $student)
                                                <tr class="student-row" data-student-id="{{ $student->id }}">
                                                    <td class="px-4 py-3 align-middle">
                                                        <span class="badge bg-light text-dark rounded-pill">{{ $studentIndex + 1 }}</span>
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        <span class="fw-medium">{{ $student->student_number ?? 'N/A' }}</span>
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-placeholder bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                                                <span class="text-primary fw-bold">
                                                                    {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                                                </span>
                                                            </div>
                                                            <div>
                                                                <div class="fw-medium">{{ $student->last_name }}, {{ $student->first_name }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        <div class="attendance-options d-flex justify-content-center gap-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input attendance-radio-{{ $section->id }}" 
                                                                       type="radio" 
                                                                       name="attendance_status[{{ $student->id }}]" 
                                                                       id="present-{{ $student->id }}" 
                                                                       value="present" 
                                                                       required>
                                                                <label class="form-check-label attendance-label present-label" for="present-{{ $student->id }}">
                                                                    <i class="fas fa-check me-1"></i>
                                                                    Present
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input attendance-radio-{{ $section->id }}" 
                                                                       type="radio" 
                                                                       name="attendance_status[{{ $student->id }}]" 
                                                                       id="absent-{{ $student->id }}" 
                                                                       value="absent" 
                                                                       required>
                                                                <label class="form-check-label attendance-label absent-label" for="absent-{{ $student->id }}">
                                                                    <i class="fas fa-times me-1"></i>
                                                                    Absent
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input attendance-radio-{{ $section->id }}" 
                                                                       type="radio" 
                                                                       name="attendance_status[{{ $student->id }}]" 
                                                                       id="late-{{ $student->id }}" 
                                                                       value="late" 
                                                                       required>
                                                                <label class="form-check-label attendance-label late-label" for="late-{{ $student->id }}">
                                                                    <i class="fas fa-clock me-1"></i>
                                                                    Late
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="py-3 align-middle">
                                                        <select name="course_selection[{{ $student->id }}]" class="form-select form-select-sm" required>
                                                            <option value="" disabled selected>Select Course</option>
                                                            @if(isset($coursesByProgram[$student->program_id]))
                                                                @foreach($coursesByProgram[$student->program_id] as $course)
                                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                                @endforeach
                                                            @else
                                                                <option value="" disabled>No courses available</option>
                                                            @endif
                                                        </select>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-5">
                                                        <div class="text-muted">
                                                            <i class="fas fa-user-slash fa-3x mb-3"></i>
                                                            <h6>No Students Found</h6>
                                                            <p>No students are enrolled in this section.</p>
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

                            <!-- Submit Section -->
                            <div class="submit-section mt-5 p-4 bg-light rounded-3">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="mb-1 fw-bold">Ready to Submit?</h6>
                                        <p class="text-muted mb-0">Make sure all students have their attendance marked before submitting.</p>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <div class="d-flex gap-2 justify-content-md-end">
                                            <button type="button" class="btn btn-outline-secondary rounded-pill">
                                                <i class="fas fa-eye me-1"></i>
                                                Preview
                                            </button>
                                            <button type="button" class="btn btn-success rounded-pill px-4" id="submit-attendance-btn">
                                                <i class="fas fa-paper-plane me-1"></i>
                                                Submit Attendance
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .attendance-header {
            transition: transform 0.2s ease;
        }
        .attendance-header:hover {
            transform: translateY(-2px);
        }

        .controls-section {
            transition: all 0.3s ease;
        }

        .section-controls {
            border-left: 4px solid var(--bs-primary);
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .nav-pills .nav-link:hover {
            transform: translateY(-2px);
            border-color: var(--bs-primary);
        }
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: transparent;
        }

        .student-row {
            transition: all 0.2s ease;
        }
        .student-row:hover {
            background-color: rgba(0, 123, 255, 0.05) !important;
        }

        .attendance-options {
            gap: 1rem;
        }

        .form-check-input:checked + .attendance-label.present-label {
            color: var(--bs-success);
            font-weight: 600;
        }
        .form-check-input:checked + .attendance-label.absent-label {
            color: var(--bs-danger);
            font-weight: 600;
        }
        .form-check-input:checked + .attendance-label.late-label {
            color: var(--bs-warning);
            font-weight: 600;
        }

        .attendance-label {
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            font-weight: 500;
        }

        .attendance-label:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .form-check-input:checked + .present-label {
            background-color: rgba(25, 135, 84, 0.1);
            border-color: var(--bs-success);
        }
        .form-check-input:checked + .absent-label {
            background-color: rgba(220, 53, 69, 0.1);
            border-color: var(--bs-danger);
        }
        .form-check-input:checked + .late-label {
            background-color: rgba(255, 193, 7, 0.1);
            border-color: var(--bs-warning);
        }

        .avatar-placeholder {
            transition: all 0.3s ease;
        }
        .student-row:hover .avatar-placeholder {
            transform: scale(1.1);
        }

        .attendance-stats .stat-item {
            transition: all 0.3s ease;
        }
        .attendance-stats .stat-item:hover {
            transform: scale(1.05);
        }

        .submit-section {
            border-left: 4px solid var(--bs-success);
        }

        .table th {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn.rounded-pill {
            padding: 0.5rem 1.5rem;
        }

        .form-control-lg.rounded-pill {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
        }

        .input-group .form-control.rounded-start-pill {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }

        .input-group .btn.rounded-end-pill {
            border-top-right-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        @media (max-width: 768px) {
            .attendance-options {
                flex-direction: column;
                gap: 0.5rem;
            }
            .attendance-stats {
                flex-direction: column;
                gap: 0.5rem;
            }
            .controls-section .row > div {
                margin-bottom: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Counter variables
            let presentCount = 0;
            let absentCount = 0;
            let lateCount = 0;

            // Update counters
            function updateCounters() {
                document.getElementById('present-count').textContent = presentCount;
                document.getElementById('absent-count').textContent = absentCount;
                document.getElementById('late-count').textContent = lateCount;
            }

            // Count attendance changes
            function handleAttendanceChange(radio) {
                const studentRow = radio.closest('.student-row');
                const previousValue = studentRow.dataset.currentAttendance;
                const newValue = radio.value;

                // Remove previous count
                if (previousValue === 'present') presentCount--;
                if (previousValue === 'absent') absentCount--;
                if (previousValue === 'late') lateCount--;

                // Add new count
                if (newValue === 'present') presentCount++;
                if (newValue === 'absent') absentCount++;
                if (newValue === 'late') lateCount++;

                // Update dataset
                studentRow.dataset.currentAttendance = newValue;
                updateCounters();
            }

            // Select all functionality
            function selectAllForSection(sectionId, status) {
                document.querySelectorAll('.attendance-radio-' + sectionId).forEach(radio => {
                    if (radio.value === status) {
                        const wasChecked = radio.checked;
                        radio.checked = true;
                        if (!wasChecked) {
                            handleAttendanceChange(radio);
                        }
                    }
                });
            }

            // Button event listeners
            document.querySelectorAll('.select-all-present').forEach(button => {
                button.addEventListener('click', function () {
                    const sectionId = this.dataset.sectionId;
                    selectAllForSection(sectionId, 'present');
                });
            });

            document.querySelectorAll('.select-all-absent').forEach(button => {
                button.addEventListener('click', function () {
                    const sectionId = this.dataset.sectionId;
                    selectAllForSection(sectionId, 'absent');
                });
            });

            document.querySelectorAll('.select-all-late').forEach(button => {
                button.addEventListener('click', function () {
                    const sectionId = this.dataset.sectionId;
                    selectAllForSection(sectionId, 'late');
                });
            });

            // Individual radio button changes
            document.querySelectorAll('input[type="radio"][name^="attendance_status"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    handleAttendanceChange(this);
                });
            });

            // Clear all functionality
            document.getElementById('clear-all').addEventListener('click', function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to clear all attendance selections?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear all!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.querySelectorAll('input[type="radio"][name^="attendance_status"]').forEach(radio => {
                            radio.checked = false;
                        });
                        presentCount = 0;
                        absentCount = 0;
                        lateCount = 0;
                        updateCounters();
                        
                        // Clear dataset
                        document.querySelectorAll('.student-row').forEach(row => {
                            delete row.dataset.currentAttendance;
                        });
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('student-search');
            const tables = document.querySelectorAll('table[id^="attendance-table-"]');
            
            searchInput.addEventListener('input', function () {
                const filter = this.value.toLowerCase();
                tables.forEach(table => {
                    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (let i = 0; i < rows.length; i++) {
                        const studentNumber = rows[i].cells[1].textContent.toLowerCase();
                        const studentName = rows[i].cells[2].textContent.toLowerCase();
                        if (studentNumber.includes(filter) || studentName.includes(filter)) {
                            rows[i].style.display = '';
                        } else {
                            rows[i].style.display = 'none';
                        }
                    }
                });
            });


            // Form submission validation moved to submit button click with SweetAlert
            document.getElementById('submit-attendance-btn').addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('form');
                const currentSectionId = document.getElementById('current-section-id').value;
                const allRadios = form.querySelectorAll('.attendance-radio-' + currentSectionId);
                const checkedRadios = form.querySelectorAll('.attendance-radio-' + currentSectionId + ':checked');
                const studentCount = allRadios.length / 3; // 3 radio buttons per student

                if (checkedRadios.length < studentCount) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incomplete',
                        text: 'Please mark attendance for all students in the selected section before submitting.',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to submit this attendance record?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Show success message if present in session
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Initialize counters
            updateCounters();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
