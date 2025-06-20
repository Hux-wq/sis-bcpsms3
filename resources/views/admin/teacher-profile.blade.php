<x-app-layout>

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Teacher Information Card -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-gradient-primary text-white text-center py-4">
                    <div class="avatar-container mb-3">
                        <div class="avatar-circle bg-white text-primary d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px; border-radius: 50%; font-size: 2rem; font-weight: bold;">
                            {{ strtoupper(substr($teacher->name, 0, 2)) }}
                        </div>
                    </div>
                    <h2 class="h4 mb-1">{{ $teacher->name }}</h2>
                    <p class="mb-0 opacity-90">Teacher Profile</p>
                </div>
                
                <div class="card-body p-4">
                    <div class="teacher-details">
                        <div class="detail-item mb-3 p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-envelope-fill text-primary me-3 fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Email Address</small>
                                    <span class="fw-medium">{{ $teacher->email }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item mb-3 p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge-fill text-success me-3 fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Teacher ID</small>
                                    <span class="fw-medium">#{{ str_pad($teacher->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item mb-3 p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-event-fill text-info me-3 fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Join Date</small>
                                    <span class="fw-medium">{{ $teacher->created_at ? $teacher->created_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="detail-item p-3 bg-light rounded-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-diagram-3-fill text-warning me-3 fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Total Sections</small>
                                <span class="fw-medium fs-5 text-primary">{{ $sections->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent p-4">
                    <a href="#" class="btn btn-outline-primary w-100">
                        <i class="bi bi-pencil-square me-2"></i>Edit Profile
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Sections Handled Card -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-header bg-gradient-dark text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h5 mb-0">
                            <i class="bi bi-grid-3x3-gap-fill me-2"></i>Sections Handled
                        </h3>
                        <span class="badge bg-light text-dark">{{ $sections->count() }} Section(s)</span>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($academicRecords->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                            <h4 class="text-muted mt-3">No Sections Assigned</h4>
                            <p class="text-muted">This teacher has not been assigned to any sections yet.</p>
                        </div>
                    @else
                        @php
                            $groupedRecords = $academicRecords->groupBy(['year_level', 'semester']);
                            // Paginate the academic records - assuming you pass paginated data from controller
                            // $paginatedRecords = $academicRecords; // This should be paginated in the controller
                        @endphp
                        
                        <!-- Filters and Search -->
                        <div class="p-4 bg-light border-bottom">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-search text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0" 
                                               placeholder="Search sections..." id="sectionSearch">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="yearFilter">
                                        <option value="">All Year Levels</option>
                                        @foreach($academicRecords->pluck('year_level')->unique()->sort() as $year)
                                            <option value="{{ $year }}">Year {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="semesterFilter">
                                        <option value="">All Semesters</option>
                                        @foreach($academicRecords->pluck('semester')->unique()->sort() as $semester)
                                            <option value="{{ $semester }}">Semester {{ $semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-select" id="perPageSelect">
                                        <option value="5" selected>5 per page</option>
                                        <option value="10" >10 per page</option>
                                        <option value="25">25 per page</option>
                                        <option value="50">50 per page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-hash me-1"></i>Year Level
                                                <button class="btn btn-sm ms-2 sort-btn" data-sort="year_level">
                                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-diagram-2 me-1"></i>Section
                                                <button class="btn btn-sm ms-2 sort-btn" data-sort="section">
                                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar3 me-1"></i>Semester
                                                <button class="btn btn-sm ms-2 sort-btn" data-sort="semester">
                                                    <i class="bi bi-arrow-down-up text-muted"></i>
                                                </button>
                                            </div>
                                        </th>
                                        <th class="px-4 py-3"><i class="bi bi-people-fill me-1"></i>Students</th>
                                        <th class="px-4 py-3"><i class="bi bi-gear-fill me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="sectionsTableBody">
                                    @foreach($academicRecords as $record)
                                        <tr class="section-row" 
                                            data-year="{{ $record->year_level }}" 
                                            data-semester="{{ $record->semester }}"
                                            data-section="{{ strtolower($record->section->section) }}">
                                            <td class="px-4 py-3">
                                                <span class="badge bg-primary rounded-pill fs-6">
                                                    {{ $record->year_level }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="section-icon bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                                         style="width: 35px; height: 35px;">
                                                        <i class="bi bi-collection text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-bold text-dark">{{ $record->section->section }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <span class="badge bg-success rounded-pill">
                                                    Semester {{ $record->semester }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-people text-muted me-2"></i>
                                                    <span class="text-muted">{{ $record->section->students_count ?? 'N/A' }} students</span>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary" title="View Details">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary" title="Manage Students">
                                                        <i class="bi bi-people"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Custom Pagination -->
                        <div class="p-4 bg-light border-top">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center text-muted">
                                        <span id="showingText">Showing 1 to 10 of {{ $sections->count() }} sections</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <nav aria-label="Sections pagination">
                                        <ul class="pagination justify-content-end mb-0" id="customPagination">
                                            <!-- Pagination will be generated by JavaScript -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Summary Cards -->
                        <div class="p-4 bg-light border-top">
                            <div class="row g-3">
                                @php
                                    $yearLevels = $academicRecords->pluck('year_level')->unique();
                                    $semesters = $academicRecords->pluck('semester')->unique();
                                @endphp
                                
                                <div class="col-md-4">
                                    <div class="stats-card text-center p-3 bg-white rounded-3 shadow-sm">
                                        <i class="bi bi-layers text-primary fs-3"></i>
                                        <h4 class="mt-2 mb-1 text-primary">{{ $yearLevels->count() }}</h4>
                                        <small class="text-muted">Year Levels</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="stats-card text-center p-3 bg-white rounded-3 shadow-sm">
                                        <i class="bi bi-calendar-range text-success fs-3"></i>
                                        <h4 class="mt-2 mb-1 text-success">{{ $semesters->count() }}</h4>
                                        <small class="text-muted">Semesters</small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="stats-card text-center p-3 bg-white rounded-3 shadow-sm">
                                        <i class="bi bi-diagram-3 text-warning fs-3"></i>
                                        <h4 class="mt-2 mb-1 text-warning">{{ $sections->count() }}</h4>
                                        <small class="text-muted">Total Sections</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-dark {
    background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
}

.section-row:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

.stats-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.detail-item {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.detail-item:hover {
    background-color: #e3f2fd !important;
    border-color: #2196f3 !important;
}

.avatar-circle {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.table th {
    font-weight: 600;
    border-bottom: 2px solid #e9ecef;
    background-color: #f8f9fa;
}

.section-icon {
    transition: all 0.3s ease;
}

.section-row:hover .section-icon {
    background-color: #e3f2fd !important;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.sort-btn {
    border: none;
    background: none;
    padding: 0;
    margin: 0;
}

.sort-btn:hover i {
    color: #0d6efd !important;
}

.page-link {
    color: #0d6efd;
    border: 1px solid #dee2e6;
    padding: 0.5rem 0.75rem;
}

.page-link:hover {
    background-color: #e9ecef;
    border-color: #dee2e6;
    color: #0a58ca;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.page-item.disabled .page-link {
    color: #6c757d;
    background-color: #fff;
    border-color: #dee2e6;
}

.input-group-text {
    background-color: #fff;
    border-color: #ced4da;
}

.form-control:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
</style>

@if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
@endif

<script>
// Pagination and filtering functionality
class SectionsPagination {
    constructor() {
        this.currentPage = 1;
        this.perPage = 5;
        this.allRows = [];
        this.filteredRows = [];
        this.sortOrder = { column: '', direction: 'asc' };
        
        this.init();
    }
    
    init() {
        this.allRows = Array.from(document.querySelectorAll('#sectionsTableBody .section-row'));
        this.filteredRows = [...this.allRows];
        
        this.setupEventListeners();
        this.updateDisplay();
    }
    
    setupEventListeners() {
        // Search functionality
        document.getElementById('sectionSearch').addEventListener('input', (e) => {
            this.filterData();
        });
        
        // Filter dropdowns
        document.getElementById('yearFilter').addEventListener('change', () => {
            this.filterData();
        });
        
        document.getElementById('semesterFilter').addEventListener('change', () => {
            this.filterData();
        });
        
        // Per page selector
        document.getElementById('perPageSelect').addEventListener('change', (e) => {
            this.perPage = parseInt(e.target.value);
            this.currentPage = 1;
            this.updateDisplay();
        });
        
        // Sort buttons
        document.querySelectorAll('.sort-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const column = e.currentTarget.getAttribute('data-sort');
                this.sortData(column);
            });
        });
    }
    
    filterData() {
        const searchTerm = document.getElementById('sectionSearch').value.toLowerCase();
        const yearFilter = document.getElementById('yearFilter').value;
        const semesterFilter = document.getElementById('semesterFilter').value;
        
        this.filteredRows = this.allRows.filter(row => {
            const sectionText = row.getAttribute('data-section');
            const year = row.getAttribute('data-year');
            const semester = row.getAttribute('data-semester');
            
            const matchesSearch = sectionText.includes(searchTerm);
            const matchesYear = !yearFilter || year === yearFilter;
            const matchesSemester = !semesterFilter || semester === semesterFilter;
            
            return matchesSearch && matchesYear && matchesSemester;
        });
        
        this.currentPage = 1;
        this.updateDisplay();
    }
    
    sortData(column) {
        if (this.sortOrder.column === column) {
            this.sortOrder.direction = this.sortOrder.direction === 'asc' ? 'desc' : 'asc';
        } else {
            this.sortOrder.column = column;
            this.sortOrder.direction = 'asc';
        }
        
        this.filteredRows.sort((a, b) => {
            let aValue, bValue;
            
            switch (column) {
                case 'year_level':
                    aValue = parseInt(a.getAttribute('data-year'));
                    bValue = parseInt(b.getAttribute('data-year'));
                    break;
                case 'section':
                    aValue = a.getAttribute('data-section');
                    bValue = b.getAttribute('data-section');
                    break;
                case 'semester':
                    aValue = parseInt(a.getAttribute('data-semester'));
                    bValue = parseInt(b.getAttribute('data-semester'));
                    break;
                default:
                    return 0;
            }
            
            if (aValue < bValue) return this.sortOrder.direction === 'asc' ? -1 : 1;
            if (aValue > bValue) return this.sortOrder.direction === 'asc' ? 1 : -1;
            return 0;
        });
        
        // Update sort button icons
        document.querySelectorAll('.sort-btn i').forEach(icon => {
            icon.className = 'bi bi-arrow-down-up text-muted';
        });
        
        const activeBtn = document.querySelector(`[data-sort="${column}"] i`);
        if (activeBtn) {
            activeBtn.className = this.sortOrder.direction === 'asc' 
                ? 'bi bi-sort-up text-primary' 
                : 'bi bi-sort-down text-primary';
        }
        
        this.updateDisplay();
    }
    
    updateDisplay() {
        const start = (this.currentPage - 1) * this.perPage;
        const end = start + this.perPage;
        const pageRows = this.filteredRows.slice(start, end);
        
        // Hide all rows
        this.allRows.forEach(row => row.style.display = 'none');
        
        // Show current page rows
        pageRows.forEach(row => row.style.display = '');
        
        // Update showing text
        const total = this.filteredRows.length;
        const showingStart = total === 0 ? 0 : start + 1;
        const showingEnd = Math.min(end, total);
        
        document.getElementById('showingText').textContent = 
            `Showing ${showingStart} to ${showingEnd} of ${total} sections`;
        
        // Update pagination
        this.updatePagination();
    }
    
    updatePagination() {
        const totalPages = Math.ceil(this.filteredRows.length / this.perPage);
        const pagination = document.getElementById('customPagination');
        
        if (totalPages <= 1) {
            pagination.innerHTML = '';
            return;
        }
        
        let paginationHTML = '';
        
        // Previous button
        paginationHTML += `
            <li class="page-item ${this.currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${this.currentPage - 1}">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        `;
        
        // Page numbers
        const startPage = Math.max(1, this.currentPage - 2);
        const endPage = Math.min(totalPages, this.currentPage + 2);
        
        if (startPage > 1) {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`;
            if (startPage > 2) {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
        }
        
        for (let i = startPage; i <= endPage; i++) {
            paginationHTML += `
                <li class="page-item ${i === this.currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
        }
        
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`;
        }
        
        // Next button
        paginationHTML += `
            <li class="page-item ${this.currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" data-page="${this.currentPage + 1}">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        `;
        
        pagination.innerHTML = paginationHTML;
        
        // Add click event listeners to pagination links
        pagination.querySelectorAll('a[data-page]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = parseInt(e.currentTarget.getAttribute('data-page'));
                if (page >= 1 && page <= totalPages && page !== this.currentPage) {
                    this.currentPage = page;
                    this.updateDisplay();
                }
            });
        });
    }
}

// Initialize pagination when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize pagination if there are sections
    if (document.querySelector('#sectionsTableBody')) {
        new SectionsPagination();
    }
    
    // Auto-hide toast after 5 seconds
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toast => {
        setTimeout(() => {
            const bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
        }, 5000);
    });
});

// Add smooth scroll effect for better UX
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>
</x-app-layout>