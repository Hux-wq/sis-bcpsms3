<x-app-layout>
    <x-page-title header="Input Student Grades" :links="['teacher.dashboard' => '/teacher/dashboard']"/>

    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white">
                        <h5 class="card-title mb-0 d-flex align-items-center">
                            <i class="fas fa-graduation-cap me-2"></i>
                            Grade Management System
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <!-- Enhanced Tab Navigation -->
                        <div class="mb-4">
                            <ul class="nav nav-pills nav-fill bg-light rounded p-1" id="gradeSectionTabs" role="tablist">
                                @foreach ($sections as $index => $section)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link rounded @if($index == 0) active @endif" 
                                            id="grade-tab-{{ $section->id }}" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#grade-section-{{ $section->id }}" 
                                            type="button" 
                                            role="tab" 
                                            aria-controls="grade-section-{{ $section->id }}" 
                                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                                        <i class="fas fa-users me-1"></i>
                                        Section {{ $section->section }}
                                        <span class="badge bg-primary ms-2">{{ count($section->students) }}</span>
                                    </button>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content" id="gradeSectionTabsContent">
                            @foreach ($sections as $index => $section)
                            <div class="tab-pane fade @if($index == 0) show active @endif" 
                                 id="grade-section-{{ $section->id }}" 
                                 role="tabpanel" 
                                 aria-labelledby="grade-tab-{{ $section->id }}">
                                
                                <!-- Enhanced Search Bar -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                            <input type="text" 
                                                   id="studentSearchInput-{{ $section->id }}" 
                                                   onkeyup="filterStudents({{ $section->id }})" 
                                                   class="form-control border-start-0 ps-0" 
                                                   placeholder="Search by name or student number...">
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <span class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Total Students: <strong>{{ count($section->students) }}</strong>
                                        </span>
                                    </div>
                                </div>

                                <!-- Enhanced Student Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="studentTable-{{ $section->id }}">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col" class="text-center" style="width: 60px;">
                                                    <i class="fas fa-hashtag"></i>
                                                </th>
                                                <th scope="col">
                                                    <i class="fas fa-id-card me-1"></i>
                                                    Student Number
                                                </th>
                                                <th scope="col">
                                                    <i class="fas fa-user me-1"></i>
                                                    Student Name
                                                </th>
                                                <th scope="col" class="text-center" style="width: 150px;">
                                                    <i class="fas fa-cogs me-1"></i>
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($section->students as $studentIndex => $student)
                                            <tr class="student-row" data-student-name="{{ strtolower($student->last_name . ', ' . $student->first_name) }}" data-student-number="{{ strtolower($student->student_number ?? '') }}">
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark rounded-pill">{{ $studentIndex + 1 }}</span>
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">{{ $student->student_number ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-gradient-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                            {{ substr($student->first_name, 0, 1) }}{{ substr($student->last_name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <span class="fw-medium">{{ $student->last_name }}, {{ $student->first_name }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-primary btn-sm px-3 py-2 rounded-pill shadow-sm" 
                                                            onclick="showGradeModal({{ $student->id }}, '{{ addslashes($student->last_name . ', ' . $student->first_name) }}')"
                                                            data-bs-toggle="tooltip" 
                                                            title="Input grade for {{ $student->first_name }}">
                                                        <i class="fas fa-plus me-1"></i>
                                                        Input Grade
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Empty State -->
                                <div id="emptyState-{{ $section->id }}" class="text-center py-5 d-none">
                                    <i class="fas fa-search text-muted" style="font-size: 3rem;"></i>
                                    <h5 class="text-muted mt-3">No students found</h5>
                                    <p class="text-muted">Try adjusting your search criteria</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Grade Input Modal -->
    <div class="modal fade" id="gradeInputModal" tabindex="-1" aria-labelledby="gradeInputModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" action="{{ route('teacher.grades.store') }}" id="gradeForm">
                @csrf
                <input type="hidden" name="student_id" id="modal_student_id" />
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-gradient-success text-white border-0">
                        <h5 class="modal-title d-flex align-items-center" id="gradeInputModalLabel">
                            <i class="fas fa-award me-2"></i>
                            Input Grade for <span id="modal_student_name" class="fw-bold ms-1"></span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <label for="subject" class="form-label fw-medium">
                                    <i class="fas fa-book me-1 text-primary"></i>
                                    Subject
                                </label>
                                <select class="form-select form-select-lg" id="subject" name="subject" required>
                                    <option value="" disabled selected>Choose a subject...</option>
                                    <option value="Calculus">📊 Calculus</option>
                                    <option value="Physics">⚛️ Physics</option>
                                    <option value="Chemistry">🧪 Chemistry</option>
                                    <option value="Literature">📚 Literature</option>
                                    <option value="Philosophy">🤔 Philosophy</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="grade" class="form-label fw-medium">
                                    <i class="fas fa-star me-1 text-warning"></i>
                                    Grade
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="grade" 
                                       name="grade" 
                                       placeholder="Enter grade (e.g., 95, A+, Excellent)" 
                                       required />
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Enter numerical grade, letter grade, or descriptive assessment
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="submit" class="btn btn-success btn-lg px-4 me-2">
                            <i class="fas fa-check me-1"></i>
                            Submit Grade
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Custom Styles for Enhanced UX */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .nav-pills .nav-link {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .nav-pills .nav-link:hover {
            background-color: #e9ecef;
            transform: translateY(-1px);
        }
        
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        
        .btn {
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .card {
            transition: all 0.3s ease;
        }
        
        .avatar {
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .modal-content {
            border-radius: 15px;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.5px;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
            border-color: #dee2e6;
        }
        
        .student-row {
            transition: all 0.2s ease;
        }
        
        .badge {
            font-size: 0.75rem;
        }
        
        @media (max-width: 768px) {
            .nav-pills {
                flex-direction: column;
            }
            
            .nav-pills .nav-link {
                margin-bottom: 0.5rem;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>

    <script>
        // Enhanced grade modal function
        function showGradeModal(studentId, studentName) {
            const modal = new bootstrap.Modal(document.getElementById('gradeInputModal'));
            document.getElementById('modal_student_id').value = studentId;
            document.getElementById('modal_student_name').textContent = studentName;
            document.getElementById('subject').value = "";
            document.getElementById('grade').value = "";
            
            // Focus on subject field when modal opens
            modal.show();
            setTimeout(() => {
                document.getElementById('subject').focus();
            }, 500);
        }

        // Enhanced search function with empty state handling
        function filterStudents(sectionId) {
            const input = document.getElementById("studentSearchInput-" + sectionId);
            const filter = input.value.toUpperCase();
            const table = document.getElementById("studentTable-" + sectionId);
            const rows = table.getElementsByTagName("tr");
            const emptyState = document.getElementById("emptyState-" + sectionId);
            let visibleCount = 0;
            
            for (let i = 1; i < rows.length; i++) {
                const nameCell = rows[i].getElementsByTagName("td")[2];
                const numberCell = rows[i].getElementsByTagName("td")[1];
                
                if (nameCell && numberCell) {
                    const nameText = nameCell.textContent || nameCell.innerText;
                    const numberText = numberCell.textContent || numberCell.innerText;
                    
                    if (nameText.toUpperCase().indexOf(filter) > -1 || 
                        numberText.toUpperCase().indexOf(filter) > -1) {
                        rows[i].style.display = "";
                        visibleCount++;
                    } else {
                        rows[i].style.display = "none";
                    }
                }
            }
            
            // Show/hide empty state
            if (visibleCount === 0 && filter !== "") {
                table.style.display = "none";
                emptyState.classList.remove("d-none");
            } else {
                table.style.display = "";
                emptyState.classList.add("d-none");
            }
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Add form validation
            const form = document.getElementById('gradeForm');
            form.addEventListener('submit', function(e) {
                const subject = document.getElementById('subject').value;
                const grade = document.getElementById('grade').value;
                
                if (!subject || !grade) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                    return false;
                }
            });
        });

        // Add smooth scrolling and animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate table rows on load
            const rows = document.querySelectorAll('.student-row');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });
    </script>
</x-app-layout>