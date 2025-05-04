<x-app-layout>

    <x-page-title header="Dashboard" :links="['dashboard' => '/dashboard']"/>
    
        
        
          <section class="section dashboard">
            <div class="row">
        
              <div class="col-12">
                <div class="row">
        
                  <!-- Sales Card -->
                  <div class="col-xxl-4 col-md-6">
                   <div class="card info-card sales-card" id="salesCard" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#studentsModal">
        
                      <div class="card-body hover-effect" style="cursor:pointer;">
        
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
                  
                  <!-- Modal Enrolled student -->
                  <div class="modal fade" id="studentsModal" tabindex="-1" aria-labelledby="studentsModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="studentsModalLabel">Enrolled Students</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="text" id="studentSearchInput" onkeyup="filterStudents()" placeholder="Search for students..." class="form-control mb-3" />
                          <table class="table table-striped" id="studentsTable">
                            <thead>
                              <tr>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(0)">ID &#x25B2;&#x25BC;</button></th>
                               <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(1)">Student Number &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(2)">First Name &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(3)">Middle Name &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(4)">Last Name &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(5)">Suffix &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(6)">Age &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(7)">Gender &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(8)">Birthdate &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(9)">Place of Birth &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(10)">Religion &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(11)">Current Address &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(12)">Email &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(13)">Contact Number &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(14)">Status &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTable(15)">Program &#x25B2;&#x25BC;</button></th>
                              </tr>
                              @foreach($students as $student)
                              <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->student_number }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->suffix_name }}</td>
                                <td>{{ $student->age }}</td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->birthdate }}</td>
                                <td>{{ $student->place_of_birth }}</td>
                                <td>{{ $student->religion }}</td>
                                <td>{{ $student->current_address }}</td>
                                <td>{{ $student->email_address }}</td>
                                <td>{{ $student->contact_number }}</td>
                                <td>{{ $student->enrollment_status }}</td>
                                <td>{{ $student->program->name ?? 'N/A' }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
        
                  <!-- Modal for Courses -->
                  <div class="modal fade" id="coursesModal" tabindex="-1" aria-labelledby="coursesModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="coursesModalLabel">Courses</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="text" id="courseSearchInput" onkeyup="filterCourses()" placeholder="Search for courses..." class="form-control mb-3" />
                          <table class="table table-striped" id="coursesTable">
                            <thead>
                              <tr>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTableCourses(0)">Course Code &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTableCourses(1)">Title &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTableCourses(2)">Credits &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTableCourses(3)">Description &#x25B2;&#x25BC;</button></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($courses as $course)
                              <tr>
                                <td>{{ $course->course_code }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->credits }}</td>
                                <td>{{ $course->description }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal for Department -->
                  <div class="modal fade" id="departmentModal" tabindex="-1" aria-labelledby="departmentModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable" style="max-width: 90vw;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="departmentModalLabel">Departments</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <input type="text" id="departmentSearchInput" onkeyup="filterDepartments()" placeholder="Search for departments..." class="form-control mb-3" />
                          <table class="table table-striped" id="departmentTable">
                            <thead>
                              <tr>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTableDepartments(0)">Code &#x25B2;&#x25BC;</button></th>
                                <th><button type="button" class="btn btn-link p-0 sort-button" onclick="sortTableDepartments(1)">Name &#x25B2;&#x25BC;</button></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($departments as $department)
                              <tr>
                                <td>{{ $department->code }}</td>
                                <td>{{ $department->name }}</td>       
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
        
                  <!-- Revenue Card -->
                  <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card" style="cursor:pointer;">
                      <div class="card-body" id="coursesCard" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#coursesModal">
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
                  </div>

                  <!-- Customers Card -->
                  <div class="col-xxl-4 col-xl-12">
        
                    <div class="card info-card customers-card" style="cursor:pointer;">
        
        
                      <div class="card-body" id="departmentCard" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#departmentModal">
        
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
        
                    <div class="card info-card revenue-card" style="cursor:pointer;" id="programCard">
        
        
                      <div class="card-body" id="programCard" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#programModal">
        
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-robot"></i>
                          </div>
                          <div class="ps-3">
                            <h5>Program</h5>
                            <h6>{{$programs_count}}</h6>
                          </div>
                        </div>

                        <div class="mt-4">
                          <h5>Students per Program</h5>
                          <canvas id="studentsProgramPieChart" width="400" height="400"></canvas>
                        </div>
        
                      </div>
                    </div>
        
                  </div>


                  <!-- Grouped Bar Chart for Enrolled, trnasferee, Returnee, and Octoberian -->
                  <div class="col-xxl-8 col-md-12 mt-4">
                    <div class="card info-card" style="cursor: default;">
                      <div class="card-body">
                        <h5>Yearly Student Status</h5>
                        <canvas id="statusComparisonBarChart" width="800" height="400"></canvas>
                      </div>
                    </div>
                  </div>

                  <!-- Grouped Bar Chart for Graduated, Failed, Dropped Out -->
                  <div class="col-xxl-8 col-md-12 mt-4">
                    <div class="card info-card" style="cursor: default;">
                      <div class="card-body">
                        <h5>Annual Student Outcome Trends</h5>
                        <canvas id="statusComparisonBarChartGFDO" width="800" height="400"></canvas>
                      </div>
                    </div>
                  </div>
                 
        
                      </div>
                    </div>
        
                  </div>         
        
                </div>
              </div>
        
            </div>

            

          </section>

          @include('admin.program_modal')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var salesCard = document.getElementById('salesCard');
    var studentsModal = new bootstrap.Modal(document.getElementById('studentsModal'));
    var coursesCard = document.getElementById('coursesCard');
    var coursesModal = new bootstrap.Modal(document.getElementById('coursesModal'));
    var departmentCard = document.getElementById('departmentCard');
    var departmentModal = new bootstrap.Modal(document.getElementById('departmentModal'));
    var programCard = document.getElementById('programCard');
    var programModal = new bootstrap.Modal(document.getElementById('programModal'));

    document.getElementById('testModalBtn').addEventListener('click', function() {
      studentsModal.show();
    });

    salesCard.addEventListener('click', function () {
      studentsModal.show();
    });

    coursesCard.addEventListener('click', function () {
      coursesModal.show();
    });

    departmentCard.addEventListener('click', function () {
      departmentModal.show();
    });

    programCard.addEventListener('click', function () {
      programModal.show();
    });

    // Sorting function for the table
  let sortDirection = Array(16).fill(true); // true = ascending, false = descending

    function sortTable(columnIndex) {
      const table = document.getElementById("studentsTable");
      let switching = true;
      let shouldSwitch;
      let i;
      let rows;
      let switchcount = 0;
      let dir = sortDirection[columnIndex] ? "asc" : "desc";

      while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          let x = rows[i].getElementsByTagName("TD")[columnIndex];
          let y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

          let xContent = x.textContent || x.innerText;
          let yContent = y.textContent || y.innerText;

          if (!isNaN(xContent) && !isNaN(yContent)) {
            xContent = Number(xContent);
            yContent = Number(yContent);
          }

          if (dir === "asc") {
            if (xContent > yContent) {
              shouldSwitch = true;
              break;
            }
          } else if (dir === "desc") {
            if (xContent < yContent) {
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
        } else {
          if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
      sortDirection[columnIndex] = !sortDirection[columnIndex];
    }

    window.sortTable = sortTable; // expose to global scope for inline onclick
  });

  // Fix for modal backdrop not removed issue
  document.getElementById('studentsModal').addEventListener('hidden.bs.modal', function () {
    var modalBackdrops = document.getElementsByClassName('modal-backdrop');
    while(modalBackdrops.length > 0){
      modalBackdrops[0].parentNode.removeChild(modalBackdrops[0]);
    }
    document.body.classList.remove('modal-open');
    document.body.style.paddingRight = '';
  });

  function filterStudents() {
    const input = document.getElementById('studentSearchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('studentsTable');
    const trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
      const tds = trs[i].getElementsByTagName('td');
      let show = false;
      for (let j = 0; j < tds.length; j++) {
        if (tds[j]) {
          const textValue = tds[j].textContent || tds[j].innerText;
          if (textValue.toLowerCase().indexOf(filter) > -1) {
            show = true;
            break;
          }
        }
      }
      trs[i].style.display = show ? '' : 'none';
    }
  }
</script>

<script>
  // Prepare data for pie chart
  const students = @json($students);
  const programCounts = {};

  students.forEach(student => {
    const programName = student.program ? student.program.name : 'Unknown';
    if (programCounts[programName]) {
      programCounts[programName]++;
    } else {
      programCounts[programName] = 1;
    }
  });

  const labels = Object.keys(programCounts);
  const data = Object.values(programCounts);

  const ctx = document.getElementById('studentsProgramPieChart').getContext('2d');

  // Generate distinct colors for each program dynamically
  function generateColors(numColors) {
    const colors = [];
    const hueStep = Math.floor(360 / numColors);
    for (let i = 0; i < numColors; i++) {
      const hue = i * hueStep;
      colors.push(`hsl(${hue}, 70%, 50%)`);
    }
    return colors;
  }

  const backgroundColors = generateColors(labels.length);

  const studentsProgramPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: labels,
      datasets: [{
        label: 'Students per Program',
        data: data,
        backgroundColor: backgroundColors,
        hoverOffset: 4
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
        },
        title: {
          display: false,
          text: 'Students per Program'
        }
      }
    }
  });


  // Grouped Bar Chart for Enrolled, Transferee, Returnee, Octoberian students per year
  const statusPerYearData = @json($statusPerYear);
  const statusLabels = Object.keys(statusPerYearData['Enrolled']);
  const enrolledData = Object.values(statusPerYearData['Enrolled']);
  const transfereeData = Object.values(statusPerYearData['Transferee']);
  const returneeData = Object.values(statusPerYearData['Returnee']);
  const octoberianData = Object.values(statusPerYearData['Octoberian']);

  const statusCtx = document.getElementById('statusComparisonBarChart').getContext('2d');
  const statusComparisonBarChart = new Chart(statusCtx, {
    type: 'bar',
    data: {
      labels: statusLabels,
      datasets: [
        {
          label: 'Enrolled',
          data: enrolledData,
          backgroundColor: '#4caf50', // green
        },
        {
          label: 'Transferee',
          data: transfereeData,
          backgroundColor: '#2196f3', // blue
        },
        {
          label: 'Returnee',
          data: returneeData,
          backgroundColor: '#ff9800', // orange
        },
        {
          label: 'Octoberian',
          data: octoberianData,
          backgroundColor: '#9c27b0', // purple
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: false,
          text: 'Student Status Comparison Per Year'
        }
      },
      scales: {
        x: {
          stacked: false,
        },
        y: {
          beginAtZero: true,
          precision: 0,
          stacked: false,
        }
      }
    }
  });

  //  Line Chart for Graduated, Failed, Dropped Out students per year
  const statusPerYearDataGFDO = @json($statusPerYearGFDO);
  const statusLabelsGFDO = Object.keys(statusPerYearDataGFDO['Graduated']);
  const graduatedData = Object.values(statusPerYearDataGFDO['Graduated']);
  const failedData = Object.values(statusPerYearDataGFDO['Failed']);
  const droppedOutData = Object.values(statusPerYearDataGFDO['Dropped Out']);

  const statusCtxGFDO = document.getElementById('statusComparisonBarChartGFDO').getContext('2d');
  const statusComparisonBarChartGFDO = new Chart(statusCtxGFDO, {
    type: 'line',
    data: {
      labels: statusLabelsGFDO,
      datasets: [
        {
          label: 'Graduated',
          data: graduatedData,
          borderColor: '#4caf50', // green
          backgroundColor: 'rgba(76, 175, 80, 0.2)',
          fill: true,
          tension: 0.4,
          pointStyle: 'circle',
          pointRadius: 6,
          pointHoverRadius: 8,
          borderWidth: 3,
        },
        {
          label: 'Failed',
          data: failedData,
          borderColor: '#f44336', // red
          backgroundColor: 'rgba(244, 67, 54, 0.2)',
          fill: true,
          tension: 0.4,
          pointStyle: 'rectRot',
          pointRadius: 6,
          pointHoverRadius: 8,
          borderWidth: 3,
        },
        {
          label: 'Dropped Out',
          data: droppedOutData,
          borderColor: '#ff9800', // orange
          backgroundColor: 'rgba(255, 152, 0, 0.2)',
          fill: true,
          tension: 0.4,
          pointStyle: 'triangle',
          pointRadius: 6,
          pointHoverRadius: 8,
          borderWidth: 3,
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: false,
          text: 'Graduated, Failed, Dropped Out Students Per Year'
        }
      },
      scales: {
        x: {
          stacked: false,
        },
        y: {
          beginAtZero: true,
          precision: 0,
          stacked: false,
        }
      }
    }
  });
  </script>
  
  
          @include('admin.program_modal')

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var salesCard = document.getElementById('salesCard');
    var studentsModal = new bootstrap.Modal(document.getElementById('studentsModal'));
    var coursesCard = document.getElementById('coursesCard');
    var coursesModal = new bootstrap.Modal(document.getElementById('coursesModal'));
    var departmentCard = document.getElementById('departmentCard');
    var departmentModal = new bootstrap.Modal(document.getElementById('departmentModal'));
    var programCard = document.getElementById('programCard');
    var programModal = new bootstrap.Modal(document.getElementById('programModal'));

    document.getElementById('testModalBtn').addEventListener('click', function() {
      studentsModal.show();
    });

    salesCard.addEventListener('click', function () {
      studentsModal.show();
    });

    coursesCard.addEventListener('click', function () {
      coursesModal.show();
    });

    departmentCard.addEventListener('click', function () {
      departmentModal.show();
    });

    programCard.addEventListener('click', function () {
      programModal.show();
    });

    // Sorting function for the table
  let sortDirection = Array(16).fill(true); // true = ascending, false = descending

    function sortTable(columnIndex) {
      const table = document.getElementById("studentsTable");
      let switching = true;
      let shouldSwitch;
      let i;
      let rows;
      let switchcount = 0;
      let dir = sortDirection[columnIndex] ? "asc" : "desc";

      while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          let x = rows[i].getElementsByTagName("TD")[columnIndex];
          let y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

          let xContent = x.textContent || x.innerText;
          let yContent = y.textContent || y.innerText;

          if (!isNaN(xContent) && !isNaN(yContent)) {
            xContent = Number(xContent);
            yContent = Number(yContent);
          }

          if (dir === "asc") {
            if (xContent > yContent) {
              shouldSwitch = true;
              break;
            }
          } else if (dir === "desc") {
            if (xContent < yContent) {
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
        } else {
          if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
      sortDirection[columnIndex] = !sortDirection[columnIndex];
    }

    window.sortTable = sortTable; // expose to global scope for inline onclick
  });

  // Fix for modal backdrop not removed issue
  document.getElementById('studentsModal').addEventListener('hidden.bs.modal', function () {
    var modalBackdrops = document.getElementsByClassName('modal-backdrop');
    while(modalBackdrops.length > 0){
      modalBackdrops[0].parentNode.removeChild(modalBackdrops[0]);
    }
    document.body.classList.remove('modal-open');
    document.body.style.paddingRight = '';
  });

  function filterStudents() {
    const input = document.getElementById('studentSearchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('studentsTable');
    const trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
      const tds = trs[i].getElementsByTagName('td');
      let show = false;
      for (let j = 0; j < tds.length; j++) {
        if (tds[j]) {
          const textValue = tds[j].textContent || tds[j].innerText;
          if (textValue.toLowerCase().indexOf(filter) > -1) {
            show = true;
            break;
          }
        }
      }
      trs[i].style.display = show ? '' : 'none';
    }
  }
</script>

<style>
  .sort-button {
    color: black !important;
  }
</style>

<style>
  #salesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }
</style>

<style>
  /* Modal custom styles */
  #studentsModal .modal-content {
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
  }

  #studentsModal .modal-header {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
  }

  #studentsModal .modal-title {
    font-weight: 600;
    font-size: 1.5rem;
    color: #343a40;
  }

  #studentsModal .modal-body {
    max-height: 60vh;
    overflow-y: auto;
  }

  #studentSearchInput {
    border-radius: 8px;
    padding: 6px 15px;
    font-size: 1rem;
    border: 1px solid #ced4da;
    width: 30%;
  }

  #studentsTable th, #studentsTable td {
    vertical-align: middle;
  }

  #studentsTable th {
    background-color: #e9ecef;
  }

  #studentsTable tbody tr:hover {
    background-color: #f1f3f5;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var salesCard = document.getElementById('salesCard');
    var studentsModalEl = document.getElementById('studentsModal');
    var studentsModal = new bootstrap.Modal(studentsModalEl);
    var coursesCard = document.getElementById('coursesCard');
    var coursesModal = new bootstrap.Modal(document.getElementById('coursesModal'));
    var departmentCard = document.getElementById('departmentCard');
    var departmentModal = new bootstrap.Modal(document.getElementById('departmentModal'));
    var studentInfoModal = new bootstrap.Modal(document.getElementById('studentInfoModal'));
    var studentInfoContent = document.getElementById('studentInfoContent');

    salesCard.addEventListener('click', function () {
      studentsModal.show();
    });

    coursesCard.addEventListener('click', function () {
      coursesModal.show();
    });

    departmentCard.addEventListener('click', function () {
      departmentModal.show();
    });

    // Handle view more info button click
    document.querySelectorAll('.view-more-info-btn').forEach(function(button) {
      button.addEventListener('click', function() {
        var student = JSON.parse(this.getAttribute('data-student'));
        var html = '<ul class="list-group">';
        for (var key in student) {
          if (student.hasOwnProperty(key)) {
            html += '<li class="list-group-item"><strong>' + key.replace(/_/g, ' ') + ':</strong> ' + student[key] + '</li>';
          }
        }
        html += '</ul>';
        studentInfoContent.innerHTML = html;
        studentInfoModal.show();
      });
    });

    // Explicit close button handlers for studentsModal close buttons
    var studentsModalCloseBtns = studentsModalEl.querySelectorAll('.btn-close, .btn-secondary');
    studentsModalCloseBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        studentsModal.hide();
      });
    });

    // Sorting function for the students table
  let sortDirection = Array(16).fill(true); // true = ascending, false = descending

    function sortTable(columnIndex) {
      const table = document.getElementById("studentsTable");
      let switching = true;
      let shouldSwitch;
      let i;
      let rows;
      let switchcount = 0;
      let dir = sortDirection[columnIndex] ? "asc" : "desc";

      while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          let x = rows[i].getElementsByTagName("TD")[columnIndex];
          let y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

          let xContent = x.textContent || x.innerText;
          let yContent = y.textContent || y.innerText;

          if (!isNaN(xContent) && !isNaN(yContent)) {
            xContent = Number(xContent);
            yContent = Number(yContent);
          }

          if (dir === "asc") {
            if (xContent > yContent) {
              shouldSwitch = true;
              break;
            }
          } else if (dir === "desc") {
            if (xContent < yContent) {
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
        } else {
          if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
      sortDirection[columnIndex] = !sortDirection[columnIndex];
    }

    window.sortTable = sortTable; // expose to global scope for inline onclick

    // Sorting function for the courses table
    let sortDirectionCourses = Array(4).fill(true); // true = ascending, false = descending

    function sortTableCourses(columnIndex) {
      const table = document.getElementById("coursesTable");
      let switching = true;
      let shouldSwitch;
      let i;
      let rows;
      let switchcount = 0;
      let dir = sortDirectionCourses[columnIndex] ? "asc" : "desc";

      while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
          shouldSwitch = false;
          let x = rows[i].getElementsByTagName("TD")[columnIndex];
          let y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

          let xContent = x.textContent || x.innerText;
          let yContent = y.textContent || y.innerText;

          if (!isNaN(xContent) && !isNaN(yContent)) {
            xContent = Number(xContent);
            yContent = Number(yContent);
          }

          if (dir === "asc") {
            if (xContent > yContent) {
              shouldSwitch = true;
              break;
            }
          } else if (dir === "desc") {
            if (xContent < yContent) {
              shouldSwitch = true;
              break;
            }
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
        } else {
          if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
      sortDirectionCourses[columnIndex] = !sortDirectionCourses[columnIndex];
    }

    window.sortTableCourses = sortTableCourses; // expose to global scope for inline onclick

let sortDirectionDepartments = Array(2).fill(true); // true = ascending, false = descending

function sortTableDepartments(columnIndex) {
  const table = document.getElementById("departmentTable");
  let switching = true;
  let shouldSwitch;
  let i;
  let rows;
  let switchcount = 0;
  let dir = sortDirectionDepartments[columnIndex] ? "asc" : "desc";

  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      let x = rows[i].getElementsByTagName("TD")[columnIndex];
      let y = rows[i + 1].getElementsByTagName("TD")[columnIndex];

      let xContent = x.textContent || x.innerText;
      let yContent = y.textContent || y.innerText;

      if (!isNaN(xContent) && !isNaN(yContent)) {
        xContent = Number(xContent);
        yContent = Number(yContent);
      }

      if (dir === "asc") {
        if (xContent > yContent) {
          shouldSwitch = true;
          break;
        }
      } else if (dir === "desc") {
        if (xContent < yContent) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount++;
    } else {
      if (switchcount === 0 && dir === "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
  sortDirectionDepartments[columnIndex] = !sortDirectionDepartments[columnIndex];
}

  window.sortTableDepartments = sortTableDepartments; // expose to global scope for inline onclick

  function filterStudents() {
    const input = document.getElementById('studentSearchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('studentsTable');
    const trs = table.getElementsByTagName('tr');

    for (let i = 1; i < trs.length; i++) {
      const tds = trs[i].getElementsByTagName('td');
      let show = false;
      for (let j = 0; j < tds.length; j++) {
        if (tds[j]) {
          const textValue = tds[j].textContent || tds[j].innerText;
          if (textValue.toLowerCase().indexOf(filter) > -1) {
            show = true;
            break;
          }
        }
      }
      trs[i].style.display = show ? '' : 'none';
    }
  }

  function filterCourses() {
    const input = document.getElementById('courseSearchInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('coursesTable');
    const tbody = table.getElementsByTagName('tbody')[0];
    const trs = tbody.getElementsByTagName('tr');

    for (let i = 0; i < trs.length; i++) {
      const tds = trs[i].getElementsByTagName('td');
      let show = false;
      for (let j = 0; j < tds.length; j++) {
        if (tds[j]) {
          const textValue = tds[j].textContent || tds[j].innerText;
          if (textValue.toLowerCase().indexOf(filter) > -1) {
            show = true;
            break;
          }
        }
      }
      trs[i].style.display = show ? '' : 'none';
    }
  }
</script>

<style>
  .sort-button {
    color: black !important;
  }
</style>

<style>
  #salesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }
</style>

<style>
  #salesCard:hover, #revenueCard:hover, #departmentCard:hover, #programCard:hover, #classesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 12px 24px rgba(0,0,0,0.5);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  #coursesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  /* Remove line below course code, title, and description headers in courses table */
  #coursesTable thead th:nth-child(1),
  #coursesTable thead th:nth-child(2),
  #coursesTable thead th:nth-child(4) {
    border-bottom: none !important;
  }
</style>



<script>
  if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
    console.log('Bootstrap Modal is loaded');
  } else {
    console.error('Bootstrap Modal is NOT loaded');
  }
</script>

</x-app-layout>
