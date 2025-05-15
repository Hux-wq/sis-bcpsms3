<x-app-layout>
    <x-page-title header="Account Creation" :links="['account.creation' => '/account-creation']"/>
    <section class="section">
        <div class="row">
            <div class="col-12">

                <!-- Teacher Account Creation Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Create Teacher Account</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.teacher.account.create') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="teacher_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="teacher_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="teacher_email" name="teacher_email" required>
                            </div>
                            <div class="mb-3">
                                <label for="teacher_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="teacher_password" name="teacher_password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Account Type</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="teacher_account_type" id="department_head" value="department_head" required>
                                        <label class="form-check-label" for="department_head">Department Head</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="teacher_account_type" id="teacher" value="teacher" required>
                                        <label class="form-check-label" for="teacher">Teacher</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Create  Account</button>
                        </form>
                    </div>
                </div>

              
                <!-- Button to create all student accounts by category -->
                <div class="card">
                    <div class="card-header">
                        <h4>Create Student Accounts</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.student.accounts.create.all') }}">
                            @csrf
                            <div class="mb-3, w-25">
                                <label for="student_category" class="form-label">Select Category</label>
                                <select class="form-select" id="student_category" name="student_category" required> 
                                    <option value="Enrolled">Enrolled</option>
                                    <option value="Transferee">Transferee</option>
                                    <option value="Returnee">Returnee</option>
                                    <option value="Octoberian">Octoberian</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Create Accounts</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif
</x-app-layout>
