<x-app-layout>

    <x-page-title header="Document" :links="['document' => '/document']"/>

    <div class="card p-3">
        <table id="datatable" class="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Requirements</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($req_documents as $docu)
            <tr>
                <td>{{$docu->id}}</td>
                <td>{{$docu->name}}</td>
                <td>{{$docu->updated_at}}</td>
                <td>{{$docu->created_at}}</td>
                <td> <a href="" class="btn btn-primary">Edit</a> </td>
            </tr>
            @endforeach
            </tbody>


        </table>
    </div>
  </x-app-layout>