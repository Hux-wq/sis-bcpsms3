<x-app-layout>

    <x-page-title header="Graduated Students" :links="['graduated' => '/graduated']"/>

    <div class="card p-3">
        <table id="graduatedtable" class="table table-hover datatable">
            <thead>
                <tr>

                    <th>No.</th>
                    <th>Name</th>
                    <th>Student No</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ( $students as $index => $student)
                @if ($student->enrollment_status === 'Graduated')
                <tr>
                    <td>{{$index + 1}}</td>
                    <td class="text-capitalize">
                        {{ $student->last_name ?? 'N/A'}},
                        {{ $student->first_name ?? 'N/A'}}
                        {{ $student->middle_name ?? 'N/A'}}
                    </td>
                    <td>{{ $student->student_number ?? 'N/A'}}</td>
                    <td>{{ $student->age ?? 'N/A' }}</td>
                    <td>{{ $student->email_address ?? 'N/A' }}</td>
                    <td>
                        <a href="/student/profile/{{$student->id}}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
