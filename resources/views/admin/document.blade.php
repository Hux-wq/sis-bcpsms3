<x-app-layout>

    <x-page-title header="Document" :links="['document' => '/document']"/>

    <div class="card p-3">
        <table id="datatable" class="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>type</th>
                    <th>File</th>
                    
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
            <tr>
                <td>{{$file->id}}</td>
                <td>{{$file->student_id}}</td>
                <td class="text-capitalize">{{$file->file_for}}</td>
                <td>{{$file->file_size}}Kb</td>
                <td>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#file{{$file->id}}">
                        View Pdf
                    </button>

                    <div class="modal fade" id="file{{$file->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5 text-capitalize" id="exampleModalLabel">{{$file->file_for}}</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <embed src="{{ asset('storage/' . $file->file_path) }}" type="application/pdf" width="100%" height="600px" />
                            </div>
                            
                          </div>
                        </div>
                      </div>


                </td>
                
            </tr>

           
            @endforeach
            </tbody>


        </table>
    </div>
  </x-app-layout>