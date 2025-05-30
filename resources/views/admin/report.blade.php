<x-app-layout>
    <x-page-title header="Reports & Analytics" :links="['Reports' => '/report']"/>
    
    <div class="container-fluid px-4 py-3">
        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-users text-primary fs-2 me-2"></i>
                            <h2 class="mb-0 text-primary fw-bold">{{ $totalStudents ?? '---' }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Total Students</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-graduation-cap text-success fs-2 me-2"></i>
                            <h2 class="mb-0 text-success fw-bold">{{ $activeStudents ?? '---' }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Active Students</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-file-excel text-warning fs-2 me-2"></i>
                            <h2 class="mb-0 text-warning fw-bold">{{ $reportsGenerated ?? '---' }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Reports Generated</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-calendar-alt text-info fs-2 me-2"></i>
                            <h2 class="mb-0 text-info fw-bold">{{ date('Y') }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Current Year</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Quick Export Section -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-download me-2 fs-5"></i>
                            <h4 class="mb-0 fw-bold text-dark">Quick Export</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-file-excel text-success" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Export All Students</h5>
                            <p class="text-muted mb-0">Generate a comprehensive Excel export containing all student records in the system.</p>
                        </div>
                        
                        <div class="bg-light rounded-3 p-3 mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <i class="fas fa-users text-primary mb-2 d-block fs-4"></i>
                                    <small class="text-muted fw-medium">All Records</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-bolt text-warning mb-2 d-block fs-4"></i>
                                    <small class="text-muted fw-medium">Instant Download</small>
                                </div>
                                <div class="col-4">
                                    <i class="fas fa-shield-alt text-success mb-2 d-block fs-4"></i>
                                    <small class="text-muted fw-medium">Secure Export</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <a href="/export-students" class="btn btn-success btn-lg fw-semibold py-3">
                                <i class="fas fa-download me-2"></i>Download All Students
                            </a>
                        </div>
                        
                        <div class="alert alert-info border-0 mt-3 mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            <small>The export will be generated and downloaded automatically in Excel format.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtered Export Section -->
            <div class="col-lg-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-filter me-2 fs-5"></i>
                            <h4 class="mb-0 fw-bold text-dark">Filtered Export</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-search text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">Custom Student Report</h5>
                            <p class="text-muted mb-0">Generate targeted Excel reports by filtering students based on specific criteria.</p>
                        </div>

                        <form action="students/export/filtered" method="GET" id="filteredExportForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="year" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>School Year
                                    </label>
                                    <select class="form-select form-select-lg border-0 bg-light" name="year" id="year">
                                        <option value="2024-2025" selected>2024-2025</option>
                                        <option value="2023-2024">2023-2024</option>
                                        <option value="2022-2023">2022-2023</option>
                                        <option value="2021-2022">2021-2022</option>
                                        <option value="2020-2021">2020-2021</option>
                                        <option value="2019-2020">2019-2020</option>
                                        <option value="2018-2019">2018-2019</option>
                                        <option value="2017-2018">2017-2018</option>
                                        <option value="2016-2017">2016-2017</option>
                                        <option value="2015-2016">2015-2016</option>
                                        <option value="2014-2015">2014-2015</option>
                                        <option value="2013-2014">2013-2014</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="semester" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-clock text-warning me-2"></i>Semester
                                    </label>
                                    <select class="form-select form-select-lg border-0 bg-light" name="semester" id="semester">
                                        <option value="1" selected>1st Semester</option>
                                        <option value="2">2nd Semester</option>
                                    </select>
                                </div>
                                
                                <div class="col-12">
                                    <label for="status" class="form-label fw-semibold text-dark">
                                        <i class="fas fa-user-check text-success me-2"></i>Enrollment Status
                                    </label>
                                    <select class="form-select form-select-lg border-0 bg-light" name="status" id="status">
                                        <option value="regular" selected>Regular</option>
                                        <option value="graduated">Graduated</option>
                                        <option value="failed">Failed</option>
                                        <option value="returnee">Returnee</option>
                                        <option value="transferee">Transferee</option>
                                        <option value="octoberian">Octoberian</option>
                                        <option value="drop out">Drop Out</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg fw-semibold py-3" id="generateBtn">
                                    <i class="fas fa-cog me-2"></i>Generate Custom Report
                                </button>
                            </div>
                        </form>
                        
                        <div class="alert alert-warning border-0 mt-3 mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <small>Report will include only students matching the selected criteria.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Reports Section -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #17a2b8 0%, #6610f2 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-history me-2 fs-5"></i>
                        <h4 class="mb-0 fw-bold text-dark">Export Guidelines</h4>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-start">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-file-excel text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Excel Format</h6>
                                <p class="text-muted mb-0 small">All exports are generated in Excel (.xlsx) format for easy data manipulation.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="d-flex align-items-start">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-shield-alt text-success"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Data Security</h6>
                                <p class="text-muted mb-0 small">Student information is exported securely with proper access controls.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-clock text-warning"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Processing Time</h6>
                                <p class="text-muted mb-0 small">Reports are generated instantly and downloaded automatically.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center p-5">
                    <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;"></div>
                    <h5 class="fw-bold text-dark mb-2">Generating Report...</h5>
                    <p class="text-muted mb-0">Please wait while we prepare your Excel export.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission with loading indicator
            const form = document.getElementById('filteredExportForm');
            const generateBtn = document.getElementById('generateBtn');
            const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));

            form.addEventListener('submit', function(e) {
                // Show loading modal
                loadingModal.show();
                
                // Update button state
                generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
                generateBtn.disabled = true;

                // Simulate processing time and hide modal after download starts
                setTimeout(() => {
                    loadingModal.hide();
                    generateBtn.innerHTML = '<i class="fas fa-cog me-2"></i>Generate Custom Report';
                    generateBtn.disabled = false;
                }, 3000);
            });

            // Quick export button enhancement
            const quickExportBtn = document.querySelector('a[href="/export-students"]');
            if (quickExportBtn) {
                quickExportBtn.addEventListener('click', function(e) {
                    // Show brief loading state
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Preparing Download...';
                    
                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-download me-2"></i>Download All Students';
                    }, 2000);
                });
            }

            // Form validation enhancement
            const selects = form.querySelectorAll('select');
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    this.classList.add('border-primary');
                    setTimeout(() => {
                        this.classList.remove('border-primary');
                    }, 1000);
                });
            });
        });

        // Preview filter selection
        function updatePreview() {
            const year = document.getElementById('year').value;
            const semester = document.getElementById('semester').value;
            const status = document.getElementById('status').value;
            
            // You can add preview functionality here if needed
            console.log('Filter preview:', {year, semester, status});
        }

        // Add change listeners for real-time preview
        document.getElementById('year').addEventListener('change', updatePreview);
        document.getElementById('semester').addEventListener('change', updatePreview);
        document.getElementById('status').addEventListener('change', updatePreview);
    </script>

    <!-- Enhanced Styles -->
    <style>
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }
        
        .btn {
            transition: all 0.2s ease;
        }
        
        .btn:hover {
            transform: translateY(-1px);
        }
        
        .form-select {
            transition: all 0.2s ease;
        }
        
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
            border-color: #6366f1;
        }
        
        .bg-gradient {
            background-image: linear-gradient(180deg, rgba(255,255,255,0.15), rgba(255,255,255,0));
        }
        
        .alert {
            border-radius: 0.75rem;
        }
        
        .spinner-border {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .form-label {
            font-size: 0.95rem;
        }
        
        .border-primary {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 0.1rem rgba(99, 102, 241, 0.25);
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }
            
            .btn-lg {
                padding: 0.75rem 1rem;
                font-size: 1rem;
            }
        }
    </style>
</x-app-layout>