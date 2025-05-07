<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-page-title header="Document" :links="['document' => '/document']"/>

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

    <div class="card p-3">

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
                <td>{{ \App\Helpers\UserHelper::GetStudentNumber($file->student_id) }}</td>
                <td>{{ \App\Helpers\UserHelper::GetUserName($file->student_id) }}</td>
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
  </x-app-layout>
