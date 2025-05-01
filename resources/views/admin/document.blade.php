
  <x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-page-title header="Document" :links="['document' => '/document']"/>

    <div class="card p-3">
    @php
function GetUserName($id) {
    $user = \App\Models\Student::find($id);

    if (!$user) {
        return 'Unknown User';
    }

    return trim("{$user->first_name} {$user->middle_name} {$user->last_name}");
}
@endphp

@php
    function GetStudentNumber($id) {
        $user = \App\Models\Student::find($id);

        return $user->student_number ?? 'N/A';
}
@endphp
        <table id="datatable" class="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>File Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Date/Time submitted</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{ GetStudentNumber($file->student_id) }}</td>
                <td>{{ GetUserName($file->student_id) }}</td>
                <td>{{$file->file_name}}</td>
                <td>{{$file->readable_type }}</td>
                <td>{{$file->file_size}}Kb</td>
                <td>{{$file->created_at}}</td>
                <td>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#file{{$file->id}}">
                        View Pdf
                    </button>

                    <div class="modal fade" id="file{{$file->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5 text-capitalize" id="exampleModalLabel">{{$file->file_for}}</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="100%" height="600px" />
                            </div>
                            
                          </div>
                        </div>
                      </div>


                </td>
                <td>
                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm delete-button">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

           
            @endforeach
            </tbody>


        </table>
    </div>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
            });
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session("error") }}',
            }); 
        </script>
    @endif
    <script>
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
