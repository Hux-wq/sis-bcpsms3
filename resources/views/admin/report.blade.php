<x-app-layout>

    <x-page-title header="Report" :links="['Report' => '/report']"/>
    
      <section class="section card">

        <div class="p-3">
          <h5 class="card-title pb-0">Export Students</h5>
          <hr>
          <p>This generate an Excel export of students.</p>
          <a href="/export-students" class="btn btn-primary">Download Students</a>
          <p class="fw-light" style="font-size: 13px;">The export will be generated and downloaded automatically.</p>
          <hr>
        </div>

        <div class="p-3">
          <h5 class="card-title pb-0">Filter Students</h5>
          <hr>
          <form class="row" action="students/export/filtered" style="max-width: 500px;">
            @csrf
            <p>Use this form to generate an Excel export of students filtered by academic year or section</p>
            <!-- <div class="col-12">
              <label for="" class="form-label">Academic Year</label>
              <select class="form-select" aria-label="Default select example">
                <option value="2024-2025" selected>2024-2025</option>
                <option value="2023-2024">2023-2024</option>
                <option value="2022-2023">2022-2023</option>
                <option value="2021-2022">2021-2022</option>
                <option value="2020-2021">2020-2021</option>
                <option value="2019-2020">2019-2020</option>
              </select>
              <p class="fw-light" style="font-size: 13px;">This will filter students enrolled in the selected academic year.</p>
            </div> -->

            <div class="col-12 mb-3">
              <label for="year">School Year:</label>
              <select class="form-select dropdown-input-tab" name="year">
                  <option value="2024-2025">2024-2025</option>
                  <option value="2023-2024">2023-2024</option>
                  <option value="2022-2023">2022-2023</option>
                  <option value="2021-2022">2021-2022</option>
                  <option value="2020-2021">2020-2021</option>
                  <option value="2019-2020">2019-2020</option>
                  <option value="2018-2019">2018-2019</option>
                  <option value="2017-2018">2017-2018</option>
                  <option value="2016-2017">2016-2017</option>
                  <option value="2015-2016">2015-2016</option>
                  <option value="2014-2015">2014-2015</option>
                  <option value="2013-2014">2013-2014</option>
              </select>
            </div>

            <div class="col-12 mb-3">
              <label for="year">Semester:</label>
              <select class="form-select dropdown-input-tab" name="semester">
                  <option value="1">1st</option>
                  <option value="2">2nd</option>
                 
              </select>
            </div>
            
            <div class="col-12 mb-3">
              <label for="status">Enrollment Status:</label>
              <select class="form-select dropdown-input-tab" name="status">
                  <option value="regular">Regular</option>
                  <option value="graduated">Graduated</option>
                  <option value="failed">Failed</option>
                  <option value="returnee">Returnee</option>
                  <option value="transferee">Transferee</option>
                  <option value="octoberian">Octoberian</option>
                  <option value="drop out">Drop Out</option>
                  
                  <!-- Add other statuses as needed -->
              </select>
            </div>


            <div class="col-12 mt-3">
              <button class="btn btn-primary">Generate Excel Report</button>
            </div>
          </form>
          <p class="fw-light" style="font-size: 13px;">The export will be generated and downloaded automatically.</p>
          <hr>
        </div>
        
          
      
      </section>

</x-app-layout>