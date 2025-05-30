<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-page-title header="Document Management" :links="['Documents' => '/document']"/>

    <div class="container-fluid px-4 py-3">
        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-file-alt text-primary fs-2 me-2"></i>
                            <h2 class="mb-0 text-primary fw-bold">{{ count($files) }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Total Documents</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-file-pdf text-success fs-2 me-2"></i>
                            <h2 class="mb-0 text-success fw-bold">{{ $files->where('readable_type', 'PDF')->count() }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">PDF Files</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-database text-info fs-2 me-2"></i>
                            <h2 class="mb-0 text-info fw-bold">{{ round($files->sum('file_size')/1024, 1) }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Total Size (MB)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-calendar-day text-warning fs-2 me-2"></i>
                            <h2 class="mb-0 text-warning fw-bold">{{ $files->where('created_at', '>=', now()->startOfDay())->count() }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Today's Uploads</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Document Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-folder-open me-2 fs-5"></i>
                        <h4 class="mb-0 fw-bold">Document Library</h4>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-white text-primary fs-6">{{ count($files) }} files</span>
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="filterTable('all')">All Files</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterTable('PDF')">PDF Only</a></li>
                                <li><a class="dropdown-item" href="#" onclick="filterTable('today')">Today's Uploads</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-muted fw-semibold py-3 px-4">ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student Info</th>
                                <th class="border-0 text-muted fw-semibold py-3">File Details</th>
                                <th class="border-0 text-muted fw-semibold py-3">Type & Size</th>
                                <th class="border-0 text-muted fw-semibold py-3">Upload Date</th>
                                <th class="border-0 text-muted fw-semibold py-3 text-center">Preview</th>
                                <th class="border-0 text-muted fw-semibold py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($files as $file)
                            <tr class="border-bottom file-row" data-type="{{ $file->readable_type }}" data-date="{{ $file->created_at->format('Y-m-d') }}">
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">#{{ $file->id }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-gradient rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold text-dark">{{ \App\Helpers\UserHelper::GetUserName($file->student_id) }}</div>
                                            <small class="text-muted">ID: {{ \App\Helpers\UserHelper::GetStudentNumber($file->student_id) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div>
                                        <div class="fw-medium text-dark mb-1">{{ $file->file_name }}</div>
                                        @if($file->file_for)
                                        <span class="badge bg-info bg-opacity-10 text-info text-capitalize">{{ $file->file_for }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($file->readable_type == 'PDF')
                                            <i class="fas fa-file-pdf text-danger fs-4"></i>
                                        @else
                                            <i class="fas fa-file-alt text-secondary fs-4"></i>
                                        @endif
                                        <div>
                                            <div class="fw-medium">{{ $file->readable_type }}</div>
                                            <small class="text-muted">{{ number_format($file->file_size) }} KB</small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $file->created_at->format('M d, Y') }}
                                        <br>
                                        <small class="text-muted">{{ $file->created_at->format('h:i A') }}</small>
                                    </div>
                                </td>
                                <td class="py-3 text-center">
                                    <button type="button" class="btn btn-outline-primary btn-sm px-3 py-2" 
                                            data-bs-toggle="modal" data-bs-target="#file{{ $file->id }}"
                                            title="Preview Document">
                                        <i class="fas fa-eye me-1"></i>Preview
                                    </button>
                                </td>
                                <td class="py-3 text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                                    <i class="fas fa-download me-2"></i>Download
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <button class="dropdown-item text-danger delete-button" 
                                                        onclick="confirmDelete({{ $file->id }})">
                                                    <i class="fas fa-trash me-2"></i>Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <!-- Hidden delete form -->
                                    <form id="delete-form-{{ $file->id }}" action="{{ route('files.destroy', $file->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Enhanced Modal -->
                            <div class="modal fade" id="file{{ $file->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header bg-gradient text-white py-3" 
                                             style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-pdf me-2 fs-5"></i>
                                                <div>
                                                    <h5 class="modal-title mb-0 fw-bold text-capitalize">{{ $file->file_for ?? 'Document Preview' }}</h5>
                                                    <small class="opacity-75">{{ $file->file_name }}</small>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <div class="d-flex justify-content-between align-items-center p-3 bg-light border-bottom">
                                                <div class="d-flex align-items-center gap-3">
                                                    <span class="badge bg-primary">{{ $file->readable_type }}</span>
                                                    <span class="text-muted">Size: {{ number_format($file->file_size) }} KB</span>
                                                    <span class="text-muted">Uploaded: {{ $file->created_at->format('M d, Y h:i A') }}</span>
                                                </div>
                                                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-external-link-alt me-1"></i>Open in New Tab
                                                </a>
                                            </div>
                                            <div class="pdf-container">
                                                <embed src="{{ asset('storage/' . $file->file_path) }}" 
                                                       type="application/pdf" 
                                                       width="100%" 
                                                       height="600px"
                                                       style="border: none;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fs-1 mb-3 d-block text-muted opacity-50"></i>
                                    <h5 class="mb-2">No Documents Found</h5>
                                    <p class="mb-0">No documents have been uploaded yet.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Notifications -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session("success") }}',
                    confirmButtonText: 'Great!',
                    confirmButtonColor: '#28a745',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            });
        </script>
    @elseif(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session("error") }}',
                    confirmButtonText: 'Understood',
                    confirmButtonColor: '#dc3545',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            });
        </script>
    @endif

    <!-- Custom JavaScript -->
    <script>
        // Enhanced delete confirmation
        function confirmDelete(fileId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This document will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + fileId).submit();
                }
            });
        }

        // Filter functionality
        function filterTable(type) {
            const rows = document.querySelectorAll('.file-row');
            const today = new Date().toISOString().split('T')[0];
            
            rows.forEach(row => {
                const fileType = row.getAttribute('data-type');
                const fileDate = row.getAttribute('data-date');
                
                let show = false;
                
                switch(type) {
                    case 'all':
                        show = true;
                        break;
                    case 'PDF':
                        show = fileType === 'PDF';
                        break;
                    case 'today':
                        show = fileDate === today;
                        break;
                }
                
                row.style.display = show ? '' : 'none';
            });
            
            // Update active filter button
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function () {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <!-- Enhanced Styles -->
    <style>
        .table th {
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }
        
        .table td {
            vertical-align: middle;
        }
        
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
        
        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .bg-gradient {
            background-image: linear-gradient(180deg, rgba(255,255,255,0.15), rgba(255,255,255,0));
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }
        
        .modal-xl .modal-dialog {
            max-width: 90%;
        }
        
        .pdf-container {
            background: #f8f9fa;
            padding: 1rem;
        }
        
        .dropdown-item.active {
            background-color: #e9ecef;
            color: #495057;
        }
        
        .file-row {
            transition: all 0.2s ease;
        }
        
        .file-row:hover {
            background-color: rgba(99, 102, 241, 0.05);
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .modal-xl .modal-dialog {
                max-width: 95%;
                margin: 0.5rem auto;
            }
            
            .pdf-container embed {
                height: 400px !important;
            }
        }
        
        /* Loading animation for embeds */
        embed {
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="20" fill="none" stroke="%23007bff" stroke-width="4" stroke-dasharray="31.416" stroke-dashoffset="31.416"><animate attributeName="stroke-dasharray" dur="2s" values="0 31.416;15.708 15.708;0 31.416" repeatCount="indefinite"/><animate attributeName="stroke-dashoffset" dur="2s" values="0;-15.708;-31.416" repeatCount="indefinite"/></circle></svg>') center center no-repeat;
            background-size: 50px 50px;
        }
    </style>
</x-app-layout>