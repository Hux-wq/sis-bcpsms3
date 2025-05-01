<x-app-layout>

    <x-page-title header="Request" :links="['Request' => '/Request']"/>
    

    <div class="section dashboard">

    <div class="card p-3">
    <form id="documentRequestForm">
        @csrf
        <h5>Request a Document</h5>
        <select class="form-select mb-2" style="max-width:300px;" aria-label="Default select example" name="document" id="document">    
            <option selected>Select Document</option>
            <option value="Transcript of Records">Transcript of Record(TOR)</option>
            <option value="grades">Certificate of grades (COG)</option>
            <option value="Certificate of Enrollment">Certificate of Registration(COR)</option>
            <option value="Certificate of Good Moral">Certificate of Good Moral</option>
            <option value="birt Certificate">Birth Certificate</option>
            <option value="Grade evaluation">Grade evaluation</option>
            <option value="FORM 137">FORM 137</option>
        </select>
        <h5>Date Needed</h5>
        <input type="date" class="form-control mb-2" name="date" style="max-width:300px" id="date" placeholder="Date of Request" required>
        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>

    {{-- Debug output removed --}}

    <h3 class="mt-4">Your Requested Document/s </h3>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Document</th>
                    <th>Status</th>
                    <th>Date Requested</th>
                    <th>Date Updated</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reqs as $req)
                <tr>
                    <td>{{ $req->document }}</td>
                    <td>{{ ucfirst($req->status) }}</td>
                    <td>{{ $req->created_at ? $req->created_at->format('Y-m-d') : '-' }}</td>
                    <td>{{ $req->updated_at ? $req->updated_at->format('Y-m-d') : '-' }}</td>
                    <td>
                        @if($req->status === 'accepted' && isset($filePaths[$req->id]) && $filePaths[$req->id])
                            <a href="{{ url('storage/' . $filePaths[$req->id]) }}" class="btn btn-primary btn-sm" download>Download</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No requests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $reqs->links('pagination::bootstrap-5') }}

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
                }).then(() => {
                                location.reload();
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