<x-app-layout>
    <x-page-title header="Document Request" :links="['Request' => '/Request']"/>
    
    <div class="section dashboard">
        <!-- Request Form Card -->
        <div class="card shadow-lg border-0 mb-4" style="border-radius: 15px;">
            <div class="card-header bg-gradient-primary text-white" style="border-radius: 15px 15px 0 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-alt me-3" style="font-size: 1.5rem;"></i>
                    <h4 class="mb-0 fw-bold">Request a Document</h4>
                </div>
                <p class="mb-0 mt-2 opacity-90">Submit your document request and track its progress</p>
            </div>
            
            <div class="card-body p-4">
                <form id="documentRequestForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="document" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-document me-2 text-primary"></i>Document Type
                            </label>
                            <select class="form-select form-select-lg shadow-sm" 
                                    style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;" 
                                    name="document" id="document" required>    
                                <option value="">Choose a document...</option>
                                <option value="Transcript of Records">📜 Transcript of Record (TOR)</option>
                                <option value="grades">🎓 Certificate of Grades (COG)</option>
                                <option value="Certificate of Enrollment">📋 Certificate of Registration (COR)</option>
                                <option value="Certificate of Good Moral">⭐ Certificate of Good Moral</option>
                                <option value="Birth Certificate">🏥 Birth Certificate</option>
                                <option value="Grade evaluation">📊 Grade Evaluation</option>
                                <option value="FORM 137">📝 FORM 137</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label for="date" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>Date Needed
                            </label>
                            <input type="date" 
                                   class="form-control form-control-lg shadow-sm" 
                                   style="border-radius: 10px; border: 2px solid #e9ecef; transition: all 0.3s ease;"
                                   name="date" id="date" required>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-lg px-5 py-3 fw-bold text-white shadow-lg" 
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 50px; transition: all 0.3s ease; transform: translateY(0);">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Requests Table Card -->
        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header bg-light" style="border-radius: 15px 15px 0 0; border-bottom: 3px solid #667eea;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-list-alt me-3 text-primary" style="font-size: 1.5rem;"></i>
                        <h4 class="mb-0 fw-bold text-dark">Your Document Requests</h4>
                    </div>
                    <span class="badge bg-primary fs-6 px-3 py-2" style="border-radius: 20px;">
                        {{ $reqs->total() }} Total
                    </span>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr style="border-bottom: 2px solid #dee2e6;">
                                <th class="fw-bold text-dark py-3 px-4">
                                    <i class="fas fa-file me-2"></i>Document
                                </th>
                                <th class="fw-bold text-dark py-3">
                                    <i class="fas fa-info-circle me-2"></i>Status
                                </th>
                                <th class="fw-bold text-dark py-3">
                                    <i class="fas fa-calendar-plus me-2"></i>Date Requested
                                </th>
                                <th class="fw-bold text-dark py-3">
                                    <i class="fas fa-calendar-check me-2"></i>Date Updated
                                </th>
                                <th class="fw-bold text-dark py-3 text-center">
                                    <i class="fas fa-download me-2"></i>Download
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reqs as $req)
                            <tr class="border-0" style="border-bottom: 1px solid #f1f3f4;">
                                <td class="py-3 px-4">
                                    <div class="fw-semibold text-dark">{{ $req->document }}</div>
                                </td>
                                <td class="py-3">
                                    @php
                                        $statusClass = match($req->status) {
                                            'pending' => 'warning',
                                            'accepted' => 'success',
                                            'rejected' => 'danger',
                                            default => 'secondary'
                                        };
                                        $statusIcon = match($req->status) {
                                            'pending' => 'clock',
                                            'accepted' => 'check-circle',
                                            'rejected' => 'times-circle',
                                            default => 'question-circle'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }} px-3 py-2" style="border-radius: 20px; font-size: 0.85rem;">
                                        <i class="fas fa-{{ $statusIcon }} me-1"></i>{{ ucfirst($req->status) }}
                                    </span>
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $req->created_at ? $req->created_at->format('M d, Y') : '-' }}
                                </td>
                                <td class="py-3 text-muted">
                                    {{ $req->updated_at ? $req->updated_at->format('M d, Y') : '-' }}
                                </td>
                                <td class="py-3 text-center">
                                    @if($req->status === 'accepted' && isset($filePaths[$req->id]) && $filePaths[$req->id])
                                        <a href="{{ url('storage/' . $filePaths[$req->id]) }}" 
                                           class="btn btn-success btn-sm px-3 py-2 shadow-sm" 
                                           style="border-radius: 20px; transition: all 0.3s ease;" 
                                           download>
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                        <h5>No requests found</h5>
                                        <p>Submit your first document request above</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($reqs->hasPages())
                <div class="card-footer bg-light border-0" style="border-radius: 0 0 15px 15px;">
                    {{ $reqs->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        
        .form-select:focus, .form-control:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
            transform: translateY(-2px);
        }
        
        .btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.05) !important;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        
        .card {
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
        
        .badge {
            font-weight: 600 !important;
        }
        
        /* Loading Animation */
        .btn[type="submit"]:disabled {
            background: linear-gradient(135deg, #ccc 0%, #999 100%) !important;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }
            
            .btn-lg {
                padding: 0.75rem 2rem !important;
                font-size: 1rem !important;
            }
            
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        document.getElementById("documentRequestForm").addEventListener("submit", function (event) {
            event.preventDefault(); 

            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

            var formData = new FormData(this);

            fetch("{{ route('student.request.post') }}", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: 'btn btn-primary px-4 py-2'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: "error",
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: 'btn btn-danger px-4 py-2'
                        },
                        buttonsStyling: false
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: "Error!",
                    text: "An unexpected error occurred. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK",
                    customClass: {
                        confirmButton: 'btn btn-danger px-4 py-2'
                    },
                    buttonsStyling: false
                });
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Auto-set minimum date to today
        document.getElementById('date').min = new Date().toISOString().split('T')[0];
    </script>

</x-app-layout>