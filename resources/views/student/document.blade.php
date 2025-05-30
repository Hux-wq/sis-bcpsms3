<x-app-layout>
    <x-page-title header="Document Management" :links="['document' => '/document']"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .document-container {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .enhanced-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .enhanced-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        .card-header-enhanced {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }
        
        .card-header-enhanced.bg-secondary {
            background: linear-gradient(135deg, #64748b, #475569);
        }
        
        .card-header-enhanced.bg-primary {
            background: linear-gradient(135deg, #059669, #047857);
        }
        
        .card-header-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #fbbf24, #f59e0b, #10b981);
        }
        
        .card-title {
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #ffffff;
        }
        
        .upload-zone {
            border: 2px dashed #cbd5e1;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: #f8fafc;
            position: relative;
            overflow: hidden;
            color: #334155;
        }
        
        .upload-zone:hover {
            border-color: #2563eb;
            background: #eff6ff;
            color: #1e40af;
        }
        
        .upload-zone.dragover {
            border-color: #2563eb;
            background: #dbeafe;
            transform: scale(1.02);
            color: #1e40af;
        }
        
        .upload-zone h6 {
            color: #1e293b;
            font-weight: 600;
        }
        
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        
        .file-input-hidden {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0,0,0,0);
            white-space: nowrap;
            border: 0;
        }
        
        .upload-button {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            color: #ffffff;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            cursor: pointer;
        }
        
        .upload-button:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }
        
        .table-enhanced {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: none;
            background: #ffffff;
        }
        
        .table-enhanced thead {
            background: #f8fafc;
            color: #374151;
        }
        
        .table-enhanced thead th {
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .table-enhanced tbody tr {
            transition: all 0.3s ease;
            color: #374151;
        }
        
        .table-enhanced tbody tr:hover {
            background-color: #f9fafb;
            transform: none;
        }
        
        .table-enhanced tbody td {
            color: #374151;
            vertical-align: middle;
        }
        
        .action-button {
            border-radius: 25px;
            padding: 0.4rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .btn-delete {
            background: #dc2626;
            color: #ffffff;
        }
        
        .btn-delete:hover {
            background: #b91c1c;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 38, 38, 0.3);
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fcd34d;
        }
        
        .status-submitted {
            background: #d1fae5;
            color: #047857;
            border: 1px solid #6ee7b7;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
            background: #ffffff;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.6;
            color: #9ca3af;
        }
        
        .empty-state h6 {
            color: #374151;
            font-weight: 600;
        }
        
        .stats-card {
            background: #ffffff;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
        }
        
        .stats-label {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .progress-bar {
            height: 4px;
            background: linear-gradient(90deg, #2563eb, #059669);
            border-radius: 2px;
            margin-top: 1rem;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        
        .file-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        
        /* Text readability improvements */
        .text-muted {
            color: #6b7280 !important;
        }
        
        .card-body {
            color: #374151;
        }
        
        .card-body small {
            color: #6b7280;
        }
        
        /* Badge improvements */
        .badge.bg-light {
            background-color: #f3f4f6 !important;
            color: #374151 !important;
            border: 1px solid #d1d5db;
        }
        
        .badge.bg-info {
            background-color: #dbeafe !important;
            color: #1e40af !important;
            border: 1px solid #93c5fd;
        }
    </style>

    <div class="document-container">
        <div class="container">
            <!-- Stats Row -->
            <div class="row mb-4 fade-in">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ count($files) }}</div>
                        <div class="stats-label">
                            <i class="bi bi-file-earmark-text"></i>
                            Uploaded Documents
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ count($adminRequests) }}</div>
                        <div class="stats-label">
                            <i class="bi bi-clipboard-check"></i>
                            Admin Requests
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="stats-number">{{ count($adminRequests->where('status', 'pending')) }}</div>
                        <div class="stats-label">
                            <i class="bi bi-hourglass-split"></i>
                            Pending Requests
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Document Card -->
            <div class="enhanced-card mb-4 fade-in">
                <div class="card-header-enhanced text-white">
                    <h5 class="card-title">
                        <i class="bi bi-cloud-upload"></i>
                        Upload Document
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form id="uploadFormBC" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-zone" id="uploadZone">
                            <div class="mb-3">
                                <i class="bi bi-file-earmark-arrow-up" style="font-size: 3rem; color: #3b82f6;"></i>
                            </div>
                            <h6 class="mb-2">Drag and drop your PDF here</h6>
                            <p class="text-muted mb-3">or click to browse files</p>
                            
                            <div class="file-input-wrapper">
                                <input type="file" class="file-input-hidden" name="document" id="document" accept="application/pdf">
                                <label for="document" class="upload-button" style="cursor: pointer; margin: 0;">
                                    <i class="bi bi-folder2-open"></i>
                                    Choose File
                                </label>
                            </div>
                            
                            <div class="file-info" id="fileInfo" style="display: none;">
                                <i class="bi bi-file-earmark-pdf"></i>
                                <span id="fileName"></span>
                                <span id="fileSize"></span>
                            </div>
                            
                            <div class="progress-bar" id="progressBar"></div>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i>
                                The document is used to verify student information and ensure data protection.
                            </small>
                        </div>
                        
                        <div class="mt-4 text-center">
                            <button type="submit" class="btn upload-button" id="submitBtn" disabled>
                                <i class="bi bi-upload"></i>
                                Upload Document
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Uploaded Documents Card -->
            <div class="enhanced-card mb-4 fade-in">
                <div class="card-header-enhanced bg-secondary text-white">
                    <h5 class="card-title">
                        <i class="bi bi-files"></i>
                        Your Documents
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(count($files) > 0)
                        <div class="table-responsive">
                            <table class="table table-enhanced mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="bi bi-file-text me-2"></i>File Name</th>
                                        <th><i class="bi bi-calendar me-2"></i>Date Uploaded</th>
                                        <th><i class="bi bi-gear me-2"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                                {{ $file->file_name }}
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($file->created_at)->format('M j, Y \a\t g:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-button btn-delete">
                                                    <i class="bi bi-trash3"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-file-earmark"></i>
                            <h6>No documents uploaded yet</h6>
                            <p>Upload your first document using the form above.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Admin Document Requests Card -->
            <div class="enhanced-card fade-in">
                <div class="card-header-enhanced bg-primary text-white">
                    <h5 class="card-title">
                        <i class="bi bi-clipboard-data"></i>
                        Document Requests
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if(count($adminRequests) > 0)
                        <div class="table-responsive">
                            <table class="table table-enhanced mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><i class="bi bi-file-text me-2"></i>Document</th>
                                        <th><i class="bi bi-file-code me-2"></i>Format</th>
                                        <th><i class="bi bi-files me-2"></i>Copies</th>
                                        <th><i class="bi bi-calendar-event me-2"></i>Due Date</th>
                                        <th><i class="bi bi-flag me-2"></i>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($adminRequests as $index => $request)
                                    <tr>
                                        <td><strong>{{ $index + 1 }}</strong></td>
                                        @php
                                            $pattern = '/^(.*?) \((.*?)\) - Copies: (\d+)$/';
                                            preg_match($pattern, $request->document, $matches);
                                            $fileName = $matches[1] ?? $request->document;
                                            $fileFormat = $matches[2] ?? '';
                                            $copies = $matches[3] ?? '';
                                        @endphp
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-earmark text-primary me-2"></i>
                                                {{ $fileName }}
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light text-dark">{{ $fileFormat }}</span></td>
                                        <td><span class="badge bg-info">{{ $copies }}</span></td>
                                        <td>
                                            <small class="text-muted">
                                                {{ \Carbon\Carbon::parse($request->date_needed)->format('M j, Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            @if(strtolower($request->status) === 'pending')
                                                <span class="status-badge status-pending">
                                                    <i class="bi bi-hourglass-split"></i>
                                                    Pending
                                                </span>
                                            @elseif(strtolower($request->status) === 'submitted')
                                                <span class="status-badge status-submitted">
                                                    <i class="bi bi-check-circle"></i>
                                                    Submitted
                                                </span>
                                            @else
                                                <span class="status-badge bg-secondary text-white">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="bi bi-clipboard-x"></i>
                            <h6>No document requests</h6>
                            <p>You don't have any pending document requests from administrators.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Session messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session("error") }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @endif

        // Drag and drop functionality
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = document.getElementById('document');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileSize = document.getElementById('fileSize');
        const submitBtn = document.getElementById('submitBtn');
        const progressBar = document.getElementById('progressBar');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadZone.addEventListener(eventName, unhighlight, false);
        });

        // Handle dropped files
        uploadZone.addEventListener('drop', handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            uploadZone.classList.add('dragover');
        }

        function unhighlight(e) {
            uploadZone.classList.remove('dragover');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelect();
            }
        }

        // Handle file input change
        fileInput.addEventListener('change', handleFileSelect);

        function handleFileSelect() {
            const file = fileInput.files[0];
            if (file) {
                fileName.textContent = file.name;
                fileSize.textContent = `(${formatFileSize(file.size)})`;
                fileInfo.style.display = 'flex';
                submitBtn.disabled = false;
                
                // Animate progress bar
                progressBar.style.transform = 'scaleX(0.3)';
            } else {
                fileInfo.style.display = 'none';
                submitBtn.disabled = true;
                progressBar.style.transform = 'scaleX(0)';
            }
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Form submission
        document.getElementById('uploadFormBC').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            // Show loading with custom style
            Swal.fire({
                title: 'Uploading Document...',
                html: '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"></div></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-4'
                }
            });
            
            // Animate progress bar to full
            progressBar.style.transform = 'scaleX(1)';
            
            fetch('{{ route("uploadfiles.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Upload Successful!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'rounded-4'
                        }
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Failed',
                        text: data.message,
                        customClass: {
                            popup: 'rounded-4'
                        }
                    });
                    progressBar.style.transform = 'scaleX(0)';
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong: ' + error,
                    customClass: {
                        popup: 'rounded-4'
                    }
                });
                progressBar.style.transform = 'scaleX(0)';
            });
        });

        // Delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Delete Document?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        popup: 'rounded-4'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Add fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    </script>
</x-app-layout>