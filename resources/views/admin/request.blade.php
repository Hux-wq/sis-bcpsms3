<x-app-layout>

    <x-page-title header="Request" :links="['Request' => '/Request']"/>

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

    <!-- Pending Request -->
    <h3 class="text-white p-2" style="background-color: #334155;">Pending Requests</h3>
    <table id="pending-requests" class="datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Document</th>
                <th>Status</th>
                <th>Date Requested</th>
                <th>Date Needed</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendingReqs as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ GetStudentNumber($req->student_id) }}</td>
                <td>{{ GetUserName($req->student_id) }}</td>
                <td class="text-capitalize">{{ $req->document }}</td>
                <td>{{ $req->status }}</td>
                <td>{{ $req->created_at ? $req->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $req->date_needed ?? '-' }}</td>
                <td>
                    <form action="{{ route('admin.requests.approve', $req->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="text-white" style="background-color:#28a745; border-radius: 5px;">Approve</button>
                    </form>
                    <form action="{{ route('admin.requests.decline', $req->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="text-white" style="background-color: #dc3545; border-radius: 5px;">Decline</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pendingReqs->links('pagination::bootstrap-5') }}
    <!-- Accepted Request -->
    <h3 class="text-white p-2" style="background-color: #28a745;">Accepted Requests</h3>
    <table id="accepted-requests" class="datatable mb-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Document</th>
                <th>Status</th>
                <th>Date Requested</th>
                <th>Date Needed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($acceptedReqs as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ GetStudentNumber($req->student_id) }}</td>
                <td>{{ GetUserName($req->student_id) }}</td>
                <td class="text-capitalize">{{ $req->document }}</td>
                <td>{{ $req->status }}</td>
                <td>{{ $req->created_at ? $req->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $req->date_needed ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $acceptedReqs->links('pagination::bootstrap-5') }}
    <!-- Declined Request -->
    <h3 class="text-white p-2" style="background-color: #dc3545;">Declined Requests</h3>
    <table id="declined-requests" class="datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Document</th>
                <th>Status</th>
                <th>Date Requested</th>
                <th>Date Needed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($declinedReqs as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ GetStudentNumber($req->student_id) }}</td>
                <td>{{ GetUserName($req->student_id) }}</td>
                <td class="text-capitalize">{{ $req->document }}</td>
                <td>{{ $req->status }}</td>
                <td>{{ $req->created_at ? $req->created_at->format('Y-m-d') : '-' }}</td>
                <td>{{ $req->date_needed ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $declinedReqs->links('pagination::bootstrap-5') }}
</div>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        });
    </script>
    @endif

  </x-app-layout>
