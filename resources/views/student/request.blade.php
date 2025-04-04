<x-app-layout>

    <x-page-title header="Request" :links="['Request' => '/Request']"/>
    

    <div class="section dashboard">

        <div class="card p-3">
            <!-- Include SweetAlert -->

        <form id="documentRequestForm">
            @csrf
            <h5>Request a Document</h5>
            <select class="form-select mb-2" style="max-width:300px;" aria-label="Default select example" name="document" id="document">    
                <option value="Transcript of Records">Transcript of Records</option>
                <option value="grades">Grades</option>
            </select>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>

        <script>
        document.getElementById("documentRequestForm").addEventListener("submit", function (event) {
        event.preventDefault(); 

        var formData = new FormData(this);

        fetch("{{ route('student.request.post') }}", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            
            if (data.status === "success") {
                Swal.fire({
                    title: data.message,
                    icon: "success",
                    confirmButtonText: "OK"
                });
            } else {
                Swal.fire({
                    title: data.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: "An error occurred",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
    });
        </script>

        </div>

    </div>

</x-app-layout>