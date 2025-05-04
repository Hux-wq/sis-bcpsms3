<x-app-layout>

    <x-page-title header="Document" :links="['document' => '/document']"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container my-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header text-white" style="background-color: #334155;">
                <h5 class="mb-0">Upload Document </h5>
            </div>
            <div class="card-body">
                <form id="uploadFormBC" enctype="multipart/form-data" class="row g-3 align-items-center">
                    @csrf
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="document" id="document" accept="application/pdf" >
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">Note: The document is used to verify student information and ensure data protection.</small>
                    </div>
                </form>
            </div>
        </div>    
    </div>
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Uploaded Documents</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>File Name</th>
                            <th>Date/Time Submitted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($files as $file)
                        <tr>
                            <td>{{ $file->file_name }}</td>
                            <td>{{ $file->created_at }}</td>
                            <td>
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No documents uploaded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Admin Document Requests</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>File Name</th>
                            <th>File Format</th>
                            <th>Copy/s</th>
                            <th>Date Needed</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($adminRequests as $index => $request)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @php
                                $pattern = '/^(.*?) \((.*?)\) - Copies: (\d+)$/';
                                preg_match($pattern, $request->document, $matches);
                                $fileName = $matches[1] ?? $request->document;
                                $fileFormat = $matches[2] ?? '';
                                $copies = $matches[3] ?? '';
                            @endphp
                            <td>{{ $fileName }}</td>
                            <td>{{ $fileFormat }}</td>
                            <td>{{ $copies }}</td>
                            <td>{{ $request->date_needed }}</td>
                            <td>
                                @if(strtolower($request->status) === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif(strtolower($request->status) === 'submitted')
                                    <span class="badge bg-success">Submitted</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($request->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No admin document requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
            });
        @elseif(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session("error") }}',
            });
        @endif

        document.getElementById('uploadFormBC').addEventListener('submit', function(e) {
            e.preventDefault();
            
            let formData = new FormData(this);
            
            Swal.fire({
                title: 'Uploading...',
                text: 'Please wait while we upload your document',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
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
                                title: 'Success!',
                                text: data.message,
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: data.message
                            });
                        }
                    })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong: ' + error
                });
            });
        });

        // Add Swal confirmation for delete forms
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>

</x-app-layout>
