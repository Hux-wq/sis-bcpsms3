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

                    <!-- Predictive Analytics Chart -->
                    <div class="col-xxl-6 col-md-12">
                        <a href="/predictive-analytics/breakdown" class="block">
                            <div class="card chart-card hover:shadow-lg transition-shadow duration-300">
                                <div class="card-body">
                                    <h5 class="chart-title">Predictive Analytics: Grade Category (Click to view breakdown)</h5>
                                    <div class="chart-container cursor-pointer">
                                        <canvas id="predictiveAnalyticsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </a>
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

    // Students per Program Pie Chart
    const studentsProgramCtx = document.getElementById('studentsProgramPieChart').getContext('2d');
    const programLabels = @json($programs->pluck('name'));
    const studentsPerProgram = @json($programs->map(function($program) use ($students) {
      return $students->where('program_id', $program->id)->count();
    }));
    new Chart(studentsProgramCtx, {
      type: 'pie',
      data: {
        labels: programLabels,
        datasets: [{
          label: 'Students per Program',
          data: studentsPerProgram,
          backgroundColor: [
            '#4a90e2', '#009688', '#e91e63', '#ff5722', '#ff9800', '#26a69a', '#357ABD', '#f57c00'
          ],
          borderColor: '#fff',
          borderWidth: 1
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
                size: 14
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
            padding: 12
          }
        }
      }
    });

    // Yearly Student Status Bar Chart
    const yearlyStatusCtx = document.getElementById('statusComparisonBarChart').getContext('2d');
    const years = Object.keys(@json($statusPerYear['Enrolled']));
    const enrolledData = Object.values(@json($statusPerYear['Enrolled']));
    const transfereeData = Object.values(@json($statusPerYear['Transferee']));
    const returneeData = Object.values(@json($statusPerYear['Returnee']));
    const octoberianData = Object.values(@json($statusPerYear['Octoberian']));
    new Chart(yearlyStatusCtx, {
      type: 'bar',
      data: {
        labels: years,
        datasets: [
          {
            label: 'Enrolled',
            data: enrolledData,
            backgroundColor: 'rgba(74, 144, 226, 0.7)'
          },
          {
            label: 'Transferee',
            data: transfereeData,
            backgroundColor: 'rgba(0, 150, 136, 0.7)'
          },
          {
            label: 'Returnee',
            data: returneeData,
            backgroundColor: 'rgba(233, 30, 99, 0.7)'
          },
          {
            label: 'Octoberian',
            data: octoberianData,
            backgroundColor: 'rgba(255, 87, 34, 0.7)'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 5
            }
          }
        },
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              font: {
                family: "'Poppins', sans-serif",
                size: 14
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
            padding: 12
          }
        }
      }
    });

    // Annual Student Outcome Trends Bar Chart
    const annualOutcomeCtx = document.getElementById('statusComparisonBarChartGFDO').getContext('2d');
    const yearsGFDO = Object.keys(@json($statusPerYearGFDO['Graduated']));
    const graduatedData = Object.values(@json($statusPerYearGFDO['Graduated']));
    const failedData = Object.values(@json($statusPerYearGFDO['Failed']));
    const droppedData = Object.values(@json($statusPerYearGFDO['Dropped Out']));
    new Chart(annualOutcomeCtx, {
      type: 'bar',
      data: {
        labels: yearsGFDO,
        datasets: [
          {
            label: 'Graduated',
            data: graduatedData,
            backgroundColor: 'rgba(56, 142, 60, 0.7)'
          },
          {
            label: 'Failed',
            data: failedData,
            backgroundColor: 'rgba(211, 47, 47, 0.7)'
          },
          {
            label: 'Dropped Out',
            data: droppedData,
            backgroundColor: 'rgba(245, 124, 0, 0.7)'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 5
            }
          }
        },
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              font: {
                family: "'Poppins', sans-serif",
                size: 14
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
            padding: 12
          }
        }
      }
    });

    // Use server-passed predictive analytics data and render chart
    const predictionCounts = @json($predictionCounts);

    const ctxPredictive = document.getElementById('predictiveAnalyticsChart').getContext('2d');
    new Chart(ctxPredictive, {
      type: 'doughnut',
      data: {
        labels: ['Pass', 'At Risk', 'Fail'],
        datasets: [{
          label: 'Predicted Grade Category',
          data: [
            predictionCounts['Pass'] || 0,
            predictionCounts['At Risk'] || 0,
            predictionCounts['Fail'] || 0
          ],
          backgroundColor: [
            'rgba(76, 175, 80, 0.7)', // green
            'rgba(255, 193, 7, 0.7)', // amber for at risk
            'rgba(244, 67, 54, 0.7)'  // red
          ],
          borderColor: [
            'rgba(76, 175, 80, 1)',
            'rgba(255, 193, 7, 1)',
            'rgba(244, 67, 54, 1)'
          ],
          borderWidth: 1
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
                size: 14
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
            padding: 12
          }
        }
      }
    });
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