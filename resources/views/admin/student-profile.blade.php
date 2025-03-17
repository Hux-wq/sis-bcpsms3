<x-app-layout>

    <x-page-title header="{{$user->UserNameInfo->first_name}} {{$user->UserNameInfo->middle_name}} {{$user->UserNameInfo->last_name}}" :links='["student" => "/student", "profile" => "/student/profile/{$user->id}"]'/>


    <div class="row m-0">

        <div class="col-12 card">
    
            <div class="row   p-3">
    
                <div class="col-12 col-lg-4">
    
                    <div class="pt-2">
    
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            
                            <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <h1 class="text-capitalize fs-5  fw-bold">{{$user->UserNameInfo->first_name}} {{$user->UserNameInfo->middle_name}} {{$user->UserNameInfo->last_name}}</h1>
                            <h3>{{$user->email}}</h3>
                            <div class="social-links mt-2">
                                <a href="/" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                                <a href="/" class="facebook"><i class="fa-brands fa-facebook"></i></a>
                                <a href="/" class="instagram"><i class="fa-brands fa-instagram"></i></a>
                                <a href="/" class="linkedin"><i class="fa-brands fa-linkedin"></i></a>
                            </div>
                                    
                        </div>
            
                    </div>
    
                </div>
    
                <div class="col-12 col-lg-8">
    
                    <div class="d-flex pt-4 mb-2">
                        <h5 class="me-1 fw-bolder">Profile Details</h5>
                        <h5><a class="pb-2 link underline text-primary" href="http://127.0.0.1:8000/Students/Profile/View/{students.id}/EditProfile">Edit <i class="fa-solid fa-pen-to-square"></i></a></h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Last Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$user->UserNameInfo->last_name}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">First Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$user->UserNameInfo->first_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Middle Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$user->UserNameInfo->middle_name}}</div>
                    </div>
    
                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Age</div>
                    <div class="col-lg-9 col-md-8">{{$user->UserBasicInfo->age}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Gender</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$user->UserBasicInfo->gender}}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                        <div class="col-lg-9 col-md-8">{{$user->UserBasicInfo->birthdate}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Birth of Place</div>
                        <div class="col-lg-9 col-md-8">{{$user->UserBasicInfo->place_of_birth}}</div>
                    </div>
    
                </div>
            </div>
        </div>
    
        
    </div>

</x-app-layout>