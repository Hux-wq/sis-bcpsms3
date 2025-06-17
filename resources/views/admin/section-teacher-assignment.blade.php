<x-app-layout>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<div class="bg-light min-vh-100 py-4">
    <div class="container">
        <!-- Header Card -->
        <div class="card shadow-lg border-0 mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 fw-bold text-primary mb-2">
                            <i class="fas fa-users-cog me-3"></i>Section Management
                        </h1>
                        <p class="lead text-muted mb-0">Assign teachers as section advisers</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-chalkboard-teacher text-white fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-start">
                    <i class="fas fa-exclamation-triangle text-danger me-3 mt-1"></i>
                    <div>
                        <h6 class="alert-heading mb-2">Please fix the following errors:</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter and Search Controls -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.section-teacher-assignment.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-semibold">
                            <i class="fas fa-search text-primary me-2"></i>Search Sections
                        </label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Search by section name...">
                    </div>
                    <div class="col-md-3">
                        <label for="adviser_filter" class="form-label fw-semibold">
                            <i class="fas fa-filter text-primary me-2"></i>Filter by Status
                        </label>
                        <select name="adviser_filter" id="adviser_filter" class="form-select">
                            <option value="">All Sections</option>
                            <option value="assigned" {{ request('adviser_filter') == 'assigned' ? 'selected' : '' }}>
                                Assigned Only
                            </option>
                            <option value="unassigned" {{ request('adviser_filter') == 'unassigned' ? 'selected' : '' }}>
                                Unassigned Only
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="per_page" class="form-label fw-semibold">
                            <i class="fas fa-list-ol text-primary me-2"></i>Per Page
                        </label>
                        <select name="per_page" id="per_page" class="form-select">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search me-2"></i>Filter
                            </button>
                            <a href="{{ route('admin.section-teacher-assignment.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo me-2"></i>Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="card shadow-lg border-0">
            <!-- Card Header -->
            <div class="card-header bg-primary bg-gradient text-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0">
                            <i class="fas fa-list-alt me-2"></i>Section Assignments
                        </h4>
                        <small class="opacity-75">Manage teacher assignments for each section</small>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-light text-primary fs-6">
                                @if(method_exists($sections, 'total'))
                                    {{ $sections->total() }} Total Section{{ $sections->total() !== 1 ? 's' : '' }}
                                @else
                                    {{ $sections->count() }} Section{{ $sections->count() !== 1 ? 's' : '' }}
                                @endif
                            </span>
                            @if(method_exists($sections, 'hasPages') && $sections->hasPages())
                                <span class="badge bg-white bg-opacity-25 fs-6">
                                    Page {{ $sections->currentPage() }} of {{ $sections->lastPage() }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body p-0">
                @if($sections->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3 border-0">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary me-2">ID</span>
                                            <span class="fw-semibold">Section</span>
                                        </div>
                                    </th>
                                    <th class="px-4 py-3 border-0">
                                        <i class="fas fa-graduation-cap text-primary me-2"></i>
                                        <span class="fw-semibold">Section Name</span>
                                    </th>
                                    <th class="px-4 py-3 border-0">
                                        <i class="fas fa-user-tie text-success me-2"></i>
                                        <span class="fw-semibold">Current Adviser</span>
                                    </th>
                                    <th class="px-4 py-3 border-0">
                                        <i class="fas fa-user-plus text-warning me-2"></i>
                                        <span class="fw-semibold">Assign New Adviser</span>
                                    </th>
                                    <th class="px-4 py-3 border-0 text-center">
                                        <i class="fas fa-cogs text-secondary me-2"></i>
                                        <span class="fw-semibold">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sections as $section)
                                <tr class="align-middle">
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-primary bg-gradient px-3 py-2 fs-6 me-3">
                                                {{ $section->id }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-info bg-gradient text-white fw-bold" style="width: 45px; height: 45px;">
                                                {{ strtoupper(substr($section->section, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ $section->section }}</h6>
                                                <small class="text-muted">Section Code</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($section->adviserUser)
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-success" style="width: 35px; height: 35px;">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-success">{{ $section->adviserUser->name }}</h6>
                                                    <span class="badge bg-success-subtle text-success">
                                                        <i class="fas fa-check-circle me-1"></i>Assigned
                                                    </span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 bg-secondary" style="width: 35px; height: 35px;">
                                                    <i class="fas fa-user-slash text-white"></i>
                                                </div>
                                                <div>
                                                    <span class="badge bg-warning-subtle text-warning">
                                                        <i class="fas fa-exclamation-triangle me-1"></i>No Adviser
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <form method="POST" action="{{ route('admin.section-teacher-assignment.update', $section->id) }}" class="assignment-form">
                                            @csrf
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0">
                                                    <i class="fas fa-user-tie text-primary"></i>
                                                </span>
                                                <select name="adviser" class="form-select border-start-0" style="min-width: 200px;">
                                                    <option value="">-- Select Teacher --</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}" {{ $section->adviser == $teacher->id ? 'selected' : '' }}>
                                                            {{ $teacher->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm px-4 py-2">
                                                <i class="fas fa-save me-2"></i>Save Assignment
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($sections, 'hasPages') && $sections->hasPages())
                        <div class="card-footer bg-light border-0">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <span>
                                            Showing {{ $sections->firstItem() }} to {{ $sections->lastItem() }} 
                                            of {{ $sections->total() }} results
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end">
                                        {{ $sections->appends(request()->query())->links('pagination::bootstrap-4') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            @if(request()->filled('search') || request()->filled('adviser_filter'))
                                <i class="fas fa-search text-muted" style="font-size: 4rem;"></i>
                            @else
                                <i class="fas fa-folder-open text-muted" style="font-size: 4rem;"></i>
                            @endif
                        </div>
                        @if(request()->filled('search') || request()->filled('adviser_filter'))
                            <h4 class="text-muted mb-2">No Matching Sections Found</h4>
                            <p class="text-muted mb-3">Try adjusting your search criteria or filters.</p>
                            <a href="{{ route('admin.section-teacher-assignment.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-undo me-2"></i>Clear Filters
                            </a>
                        @else
                            <h4 class="text-muted mb-2">No Sections Found</h4>
                            <p class="text-muted">Get started by creating a new section.</p>
                            <button class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Section
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-primary bg-gradient d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Total Sections</h5>
                        <h3 class="text-primary mb-0">
                            @if(isset($totalSections))
                                {{ $totalSections }}
                            @elseif(method_exists($sections, 'total'))
                                {{ $sections->total() }}
                            @else
                                {{ $sections->count() }}
                            @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-success bg-gradient d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-check-circle text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Assigned Sections</h5>
                        <h3 class="text-success mb-0">{{ $assignedCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-warning bg-gradient d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-exclamation-triangle text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Unassigned Sections</h5>
                        <h3 class="text-warning mb-0">{{ $unassignedCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <div class="rounded-circle bg-info bg-gradient d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-percentage text-white fs-4"></i>
                        </div>
                        <h5 class="card-title">Assignment Rate</h5>
                        <h3 class="text-info mb-0">
                            {{ $totalSections > 0 ? round(($assignedCount / $totalSections) * 100) : 0 }}%
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Auto-submit form on per_page change
    document.getElementById('per_page').addEventListener('change', function() {
        this.closest('form').submit();
    });

    // SweetAlert for success messages - Enhanced version
    @if(session('success'))
        // Clear any existing SweetAlert instances first
        if (Swal.isVisible()) {
            Swal.close();
        }
        
        // Wait a moment then show the new alert
        setTimeout(() => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#d1edff',
                color: '#0c63e4',
                iconColor: '#198754',
                customClass: {
                    popup: 'swal-toast-custom shadow-lg'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}'
            });
        }, 100);
    @endif

    // Form submission handling
    const forms = document.querySelectorAll('.assignment-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const select = this.querySelector('select[name="adviser"]');
            const selectedOption = select.options[select.selectedIndex];
            const sectionName = this.closest('tr').querySelector('h6').textContent;
            
            if (select.value === '') {
                Swal.fire({
                    title: 'Please Select a Teacher',
                    text: 'You must select a teacher before saving the assignment.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ffc107',
                    customClass: {
                        popup: 'shadow-lg',
                        confirmButton: 'btn btn-warning px-4'
                    }
                });
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'Confirm Assignment',
                html: `
                    <div class="text-start">
                        <p class="mb-2"><strong>Section:</strong> ${sectionName}</p>
                        <p class="mb-2"><strong>New Adviser:</strong> ${selectedOption.text}</p>
                        <p class="text-muted mb-0">Are you sure you want to make this assignment?</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-check me-2"></i>Yes, Assign!',
                cancelButtonText: '<i class="fas fa-times me-2"></i>Cancel',
                backdrop: 'rgba(13, 110, 253, 0.1)',
                customClass: {
                    popup: 'shadow-lg',
                    confirmButton: 'btn btn-primary px-4',
                    cancelButton: 'btn btn-secondary px-4'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Processing Assignment...',
                        html: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'shadow-lg'
                        }
                    });
                    
                    // Submit the form
                    this.submit();
                }
            });
        });
    });

    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
            this.style.transform = 'translateX(5px)';
            this.style.transition = 'all 0.3s ease';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
            this.style.transform = 'translateX(0)';
        });
    });

    // Keyboard navigation for pagination
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey || e.metaKey) {
            const prevLink = document.querySelector('.pagination .page-link[rel="prev"]');
            const nextLink = document.querySelector('.pagination .page-link[rel="next"]');
            
            if (e.key === 'ArrowLeft' && prevLink) {
                e.preventDefault();
                prevLink.click();
            } else if (e.key === 'ArrowRight' && nextLink) {
                e.preventDefault();
                nextLink.click();
            }
        }
    });
});
</script>

<style>
/* Custom styles for enhanced design */
.card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.table-responsive {
    border-radius: 0 0 15px 15px;
}

.btn {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.badge {
    border-radius: 8px;
}

.input-group .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.bg-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
}

.animate__faster {
    animation-duration: 0.5s;
}

/* Pagination Styles */
.pagination {
    margin-bottom: 0;
}

.page-link {
    border-radius: 8px;
    margin: 0 2px;
    border: 1px solid #dee2e6;
    color: #6c757d;
    transition: all 0.3s ease;
}

.page-link:hover {
    background-color: #e9ecef;
    border-color: #adb5bd;
    color: #495057;
    transform: translateY(-1px);
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.3);
}

.page-item.disabled .page-link {
    color: #adb5bd;
    pointer-events: none;
    background-color: #fff;
    border-color: #dee2e6;
}

/* Enhanced Filter Card */
.card-body form .form-label {
    color: #495057;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.form-control:focus,
.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

/* SweetAlert Custom Styles */
.swal-toast-custom {
    border-radius: 12px !important;
    border-left: 4px solid #198754 !important;
}

.swal2-toast {
    box-sizing: border-box;
    border: none !important;
    border-radius: 12px !important;
}

.swal2-toast .swal2-title {
    margin: 0.5em 1em;
    padding: 0;
    font-size: 16px;
    text-align: initial;
}

.swal2-toast .swal2-content {
    margin: 0.5em 1em;
    padding: 0;
    font-size: 14px;
    text-align: initial;
}

/* Force SweetAlert to disappear */
.swal2-container {
    pointer-events: auto !important;
}

/* Smooth scrollbar */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f3f4;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c8cd;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a8b3ba;
}

/* Loading animation */
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.loading {
    animation: pulse 1.5s ease-in-out infinite;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-footer .row {
        text-align: center;
    }
    
    .card-footer .col-md-6:first-child {
        margin-bottom: 1rem;
    }
    
    .pagination {
        justify-content: center;
    }
}
</style>
</x-app-layout>