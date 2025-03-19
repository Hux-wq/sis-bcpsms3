<x-app-layout>

    <x-page-title header="Pending Enrollees" :links="['Enrollees' => '/enrollees']"/>

    <div class="card p-3">
        <table id="studenttable" class="datatable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Desired Program</th>
                    <th>Requirements</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
                @foreach ( $students as $student)
                <tr>
                    <td class="text-capitalize">
                        {{ $student->last_name ?? 'N/A'}}
                        {{ $student->suffix_name ?? 'N/A'}},
                        {{ $student->first_name ?? 'N/A'}}
                        {{ $student->middle_name ?? 'N/A'}}
                    </td>
                    <td>{{ $student->email_address }}</td>
                    <td>{{ $student->desired_major }}</td>
                    <td>
                        <a href="/enrollees/{{$student->id}}/document" >
                           view documents</i>
                        </a>
                    </td>
                    <td>
                        <form id="accept-enrollee" method="POST" action="{{ route('accept-enrollee') }}" class="bg-transparent m-0 p-0">
                            @csrf
                            <input type="hidden" name="id" value="{{$student->id}}" />
                            <a type="submit" class="p-0 m-0 w-100 text-start" onclick="confirm(event)">
                                <span >{{ __('Accept') }}</span>
                            </a>
                        </form>
                    </td>
                </tr>

                
                @endforeach
            </tbody>
        </table>
    </div>

    <script>

        function confirm(event) {
            event.preventDefault();
            
            Swal.fire({
                title: "Enroll?", 
                text: "Enroll Now!", 
                icon: "question",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Enroll!"
            }).then((result) => {
                if (result.isConfirmed) {

                    document.getElementById('accept-enrollee').submit();
                    
                    Swal.fire({
                        title: "Success!",
                        text: "Student have been successfully Enrolled.",
                        icon: "success",
                        showConfirmButton: false,
                    });

                }
            });
        }

    </script>


  </x-app-layout>