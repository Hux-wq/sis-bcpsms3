<x-app-layout>

    <x-page-title header="{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}" :links='["student" => "/student", "profile" => "/student/profile/{$student->id}"]'/>


    <div class="row m-0">

        <div class="col-12 card">
    
            <div class="row   p-3">
    
                <div class="col-12 col-lg-4">
    
                    <div class="pt-2">
    
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            
                            <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <h1 class="text-capitalize fs-5  fw-bold">{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</h1>
                            <h6>{{$student->email}}</h6>
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
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->last_name}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">First Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->first_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Middle Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->middle_name}}</div>
                    </div>
    
                    <div class="row">
                    <div class="col-lg-3 col-md-4 label">Age</div>
                    <div class="col-lg-9 col-md-8">{{$student->age}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Gender</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->gender}}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                        <div class="col-lg-9 col-md-8">{{$student->birthdate}}</div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Birth of Place</div>
                        <div class="col-lg-9 col-md-8">{{$student->place_of_birth}}</div>
                    </div>
    
                </div>
            </div>
        </div>
    
        
    </div>


    <div>

        <div class="card p-3">
    
            <h4>Attendance Overview</h4>
    
            <div class="row">
    
              <div class="col-xxl-3 col-md-6">
                <div class="alert alert-success p-0">
    
                  <div class="card-body">
                    
    
                    <div class="d-flex align-items-center p-1">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div>
                        <h5>95%</h5>
                        <h6>Present</h6>
                      </div>
                    </div>
                  </div>
    
                </div>
              </div>
    
              <div class="col-xxl-3 col-md-6">
                <div class="alert alert-danger p-0">
    
                  <div class="card-body">
                    
    
                    <div class="d-flex align-items-center p-1">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div>
                        <h5>3%</h5>
                        <h6>Absent</h6>
                      </div>
                    </div>
                  </div>
    
                </div>
              </div>
    
              <div class="col-xxl-3 col-md-6">
                <div class="alert alert-warning p-0">
    
                  <div class="card-body">
                    
    
                    <div class="d-flex align-items-center p-1">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center pe-2">
                        <i class="fa-solid fa-user"></i>
                      </div>
                      <div>
                        <h5>2%</h5>
                        <h6>Late</h6>
                      </div>
                    </div>
                  </div>
    
                </div>
              </div>
    
              <div class="col-xxl-3 col-md-6">
                <div class="alert alert-info p-0">
    
                  <div class="card-body">
                    
    
                    <div class="d-flex align-items-center p-1 ">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                      </div>
                      <div>
                        <h5>180</h5>
                        <h6>Total Days</h6>
                      </div>
                    </div>
                  </div>
    
                </div>
              </div>
    
            </div>
    
        </div>
    
    </div>

    <div class="row m-0">

        <div class="col-12 card">
    
            <h4 class="pt-3 ps-1">Grade Performance <Link href="/Students/Profile/View/{students.id}/AcademicPerformance"><i class="fa-solid fa-arrow-right"></i></Link></h4>
    
            <div class="row p-3">
    
    
                <div class="col-12 col-lg-6">
    
                    <div class="">
                        <canvas id="chartCanvas" style="min-height: 300px !important;" class="w-100"></canvas>
                    </div>

                    <script>
                        let chartCanvas = document.getElementByid('id');
                        new Chart(chartCanvas, {
                            type: 'bar',
                            data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                            datasets: [{
                                label: 'Bar Chart',
                                data: [65, 59, 80, 81, 56, 55, 40],
                                backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                            }]
                            },
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            }
                        });

                    </script>
                      
    
                </div>
    
                <div class="col-12 col-lg-6">
    
                    <div class="">
                        <table id="gradeTable" class="datatable">
                            <thead>
                              <tr>
                                <th class="h-txt-theme"><b>N</b>o#</th>
                                <th class="h-txt-theme">Code</th>
                                <th class="h-txt-theme">Name</th>
                                <th class="h-txt-theme">Status</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              
                                  <tr>
                                    <td class="sub">1</td>
                                    <td class="text-uppercase sub">Cap101</td>
                                    <td class="sub">Capstone 101</td>
                                    <td class="sub"><span class="badge text-bg-success px-3 p-2">Passed</span></td>
                                  </tr>
                    
                                  <tr>
                                    <td class="sub">2</td>
                                    <td class="text-uppercase sub">Res101</td>
                                    <td class="sub">Reseach 101</td>
                                    <td class="sub"><span class="badge text-bg-danger px-3 p-2 ">Failed</span></td>
                                  </tr>
                    
                                  <tr>
                                    <td class="sub">3</td>
                                    <td class="text-uppercase sub">OJT101</td>
                                    <td class="sub">OJT 101</td>
                                    <td class="sub"><span class="badge text-bg-success px-3 p-2">Passed</span></td>
                                  </tr>
                    
                                  <tr>
                                    <td class="sub">4</td>
                                    <td class="text-uppercase sub">Cap101</td>
                                    <td class="sub">Capstone 101</td>
                                    <td class="sub"><span class="badge text-bg-success px-3 p-2">Passed</span></td>
                                  </tr>
                             
                                <!-- <tr class="w-100 border text-center">
                                  <td colspan=6>
                                      <h4 class="pt-4 fw-bolder"> Theres no records in the database</h4>
                                  </td>
                              </tr>
                         -->
                              
                            </tbody>
                          </table>
                       
                    </div>
                  
    
                </div>
            </div>
        </div>
    
        
    </div>

</x-app-layout>