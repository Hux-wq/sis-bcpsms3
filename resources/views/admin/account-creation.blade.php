<x-app-layout>
    <x-page-title header="Account Creation" :links="['account.creation' => '/account-creation']"/>
    
    <section class="section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <!-- Success/Error Messages -->
                    <div id="alerts-container"></div>
                    
                    <!-- Teacher Account Creation Form -->
                    <div class="card shadow-sm mb-5 border-0 rounded-lg">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Create Teacher Account</h4>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.teacher.account.create') }}" class="needs-validation" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="teacher_name" class="form-label fw-bold">Full Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" class="form-control" id="teacher_name" name="teacher_name" 
                                                placeholder="Enter full name" required>
                                        </div>
                                        <div class="invalid-feedback">Please provide a name.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="teacher_email" class="form-label fw-bold">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" class="form-control" id="teacher_email" name="teacher_email" 
                                                placeholder="email@example.com" required>
                                        </div>
                                        <div class="invalid-feedback">Please provide a valid email.</div>
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="teacher_password" class="form-label fw-bold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" class="form-control" id="teacher_password" name="teacher_password" 
                                            placeholder="Create a secure password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-text text-muted">Password must be at least 8 characters long.</div>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Account Type</label>
                                    <div class="d-flex gap-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="teacher_account_type" 
                                                id="department_head" value="department_head" required>
                                            <label class="form-check-label" for="department_head">
                                                <i class="bi bi-briefcase me-1"></i> Department Head
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="teacher_account_type" 
                                                id="teacher" value="teacher" required>
                                            <label class="form-check-label" for="teacher">
                                                <i class="bi bi-person-badge me-1"></i> Teacher
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary py-2">
                                        <i class="bi bi-check-circle me-2"></i>Create Teacher Account
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Student Accounts Creation -->
                    <div class="card shadow-sm border-0 rounded-lg">
                        <div class="card-header bg-success text-white py-3">
                            <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i>Create Student Accounts</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-info d-flex align-items-center" role="alert">
                                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                <div>
                                    Create multiple student accounts based on their category. This will generate accounts for all students in the selected category.
                                </div>
                            </div>
                            
                            <form method="POST" action="{{ route('admin.student.accounts.create.all') }}" class="mt-3">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-6 mb-3">
                                        <label for="student_category" class="form-label fw-bold">Select Student Category</label>
                                        <select class="form-select form-select-lg" id="student_category" name="student_category" required>
                                            <option value="" selected disabled>Choose category...</option>
                                            <option value="Enrolled">Enrolled Students</option>
                                            <option value="Transferee">Transferee Students</option>
                                            <option value="Returnee">Returnee Students</option>
                                            <option value="Octoberian">Octoberian Students</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn btn-success btn-lg w-100">
                                            <i class="bi bi-person-plus-fill me-2"></i>Generate Student Accounts
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Link Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
            
            // Password toggle visibility
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('teacher_password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon
                    const icon = this.querySelector('i');
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                });
            }
            
            // Display SweetAlert for session messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0d6efd'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: "{{ session('error') }}",
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0d6efd'
                });
            @endif
        });
    </script>
</x-app-layout>