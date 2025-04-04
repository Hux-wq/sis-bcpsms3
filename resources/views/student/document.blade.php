<x-app-layout>

    <x-page-title header="Document" :links="['document' => '/document']"/>

    <div class="card p-3">
        <div>
        <h5>Birth Certificate</h5>
        <hr class="pt-0 mt-0">
        <div class="row">
        <div class="col-4">
            <form id="uploadFormBC" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="document" class="form-label">Upload Document (PDF)</label>
                <input type="file" class="form-control mb-2" name="document" id="document" style="max-width: 300px;">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
            <p style="color: grey">Note: the document are used to verify students informations and ensure that the data is protected.</p>
            </form>
        </div>
        <div class="col-8">
            <button class="btn btn-success">View Uploaded Files</button>
        </div>
        </div>
        <script>
            document.getElementById('uploadFormBC').addEventListener('submit', function(e) {
                e.preventDefault();
                
                let formData = new FormData(this);
                
                // Show loading alert
                Swal.fire({
                    title: 'Uploading...',
                    text: 'Please wait while we upload your document',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                fetch('{{ route("uploadfiles.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Success alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: data.message,
                        });
                    } else {
                        // Error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    // Network or other error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong: ' + error
                    });
                });
            });
        </script>
        </div>
    </div>

    <div class="card p-3">
        <h5>Form 137</h5>

        <hr class="pt-0 mt-0">
        <form action="">
            <input class="form-control mb-2" type="file" name="" id="" style="max-width: 300px;">
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <div class="card p-3">
        <h5>Good Moral</h5>

        <hr class="pt-0 mt-0">
        <form action="">
            <input class="form-control mb-2" type="file" name="" id="" style="max-width: 300px;">
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>



  </x-app-layout>