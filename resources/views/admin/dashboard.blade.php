<x-app-layout>

    <x-page-title header="Dashboard" :links="['dashboard' => '/dashboard']"/>
    
        
        
          <section class="section dashboard">
            <div class="row">
        
              <div class="col-12">
                <div class="row">
        
                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
        
                      <div class="card-body">
        
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user text-dark"></i>
                          </div>
                          <div class="ps-3">
                            <h5>Students Enrolled</h5>  
                            <h6>{{$student_enrolled_count}}</h6>
                          </div>
                        </div>
                      </div>
        
                    </div>
                  </div><!-- End Sales Card -->
        
                  <!-- Revenue Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
        
                      <div class="card-body">
                        
        
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-book"></i>
                          </div>
                          <div class="ps-3">
                            <h5>Courses</h5>
                            <h6>{{$courses_count}}</h6>
                          </div>
                        </div>
                      </div>
        
                    </div>
                  </div><!-- End Revenue Card -->
        
                  <!-- Customers Card -->
                  <div class="col-xxl-4 col-xl-12">
        
                    <div class="card info-card customers-card">
        
        
                      <div class="card-body">
        
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-building"></i>
                          </div>
                          <div class="ps-3">
                            <h5>Department</h5>
                            <h6>{{$departments_count}}</h6>
                          </div>
                        </div>
        
                      </div>
                    </div>
        
                  </div>
        
                  <!-- Customers Card -->
                  <div class="col-xxl-4 col-xl-12">
        
                    <div class="card info-card revenue-card">
        
        
                      <div class="card-body">
        
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-robot"></i>
                          </div>
                          <div class="ps-3">
                            <h5>Program</h5>
                            <h6>{{$programs_count}}</h6>
                          </div>
                        </div>
        
                      </div>
                    </div>
        
                  </div>
        
                  <!-- Customers Card -->
                  <div class="col-xxl-4 col-xl-12">
        
                    <div class="card info-card sales-card">
        
        
                      <div class="card-body">
        
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-list"></i>
                          </div>
                          <div class="ps-3">
                            <h5>Classes</h5>
                            <h6>{{$sections_count}}</h6>
                          </div>
                        </div>
        
                      </div>
                    </div>
        
                  </div>         
        
                </div>
              </div>
        
            </div>
          </section>

          
        
 
</x-app-layout>