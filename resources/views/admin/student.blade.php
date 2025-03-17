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
                @foreach ( $users as $user)
                <tr>
                    <td class="text-capitalize">
                        {{ $user->UserNameInfo->last_name ?? 'N/A'}},
                        {{ $user->UserNameInfo->first_name ?? 'N/A'}}
                        {{ $user->UserNameInfo->middle_name ?? 'N/A'}}
                    </td>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->UserBasicInfo->age ?? 'N/A' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="/student/profile/{{$user->id}}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


  </x-app-layout>