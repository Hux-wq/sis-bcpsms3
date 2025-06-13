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
                <div class="row g-4">
                    <!-- Enrolled Studentles Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card dashboard-card" id="salesCard" data-bs-toggle="modal" data-bs-target="#studentsModal">  
                            <div class="card-body">    
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-user-graduate"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="card-title">Students Enrolled</h5>  
                                        <h3 class="card-value">{{$student_enrolled_count}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Courses Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card dashboard-card" id="coursesCard" data-bs-toggle="modal" data-bs-target="#coursesModal">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="card-title">Courses</h5>
                                        <h3 class="card-value">{{$courses_count}}</h3>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>

                    <!-- Department Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card customers-card dashboard-card" id="departmentCard" data-bs-toggle="modal" data-bs-target="#departmentModal">     
                            <div class="card-body">      
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-building"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="card-title">Department</h5>
                                        <h3 class="card-value">{{$departments_count}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Program Card -->
                    <div class="col-xxl-4 col-md-6">       
                        <div class="card info-card revenue-card dashboard-card" id="programCard" data-bs-toggle="modal" data-bs-target="#programModal">     
                            <div class="card-body">     
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="card-title">Program</h5>
                                        <h3 class="card-value">{{$programs_count}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Annual Student Outcomes Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card dashboard-card" id="gfdoCard" data-bs-toggle="modal" data-bs-target="#gfdoStudentsModal">
                            <div class="card-body">
                                <div class="d-flex align-items-center p-3">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h5 class="card-title">Annual Student Outcomes</h5>
                                        <div class="outcome-stats">
                                            <div class="outcome-item graduated">
                                                <span class="outcome-label">Graduated:</span>
                                                <span class="outcome-value">{{ $statusPerYearGFDO['Graduated']['2025'] ?? 0 }}</span>
                                            </div>
                                            <div class="outcome-item failed">
                                                <span class="outcome-label">Failed:</span>
                                                <span class="outcome-value">{{ $statusPerYearGFDO['Failed']['2025'] ?? 0 }}</span>
                                            </div>
                                            <div class="outcome-item dropped">
                                                <span class="outcome-label">Dropped Out:</span>
                                                <span class="outcome-value">{{ $statusPerYearGFDO['Dropped Out']['2025'] ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Students per Program Chart -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card chart-card">
                            <div class="card-body">
                                <h5 class="chart-title">Students per Program</h5>
                                <div class="chart-container">
                                    <canvas id="studentsProgramPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Yearly Student Status Chart -->
                    <div class="col-xxl-6 col-md-12">
                        <div class="card chart-card">
                            <div class="card-body">
                                <h5 class="chart-title">Yearly Student Status</h5>
                                <div class="chart-container">
                                    <canvas id="statusComparisonBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Annual Student Outcome Trends Chart -->
                    <div class="col-xxl-6 col-md-12">
                        <div class="card chart-card">
                            <div class="card-body">
                                <h5 class="chart-title">Annual Student Outcome Trends</h5>
                                <div class="chart-container">
                                    <canvas id="statusComparisonBarChartGFDO"></canvas>
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
    var gfdoCard = document.getElementById('gfdoCard');
    var gfdoStudentsModal = new bootstrap.Modal(document.getElementById('gfdoStudentsModal'));

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
    
    gfdoCard.addEventListener('click', function () {
      gfdoStudentsModal.show();
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
      colors.push(`hsl(${hue}, 70%, 60%)`);
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
        borderColor: 'rgba(255, 255, 255, 0.8)',
        borderWidth: 2,
        hoverOffset: 8
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            },
            padding: 20,
            usePointStyle: true,
            pointStyle: 'circle'
          }
        },
        tooltip: {
          backgroundColor: 'rgba(255, 255, 255, 0.9)',
          titleColor: '#333',
          bodyColor: '#333',
          bodyFont: {
            family: "'Poppins', sans-serif",
            size: 13
          },
          titleFont: {
            family: "'Poppins', sans-serif",
            size: 14,
            weight: 'bold'
          },
          borderColor: '#ddd',
          borderWidth: 1,
          padding: 12,
          boxPadding: 6,
          usePointStyle: true
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
          backgroundColor: 'rgba(63, 81, 181, 0.75)', // indigo
          borderColor: 'rgba(63, 81, 181, 1)',
          borderWidth: 2,
          borderRadius: 4,
          hoverBackgroundColor: 'rgba(63, 81, 181, 0.9)',
        },
        {
          label: 'Transferee',
          data: transfereeData,
          backgroundColor: 'rgba(0, 150, 136, 0.75)', // teal
          borderColor: 'rgba(0, 150, 136, 1)',
          borderWidth: 2,
          borderRadius: 4,
          hoverBackgroundColor: 'rgba(0, 150, 136, 0.9)',
        },
        {
          label: 'Returnee',
          data: returneeData,
          backgroundColor: 'rgba(255, 152, 0, 0.75)', // orange
          borderColor: 'rgba(255, 152, 0, 1)',
          borderWidth: 2,
          borderRadius: 4,
          hoverBackgroundColor: 'rgba(255, 152, 0, 0.9)',
        },
        {
          label: 'Octoberian',
          data: octoberianData,
          backgroundColor: 'rgba(156, 39, 176, 0.75)', // purple
          borderColor: 'rgba(156, 39, 176, 1)',
          borderWidth: 2,
          borderRadius: 4,
          hoverBackgroundColor: 'rgba(156, 39, 176, 0.9)',
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'top',
          labels: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            },
            usePointStyle: true,
            padding: 20
          }
        },
        tooltip: {
          backgroundColor: 'rgba(255, 255, 255, 0.9)',
          titleColor: '#333',
          bodyColor: '#333',
          bodyFont: {
            family: "'Poppins', sans-serif",
            size: 13
          },
          titleFont: {
            family: "'Poppins', sans-serif",
            size: 14,
            weight: 'bold'
          },
          borderColor: '#ddd',
          borderWidth: 1,
          padding: 12
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            }
          }
        },
        y: {
          beginAtZero: true,
          precision: 0,
          grid: {
            color: 'rgba(0, 0, 0, 0.05)'
          },
          ticks: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            }
          }
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
          borderColor: 'rgba(76, 175, 80, 1)', // green
          backgroundColor: 'rgba(76, 175, 80, 0.15)',
          fill: true,
          tension: 0.4,
          pointStyle: 'circle',
          pointRadius: 6,
          pointHoverRadius: 8,
          borderWidth: 3,
          pointBackgroundColor: 'rgba(76, 175, 80, 1)',
        },
        {
          label: 'Failed',
          data: failedData,
          borderColor: 'rgba(244, 67, 54, 1)', // red
          backgroundColor: 'rgba(244, 67, 54, 0.15)',
          fill: true,
          tension: 0.4,
          pointStyle: 'rectRot',
          pointRadius: 6,
          pointHoverRadius: 8,
          borderWidth: 3,
          pointBackgroundColor: 'rgba(244, 67, 54, 1)',
        },
        {
          label: 'Dropped Out',
          data: droppedOutData,
          borderColor: 'rgba(255, 152, 0, 1)', // orange
          backgroundColor: 'rgba(255, 152, 0, 0.15)',
          fill: true,
          tension: 0.4,
          pointStyle: 'triangle',
          pointRadius: 6,
          pointHoverRadius: 8,
          borderWidth: 3,
          pointBackgroundColor: 'rgba(255, 152, 0, 1)',
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'top',
          labels: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            },
            usePointStyle: true,
            padding: 20
          }
        },
        tooltip: {
          backgroundColor: 'rgba(255, 255, 255, 0.9)',
          titleColor: '#333',
          bodyColor: '#333',
          bodyFont: {
            family: "'Poppins', sans-serif",
            size: 13
          },
          titleFont: {
            family: "'Poppins', sans-serif",
            size: 14,
            weight: 'bold'
          },
          borderColor: '#ddd',
          borderWidth: 1,
          padding: 12
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            }
          }
        },
        y: {
          beginAtZero: true,
          precision: 0,
          grid: {
            color: 'rgba(0, 0, 0, 0.05)'
          },
          ticks: {
            font: {
              family: "'Poppins', sans-serif",
              size: 12
            }
          }
        }
      }
    }
  });
</script>

<style>
  /* Import Google Font */
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
  
  /* Global styles */
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f9f9f9;
    color: #222;
  }
  
  .section.dashboard {
    padding: 20px 0;
  }
  
  /* Card styles */
  .card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    transition: all 0.3s ease;
    margin-bottom: 20px;
    background-color: #ffffff !important;
    overflow: hidden;
  }
  
  .dashboard-card {
    cursor: pointer;
    position: relative;
  }
  
  .dashboard-card::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 100%);
    pointer-events: none;
    border-radius: 12px;
  }
  
  .dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
  }
  
  .card-body {
    padding: 1.5rem;
  }
  
  /* Card icon styles */
  .card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #4a90e2 0%, #357ABD 100%);
    color: white;
    font-size: 24px;
    box-shadow: 0 6px 18px rgba(74, 144, 226, 0.5);
    transition: all 0.3s ease;
    border-radius: 50%;
  }
  
  .dashboard-card:hover .card-icon {
    transform: scale(1.15);
  }
  
  .sales-card .card-icon {
    background: linear-gradient(135deg, #4a90e2 0%, #357ABD 100%);
  }
  
  .revenue-card .card-icon {
    background: linear-gradient(135deg, #009688 0%, #26a69a 100%);
  }
  
  .customers-card .card-icon {
    background: linear-gradient(135deg, #e91e63 0%, #ff4081 100%);
  }
  
  #gfdoCard .card-icon {
    background: linear-gradient(135deg, #ff5722 0%, #ff9800 100%);
  }
  
  /* Card text styles */
  .card-title {
    color: #333;
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
  }
  
  .card-value {
    color: #111;
    font-size: 30px;
    font-weight: 700;
    margin: 0;
  }
  
  /* Chart card styles */
  .chart-card {
    padding: 10px;
  }
  
  .chart-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 20px;
    color: #111;
    text-align: center;
  }
  
  .chart-container {
    position: relative;
    height: 320px;
    width: 100%;
  }
  
  canvas {
    background-color: transparent !important;
  }
  
  /* Annual Student Outcomes styling */
  .outcome-stats {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 5px;
  }
  
  .outcome-item {
    display: flex;
    justify-content: space-between;
    padding: 6px 10px;
    border-radius: 8px;
    font-weight: 600;
    color: #222;
  }
  
  .outcome-item.graduated {
    background-color: rgba(56, 142, 60, 0.2);
    border-left: 5px solid #388e3c;
  }
  
  .outcome-item.failed {
    background-color: rgba(211, 47, 47, 0.2);
    border-left: 5px solid #d32f2f;
  }
  
  .outcome-item.dropped {
    background-color: rgba(245, 124, 0, 0.2);
    border-left: 5px solid #f57c00;
  }
  
  .outcome-label {
    font-weight: 600;
  }
  
  .outcome-value {
    font-weight: 700;
  }
  
  /* Media queries for responsiveness */
  @media (max-width: 992px) {
    .chart-container {
      height: 280px;
    }
  }
  
  @media (max-width: 768px) {
    .section.dashboard {
      padding: 12px 0;
    }
    
    .card-body {
      padding: 1.2rem;
    }
    
    .card-icon {
      width: 54px;
      height: 54px;
      font-size: 22px;
    }
    
    .card-value {
      font-size: 26px;
    }
  }
</style>
</x-app-layout>