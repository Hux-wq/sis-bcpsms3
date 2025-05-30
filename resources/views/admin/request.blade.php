<x-app-layout>
    <x-page-title header="Request Management" :links="['Request' => '/Request']"/>

    <div class="container-fluid px-4 py-3">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-clock text-warning fs-2 me-2"></i>
                            <h2 class="mb-0 text-warning fw-bold">{{ count($pendingReqs) }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Pending Requests</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-check-circle text-success fs-2 me-2"></i>
                            <h2 class="mb-0 text-success fw-bold">{{ count($acceptedReqs) }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Accepted Requests</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-danger bg-opacity-10">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center mb-2">
                            <i class="fas fa-times-circle text-danger fs-2 me-2"></i>
                            <h2 class="mb-0 text-danger fw-bold">{{ count($declinedReqs) }}</h2>
                        </div>
                        <p class="text-muted mb-0 fw-medium">Declined Requests</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-clock me-2 fs-5"></i>
                    <h4 class="mb-0 fw-bold">Pending Requests</h4>
                    <span class="badge bg-white text-warning ms-auto fs-6">{{ count($pendingReqs) }} items</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="pending-requests" class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-muted fw-semibold py-3 px-4">ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student Name</th>
                                <th class="border-0 text-muted fw-semibold py-3">Document</th>
                                <th class="border-0 text-muted fw-semibold py-3">Status</th>
                                <th class="border-0 text-muted fw-semibold py-3">Date Requested</th>
                                <th class="border-0 text-muted fw-semibold py-3">Date Needed</th>
                                <th class="border-0 text-muted fw-semibold py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingReqs as $req)
                            <tr class="border-bottom">
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">#{{ $req->id }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="fw-medium text-dark">{{ \App\Helpers\UserHelper::GetStudentNumber($req->student_id) }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <span class="fw-medium">{{ \App\Helpers\UserHelper::GetUserName($req->student_id) }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-info bg-opacity-10 text-info text-capitalize fw-medium px-3 py-2">{{ $req->document }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-warning text-dark fw-medium px-3 py-2">{{ $req->status }}</span>
                                </td>
                                <td class="py-3 text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $req->created_at ? $req->created_at->format('M d, Y') : '-' }}
                                </td>
                                <td class="py-3 text-muted">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    {{ $req->date_needed ?? '-' }}
                                </td>
                                <td class="py-3 text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <form action="{{ route('admin.requests.approve', $req->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm px-3 py-2 fw-medium" title="Approve Request">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.requests.decline', $req->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm px-3 py-2 fw-medium" title="Decline Request">
                                                <i class="fas fa-times me-1"></i>Decline
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fs-1 mb-3 d-block text-muted opacity-50"></i>
                                    <p class="mb-0 fs-5">No pending requests found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pendingReqs->hasPages())
                <div class="card-footer bg-light border-0">
                    {{ $pendingReqs->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>

        <!-- Accepted Requests Section -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2 fs-5"></i>
                    <h4 class="mb-0 fw-bold">Accepted Requests</h4>
                    <span class="badge bg-white text-success ms-auto fs-6">{{ count($acceptedReqs) }} items</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="accepted-requests" class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-muted fw-semibold py-3 px-4">ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student Name</th>
                                <th class="border-0 text-muted fw-semibold py-3">Document</th>
                                <th class="border-0 text-muted fw-semibold py-3">Status</th>
                                <th class="border-0 text-muted fw-semibold py-3">Date Requested</th>
                                <th class="border-0 text-muted fw-semibold py-3">Date Needed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($acceptedReqs as $req)
                            <tr class="border-bottom">
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">#{{ $req->id }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="fw-medium text-dark">{{ \App\Helpers\UserHelper::GetStudentNumber($req->student_id) }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user text-success"></i>
                                        </div>
                                        <span class="fw-medium">{{ \App\Helpers\UserHelper::GetUserName($req->student_id) }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-info bg-opacity-10 text-info text-capitalize fw-medium px-3 py-2">{{ $req->document }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-success fw-medium px-3 py-2">{{ $req->status }}</span>
                                </td>
                                <td class="py-3 text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $req->created_at ? $req->created_at->format('M d, Y') : '-' }}
                                </td>
                                <td class="py-3 text-muted">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    {{ $req->date_needed ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-check-circle fs-1 mb-3 d-block text-success opacity-50"></i>
                                    <p class="mb-0 fs-5">No accepted requests found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($acceptedReqs->hasPages())
                <div class="card-footer bg-light border-0">
                    {{ $acceptedReqs->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>

        <!-- Declined Requests Section -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-gradient text-white py-3" style="background: linear-gradient(135deg, #dc3545 0%, #e74c3c 100%);">
                <div class="d-flex align-items-center">
                    <i class="fas fa-times-circle me-2 fs-5"></i>
                    <h4 class="mb-0 fw-bold">Declined Requests</h4>
                    <span class="badge bg-white text-danger ms-auto fs-6">{{ count($declinedReqs) }} items</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="declined-requests" class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 text-muted fw-semibold py-3 px-4">ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student ID</th>
                                <th class="border-0 text-muted fw-semibold py-3">Student Name</th>
                                <th class="border-0 text-muted fw-semibold py-3">Document</th>
                                <th class="border-0 text-muted fw-semibold py-3">Status</th>
                                <th class="border-0 text-muted fw-semibold py-3">Date Requested</th>
                                <th class="border-0 text-muted fw-semibold py-3">Date Needed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($declinedReqs as $req)
                            <tr class="border-bottom">
                                <td class="px-4 py-3">
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium">#{{ $req->id }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="fw-medium text-dark">{{ \App\Helpers\UserHelper::GetStudentNumber($req->student_id) }}</span>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user text-danger"></i>
                                        </div>
                                        <span class="fw-medium">{{ \App\Helpers\UserHelper::GetUserName($req->student_id) }}</span>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-info bg-opacity-10 text-info text-capitalize fw-medium px-3 py-2">{{ $req->document }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="badge bg-danger fw-medium px-3 py-2">{{ $req->status }}</span>
                                </td>
                                <td class="py-3 text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $req->created_at ? $req->created_at->format('M d, Y') : '-' }}
                                </td>
                                <td class="py-3 text-muted">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    {{ $req->date_needed ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-times-circle fs-1 mb-3 d-block text-danger opacity-50"></i>
                                    <p class="mb-0 fs-5">No declined requests found</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($declinedReqs->hasPages())
                <div class="card-footer bg-light border-0">
                    {{ $declinedReqs->links('pagination::bootstrap-5') }}
                </div>
                @endif
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
                text: '{{ session('success') }}',
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
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: '{{ session('error') }}',
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

    <!-- Additional Styles -->
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
        
        @media (max-width: 768px) {
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.5rem !important;
            }
            
            .btn-sm {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
</x-app-layout>