<x-app-layout>

    <x-page-title header="Pending Enrollees" :links='["Enrollees" => "/enrollees", "{$students->first_name} {$students->middle_name} {$students->last_name} {$students->suffix_name}" => "/"]'/>

    <div class="card p-3">
        <table id="studenttable" class="datatable">
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>    
            <tbody>
               @foreach ($documents as $docu)

                <tr>
                    <td class="text-capitalize">
                        {{$docu->docu_name}}
                    </td>
                    <td class="{{ $docu->status == 'pending' ? 'badge text-bg-warning' : ($docu->status == 'submitted' ? 'alert badge-success' : '')}} ">  {{$docu->status}}</td>

                    <td>  {{$docu->updated_at}}</td>

                    <td>  <button class="border boder-0 rounded-circle btn btn-primary pt-2" onclick="confirm(event)"><i class="fa-solid fa-eye"></i></button></td>
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
                text: "You are about to logout!", 
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('logout-form').submit();
                    
                    // Show success message
                    Swal.fire({
                        title: "Logged Out!",
                        text: "You have been successfully logged out.",
                        icon: "success"
                    });
                }
            });
        }

    </script>


  </x-app-layout>