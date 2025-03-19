<x-app-layout>

    <x-page-title header="Student" :links="['student' => '/student']"/>

    <div class="card p-3">
        <table id="studenttable" class="datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student No</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ( $students as $student)
                <tr>
                    <td class="text-capitalize">
                        {{ $student->last_name ?? 'N/A'}},
                        {{ $student->first_name ?? 'N/A'}}
                        {{ $student->middle_name ?? 'N/A'}}
                    </td>
                    <td>{{ $user->account_number ?? 'N/A'}}</td>
                    <td>{{ $student->age ?? 'N/A' }}</td>
                    <td>{{ $student->email_address ?? 'N/A' }}</td>
                    <td>
                        <a href="/student/profile/{{$student->id}}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


  </x-app-layout>