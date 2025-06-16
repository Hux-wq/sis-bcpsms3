<x-app-layout>

@section('content')
<div class="container-fluid py-4" style="background-color: #f8f9fa;">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1 text-dark fw-bold">Predictive Analytics Dashboard</h2>
                            <p class="text-muted mb-0">Student Performance Breakdown & Analysis</p>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-chart-bar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded p-2">
                                <i class="fas fa-arrow-trend-up text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small">High Performers</p>
                            <h4 class="mb-0 fw-bold" id="high-performers">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded p-2">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small">At Risk</p>
                            <h4 class="mb-0 fw-bold" id="at-risk">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded p-2">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small">Total Students</p>
                            <h4 class="mb-0 fw-bold" id="total-students">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded p-2">
                                <i class="fas fa-chart-line text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-muted mb-1 small">Avg Grade</p>
                            <h4 class="mb-0 fw-bold" id="avg-grade">-</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label small fw-semibold text-muted">Search Students</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-start-0" 
                                       placeholder="Search by name or student number...">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-semibold text-muted">Filter by Category</label>
                            <select id="categoryFilter" class="form-select">
                                <option value="">All Categories</option>
                                <option value="High Performer">High Performer</option>
                                <option value="Average">Average</option>
                                <option value="At Risk">At Risk</option>
                                <option value="Fail">Fail</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold">Student Performance Data</h5>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="border-0 py-3">#</th>
                                    <th class="border-0 py-3">Student Number</th>
                                    <th class="border-0 py-3">Student Name</th>
                                    <th class="border-0 py-3">Average Grade</th>
                                    <th class="border-0 py-3">Category</th>
                                </tr>
                            </thead>
                            <tbody id="student-breakdown-body">
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="spinner-border text-primary mb-3" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="text-muted mb-0">Loading student data...</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="card-footer bg-light border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span id="totalRecords">0</span> results
                        </div>
                        <nav aria-label="Table pagination">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item" id="prevPageItem">
                                    <button class="page-link" id="prevPage" disabled>
                                        <i class="fas fa-chevron-left me-1"></i>Previous
                                    </button>
                                </li>
                                <li class="page-item">
                                    <span class="page-link bg-primary text-white" id="pageInfo">1 of 1</span>
                                </li>
                                <li class="page-item" id="nextPageItem">
                                    <button class="page-link" id="nextPage" disabled>
                                        Next<i class="fas fa-chevron-right ms-1"></i>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let currentPage = 1;
        const rowsPerPage = 10;
        let originalData = [];
        let filteredData = [];

        const tbody = document.getElementById('student-breakdown-body');
        const prevBtn = document.getElementById('prevPage');
        const nextBtn = document.getElementById('nextPage');
        const prevPageItem = document.getElementById('prevPageItem');
        const nextPageItem = document.getElementById('nextPageItem');
        const pageInfo = document.getElementById('pageInfo');
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');

        function getCategoryBadge(category) {
            const badges = {
                'High Performer': '<span class="badge bg-success">High Performer</span>',
                'Average': '<span class="badge bg-primary">Average</span>',
                'At Risk': '<span class="badge bg-warning">At Risk</span>',
                'Fail': '<span class="badge bg-danger">Fail</span>'
            };
            return badges[category] || '<span class="badge bg-secondary">' + category + '</span>';
        }

        function getGradeClass(grade) {
            if (grade == 0.0) return 'text-danger fw-bold';
            if (grade <= 1.5) return 'text-success fw-semibold'; 
            if (grade <= 2.75) return 'text-primary fw-semibold';
            if (grade > 2.75 && grade <= 3.0) return 'text-warning fw-semibold';
            if (grade > 3.0) return 'text-danger fw-semibold';
            return 'text-danger fw-semibold';
        }

            function updateStats(data) {
                const highPerformers = data.filter(s => s.average_grade <= 1.5 && s.average_grade !== 0.0).length;
                const atRisk = data.filter(s => s.average_grade > 2.75 && s.average_grade <= 3.0).length;
                const totalStudents = data.length;
                const avgGrade = totalStudents > 0 ? data.reduce((sum, s) => sum + s.average_grade, 0) / totalStudents : 0;

                document.getElementById('high-performers').textContent = highPerformers;
                document.getElementById('at-risk').textContent = atRisk;
                document.getElementById('total-students').textContent = totalStudents;
                document.getElementById('avg-grade').textContent = avgGrade.toFixed(1);
            }

        function renderTablePage(page) {
            tbody.innerHTML = '';
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const pageData = filteredData.slice(start, end);

            if (pageData.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-search text-muted mb-3" style="font-size: 2rem;"></i>
                                <h6 class="text-muted">No students found</h6>
                                <p class="text-muted small mb-0">Try adjusting your search or filter criteria</p>
                            </div>
                        </td>
                    </tr>
                `;
                updatePagination(0, 0);
                return;
            }

            pageData.forEach((student, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="py-3">${start + index + 1}</td>
                    <td class="py-3 fw-medium">${student.student_number}</td>
                    <td class="py-3">${student.student_name}</td>
                    <td class="py-3 ${getGradeClass(student.average_grade)}">${student.average_grade.toFixed(2)}</td>
                    <td class="py-3">${getCategoryBadge(student.category)}</td>
                `;
                tbody.appendChild(tr);
            });

            updatePagination(filteredData.length, page);

            // Update showing records info
            const showingStart = filteredData.length === 0 ? 0 : start + 1;
            const showingEnd = Math.min(end, filteredData.length);
            document.getElementById('showingStart').textContent = showingStart;
            document.getElementById('showingEnd').textContent = showingEnd;
            document.getElementById('totalRecords').textContent = filteredData.length;
        }

        function updatePagination(totalRecords, currentPageNum) {
            const totalPages = Math.ceil(totalRecords / rowsPerPage);
            
            pageInfo.textContent = `${currentPageNum} of ${totalPages}`;
            
            prevBtn.disabled = currentPageNum === 1 || totalPages === 0;
            nextBtn.disabled = currentPageNum === totalPages || totalPages === 0;
            
            prevPageItem.classList.toggle('disabled', prevBtn.disabled);
            nextPageItem.classList.toggle('disabled', nextBtn.disabled);
        }

        function filterData() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const categoryTerm = categoryFilter.value;

            filteredData = originalData.filter(student => {
                const matchesSearch = !searchTerm || 
                    student.student_name.toLowerCase().includes(searchTerm) || 
                    student.student_number.toLowerCase().includes(searchTerm);
                const matchesCategory = !categoryTerm || student.category === categoryTerm;
                return matchesSearch && matchesCategory;
            });

            currentPage = 1;
            renderTablePage(currentPage);
        }

        // Function to handle search and filter explicitly
        function handleSearchAndFilter() {
            filterData();
        }

        // Event listeners
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                renderTablePage(currentPage);
            }
        });

        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (currentPage < Math.ceil(filteredData.length / rowsPerPage)) {
                currentPage++;
                renderTablePage(currentPage);
            }
        });

        searchInput.addEventListener('input', handleSearchAndFilter);
        categoryFilter.addEventListener('input', handleSearchAndFilter);

        // Load data
        fetch('/predictive-analytics')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(jsonData => {
                originalData = jsonData;
                filteredData = [...originalData];
                updateStats(originalData);
                renderTablePage(currentPage);
            })
            .catch(error => {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="fas fa-exclamation-circle text-danger mb-3" style="font-size: 2rem;"></i>
                                <h6 class="text-danger">Failed to load data</h6>
                                <p class="text-muted small mb-3">Please try refreshing the page</p>
                                <button class="btn btn-outline-primary btn-sm" onclick="location.reload()">
                                    <i class="fas fa-refresh me-1"></i>Retry
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                console.error('Error loading predictive analytics data:', error);
            });
    });
</script>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>