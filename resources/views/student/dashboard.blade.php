<x-app-layout>
<x-page-title header="Dashboard" :links="['dashboard' => '/dashboard']"/>
      
    <section class="section dashboard">

        <div class="card">

            <div class="row m-0">

                <div class="col-12">
            
                    <div class="row   p-3">
            
            
                        <div class="col-12 col-lg-8">
            
                            <div class="d-flex pt-4 mb-2">
                                <h3 class="me-1 fw-bolder"><span><i class="fa-solid fa-user"></i></span> {{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </h3>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Program</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{$student->program_id}}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">School ID</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">{{$student->student_number}}</div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Academic Year</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">1st Year</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-bold">Section</div>
                                <div class="col-lg-9 col-md-8 text-capitalize">11001</div>
                            </div>
            
                            
            
            
                        </div>
                    </div>
                </div>
            
                
            </div>
        </div>
      
    </section>
</x-app-layout>
