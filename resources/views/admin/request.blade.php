<x-app-layout>

    <x-page-title header="Request" :links="['Request' => '/Request']"/>

    <div class="card p-3">
        <table id="datatable" class="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>student Name</th>
                    <th>Document</th>
                    <th>status</th>
                   
                    
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($reqs as $req)
            <tr>
                <td>{{$req->id}}</td>
                <td>{{$req->student_id}}</td>
                <td class="text-capitalize">{{$req->document}}</td>
                <td>{{$req->status}}</td>
                
                
            </tr>

           
            @endforeach
            </tbody>


        </table>
    </div>
  </x-app-layout>