<x-app-layout>

    <x-page-title header="Dashboard" :links="['dashboard' => '/dashboard']"/>
    
        <!----------------------All MODALS---------------------->
                  @include('admin.student-enrolled-modal')
                  @include('admin.courses-modal')
                  @include('admin.department-modal')
                  @include('admin.program_modal')
                  @include('admin.gfdo-students-modal')
        <!---------------------END OF All MODALS----------------->     
          <section class="section dashboard">
            <div class="row">       
              <div class="col-12">
                <div class="row">
                  <!-- Enrolled Studentles Card -->
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
                </div>

                  <!-- Courses Card -->
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

                  <!-- Department Card -->
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
        
                  <!-- PRogram Card -->
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
                        <!---HEADER FOR CHART---->
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

                  <div class="col-xxl-4 col-md-6 mt-4">
                    <div class="card info-card hover-effect" id="gfdoCard" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#gfdoStudentsModal">
                      <div class="card-body hover-effect" style="cursor:pointer;">
                        <div class="d-flex align-items-center p-3">
                          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user text-dark"></i>
                          </div>
                          <div class="ps-3">
                            <h4>Anual Student Outcomes</h4>
                            <h6>
                              Graduated: {{ $statusPerYearGFDO['Graduated']['2025'] ?? 0 }}<br>
                              Failed: {{ $statusPerYearGFDO['Failed']['2025'] ?? 0 }}<br>
                              Dropped Out: {{ $statusPerYearGFDO['Dropped Out']['2025'] ?? 0 }}
                            </h6>
                          </div>
                        </div>
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
  });
  
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

<style>
  /* New background colors for cards and canvas */
  .card {
    background-color: #d0e4f7 !important; /* Slightly darker tone than AliceBlue */
  }
  canvas {
    background-color: #f8f9fa !important; /* Slightly darker off-white background for charts */
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }

  .sort-button {
    color: black !important;
  }

  #salesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  .sort-button {
    color: black !important;
  }
  #salesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }



  #salesCard:hover, #revenueCard:hover, #departmentCard:hover, #programCard:hover, #classesCard:hover {
    background-color: #e0e0e0;
    box-shadow: 0 12px 24px rgba(0,0,0,0.5);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
  }

  #gfdoCard:hover {
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

</style>
</x-app-layout>
