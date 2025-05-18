<x-app-layout>

    <div class="container">
        <h1>Teachers List</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $index => $teacher)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->acc_type }}</td>
                    <td>
<a href="{{ route('admin.teachers.profile', $teacher->id) }}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
