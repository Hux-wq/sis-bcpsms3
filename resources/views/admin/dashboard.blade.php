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
                    <div class="col-xl-3 col-md-3">
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
                    <div class="col-xl-3 col-md-3">
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
                    <div class="col-xl-3 col-md-3">
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
                    <div class="col-xl-3 col-md-3">       
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
                      <!-- Predictive Analytics Chart -->
                    <div class="col-xxl-4 col-md-6">
                        <a href="/predictive-analytics/breakdown" class="block">
                            <div class="card chart-card hover:shadow-lg transition-shadow duration-300">
                                <div class="card-body">
                                    <h5 class="chart-title">Predictive Analytics: Grade Category</h5>
                                    <div class="chart-container cursor-pointer">
                                        <canvas id="predictiveAnalyticsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </a>
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

    // Annual Student Outcome Trends Chart
const annualOutcomeCtx = document.getElementById('statusComparisonBarChartGFDO').getContext('2d');
const yearsGFDO = Object.keys(@json($statusPerYearGFDO['Graduated']));
const graduatedData = Object.values(@json($statusPerYearGFDO['Graduated']));
const failedData = Object.values(@json($statusPerYearGFDO['Failed']));
const droppedData = Object.values(@json($statusPerYearGFDO['Dropped Out']));
const chartArea = annualOutcomeCtx.canvas.getBoundingClientRect();
const gradientHeight = chartArea.height || 400;

const gradientGreen = annualOutcomeCtx.createLinearGradient(0, 0, 0, gradientHeight);
gradientGreen.addColorStop(0, 'rgba(46, 204, 113, 0.9)');
gradientGreen.addColorStop(0.3, 'rgba(46, 204, 113, 0.6)');
gradientGreen.addColorStop(0.7, 'rgba(46, 204, 113, 0.3)');
gradientGreen.addColorStop(1, 'rgba(46, 204, 113, 0.05)');

const gradientRed = annualOutcomeCtx.createLinearGradient(0, 0, 0, gradientHeight);
gradientRed.addColorStop(0, 'rgba(231, 76, 60, 0.9)');
gradientRed.addColorStop(0.3, 'rgba(231, 76, 60, 0.6)');
gradientRed.addColorStop(0.7, 'rgba(231, 76, 60, 0.3)');
gradientRed.addColorStop(1, 'rgba(231, 76, 60, 0.05)');

const gradientOrange = annualOutcomeCtx.createLinearGradient(0, 0, 0, gradientHeight);
gradientOrange.addColorStop(0, 'rgba(255, 149, 0, 0.9)');
gradientOrange.addColorStop(0.3, 'rgba(255, 149, 0, 0.6)');
gradientOrange.addColorStop(0.7, 'rgba(255, 149, 0, 0.3)');
gradientOrange.addColorStop(1, 'rgba(255, 149, 0, 0.05)');

new Chart(annualOutcomeCtx, {
  type: 'line',
  data: {
    labels: yearsGFDO,
    datasets: [
      {
        label: 'Graduated',
        data: graduatedData,
        borderColor: '#2ecc71',
        backgroundColor: gradientGreen,
        borderWidth: 3,
        pointBackgroundColor: '#27ae60',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 3,
        pointRadius: 6,
        pointHoverRadius: 8,
        pointHoverBackgroundColor: '#2ecc71',
        pointHoverBorderColor: '#ffffff',
        pointHoverBorderWidth: 3,
        fill: true,
        tension: 0.4,
        shadowColor: 'rgba(46, 204, 113, 0.3)',
        shadowBlur: 10,
        shadowOffsetX: 0,
        shadowOffsetY: 4
      },
      {
        label: 'Failed',
        data: failedData,
        borderColor: '#e74c3c',
        backgroundColor: gradientRed,
        borderWidth: 3,
        pointBackgroundColor: '#c0392b',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 3,
        pointRadius: 6,
        pointHoverRadius: 8,
        pointHoverBackgroundColor: '#e74c3c',
        pointHoverBorderColor: '#ffffff',
        pointHoverBorderWidth: 3,
        fill: true,
        tension: 0.4,
        shadowColor: 'rgba(231, 76, 60, 0.3)',
        shadowBlur: 10,
        shadowOffsetX: 0,
        shadowOffsetY: 4
      },
      {
        label: 'Dropped Out',
        data: droppedData,
        borderColor: '#ff9500',
        backgroundColor: gradientOrange,
        borderWidth: 3,
        pointBackgroundColor: '#e67e22',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 3,
        pointRadius: 6,
        pointHoverRadius: 8,
        pointHoverBackgroundColor: '#ff9500',
        pointHoverBorderColor: '#ffffff',
        pointHoverBorderWidth: 3,
        fill: true,
        tension: 0.4,
        shadowColor: 'rgba(255, 149, 0, 0.3)',
        shadowBlur: 10,
        shadowOffsetX: 0,
        shadowOffsetY: 4
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: {
      intersect: false,
      mode: 'index'
    },
    animation: {
      duration: 2000,
      easing: 'easeInOutQuart',
      onComplete: function() {
        // Add a subtle glow effect after animation
        this.canvas.style.filter = 'drop-shadow(0 0 10px rgba(0,0,0,0.1))';
      }
    },
    plugins: {
      legend: {
        position: 'top',
        align: 'center',
        labels: {
          font: {
            family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
            size: 14,
            weight: '600'
          },
          padding: 25,
          usePointStyle: true,
          pointStyle: 'circle',
          boxWidth: 12,
          boxHeight: 12,
          color: '#2c3e50',
          generateLabels: function(chart) {
            const original = Chart.defaults.plugins.legend.labels.generateLabels;
            const labels = original.call(this, chart);
            
            // Add custom styling to legend labels
            labels.forEach(label => {
              label.fillStyle = chart.data.datasets[label.datasetIndex].borderColor;
              label.strokeStyle = 'transparent';
            });
            
            return labels;
          }
        }
      },
      tooltip: {
        backgroundColor: 'rgba(255, 255, 255, 0.95)',
        titleColor: '#2c3e50',
        bodyColor: '#34495e',
        borderColor: '#bdc3c7',
        borderWidth: 1,
        cornerRadius: 12,
        displayColors: true,
        usePointStyle: true,
        padding: 16,
        bodyFont: {
          family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
          size: 13,
          weight: '500'
        },
        titleFont: {
          family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
          size: 15,
          weight: '700'
        },
        callbacks: {
          title: function(context) {
            return `Academic Year ${context[0].label}`;
          },
          label: function(context) {
            const label = context.dataset.label;
            const value = context.parsed.y;
            const percentage = ((value / context.chart.data.datasets.reduce((sum, dataset) => 
              sum + dataset.data[context.dataIndex], 0)) * 100).toFixed(1);
            
            return `${label}: ${value} students (${percentage}%)`;
          }
        },
        external: function(context) {
          // Add subtle shadow to tooltip
          const tooltip = context.tooltip;
          if (tooltip.opacity === 0) return;
          
          const canvas = context.chart.canvas;
          canvas.style.cursor = 'pointer';
        }
      }
    },
    scales: {
      x: {
        display: true,
        title: {
          display: true,
          text: 'Academic Year',
          font: {
            family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
            size: 14,
            weight: '600'
          },
          color: '#2c3e50',
          padding: 20
        },
        grid: {
          display: true,
          color: 'rgba(189, 195, 199, 0.3)',
          lineWidth: 1,
          drawBorder: false
        },
        ticks: {
          font: {
            family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
            size: 12,
            weight: '500'
          },
          color: '#7f8c8d',
          padding: 10
        },
        border: {
          display: false
        }
      },
      y: {
        display: true,
        beginAtZero: true,
        title: {
          display: true,
          text: 'Number of Students',
          font: {
            family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
            size: 14,
            weight: '600'
          },
          color: '#2c3e50',
          padding: 20
        },
        grid: {
          display: true,
          color: 'rgba(189, 195, 199, 0.3)',
          lineWidth: 1,
          drawBorder: false
        },
        ticks: {
          stepSize: 5,
          font: {
            family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
            size: 12,
            weight: '500'
          },
          color: '#7f8c8d',
          padding: 10,
          callback: function(value) {
            return value;
          }
        },
        border: {
          display: false
        }
      }
    },
    elements: {
      line: {
        borderJoinStyle: 'round',
        borderCapStyle: 'round'
      },
      point: {
        hoverBorderWidth: 4
      }
    },
    onHover: function(event, activeElements) {
      event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
    }
  }
});
// Use server-passed predictive analytics data and render chart
    const predictionCounts = @json($predictionCounts);
const ctxPredictive = document.getElementById('predictiveAnalyticsChart').getContext('2d');

const totalStudentsInSystem = {{ $student_enrolled_count }};

// Prepare data and labels for the chart
const labels = ['Pass', 'At Risk', 'Fail'];
const dataValues = [
  predictionCounts['Pass'] || 0,
  predictionCounts['At Risk'] || 0,
  predictionCounts['Fail'] || 0
];

// Define gradients for each category
const passGradient = ctxPredictive.createRadialGradient(0, 0, 0, 0, 0, 150);
passGradient.addColorStop(0, 'rgba(46, 204, 113, 1)');
passGradient.addColorStop(0.7, 'rgba(39, 174, 96, 0.9)');
passGradient.addColorStop(1, 'rgba(27, 134, 74, 0.8)');

const riskGradient = ctxPredictive.createRadialGradient(0, 0, 0, 0, 0, 150);
riskGradient.addColorStop(0, 'rgba(255, 193, 7, 1)');
riskGradient.addColorStop(0.7, 'rgba(255, 167, 38, 0.9)');
riskGradient.addColorStop(1, 'rgba(255, 143, 0, 0.8)');

const failGradient = ctxPredictive.createRadialGradient(0, 0, 0, 0, 0, 150);
failGradient.addColorStop(0, 'rgba(231, 76, 60, 1)');
failGradient.addColorStop(0.7, 'rgba(192, 57, 43, 0.9)');
failGradient.addColorStop(1, 'rgba(155, 46, 35, 0.8)');

const backgroundColors = [
  passGradient,
  riskGradient,
  failGradient
];

const predictiveChart = new Chart(ctxPredictive, {
  type: 'doughnut',
  data: {
    labels: labels,
    datasets: [{
      label: 'Predicted Grade Category',
      data: dataValues,
      backgroundColor: backgroundColors,
      borderColor: [
        '#ffffff',
        '#ffffff',
        '#ffffff',
        '#ffffff'
      ].slice(0, labels.length),
      borderWidth: 4,
      hoverBorderWidth: 6,
      hoverOffset: 15,
      borderRadius: 8,
      spacing: 3,
      // Add shadow effect
      shadowOffsetX: 0,
      shadowOffsetY: 4,
      shadowBlur: 15,
      shadowColor: 'rgba(0, 0, 0, 0.2)'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '65%', // Makes the doughnut thicker
    radius: '90%',
    animation: {
      animateRotate: true,
      animateScale: true,
      duration: 2000,
      easing: 'easeInOutQuart',
      onComplete: function() {
        // Add subtle glow effect after animation
        this.canvas.style.filter = 'drop-shadow(0 4px 20px rgba(0,0,0,0.1))';
      }
    },
    interaction: {
      intersect: false,
      mode: 'nearest'
    },
    plugins: {
      legend: {
        position: 'bottom',
        align: 'center',
        labels: {
          font: {
            family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
            size: 14,
            weight: '600'
          },
          padding: 25,
          usePointStyle: true,
          pointStyle: 'circle',
          boxWidth: 15,
          boxHeight: 15,
          color: '#2c3e50',
          textAlign: 'center',
          
        }
      },
      tooltip: {
        backgroundColor: 'rgba(255, 255, 255, 0.98)',
        titleColor: '#2c3e50',
        bodyColor: '#34495e',
        borderColor: '#e0e6ed',
        borderWidth: 2,
        cornerRadius: 12,
        displayColors: true,
        usePointStyle: true,
        padding: 20,
        titleAlign: 'center',
        bodyAlign: 'left',
        caretSize: 8,
        bodyFont: {
          family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
          size: 14,
          weight: '500'
        },
        titleFont: {
          family: "'Inter', 'Segoe UI', 'Roboto', sans-serif",
          size: 16,
          weight: '700'
        },
        callbacks: {
          title: function(context) {
            return `${context[0].label} Students`;
          },
          label: function(context) {
            const value = context.parsed;
            const percentage = totalStudentsInSystem > 0 ? ((value / totalStudentsInSystem) * 100).toFixed(1) : '0.0';
            const total = context.dataset.data.reduce((a, b) => a + b, 0);
            
            return [
              `Count: ${value} students`,
              `Percentage: ${percentage}%`,
              `Total Students in System: ${totalStudentsInSystem}`
            ];
          }
        },
        filter: function(tooltipItem) {
          return tooltipItem.parsed > 0; // Only show tooltip for non-zero values
        }
      }
    },
    onHover: function(event, activeElements) {
      event.native.target.style.cursor = activeElements.length > 0 ? 'pointer' : 'default';
      
      // Add subtle scale effect on hover
      if (activeElements.length > 0) {
        this.canvas.style.transform = 'scale(1.02)';
        this.canvas.style.transition = 'transform 0.2s ease';
      } else {
        this.canvas.style.transform = 'scale(1)';
      }
    },
    elements: {
      arc: {
        borderJoinStyle: 'round'
      }
    }
  },
  plugins: [{
    id: 'centerText',
    afterDraw: function(chart) {
      if (totalStudentsInSystem === 0) return;
      
      const ctx = chart.ctx;
      const centerX = chart.chartArea.left + (chart.chartArea.right - chart.chartArea.left) / 2;
      const centerY = chart.chartArea.top + (chart.chartArea.bottom - chart.chartArea.top) / 2;
      
      ctx.save();
      
      // Main total number
      ctx.font = "bold 32px 'Inter', 'Segoe UI', 'Roboto', sans-serif";
      ctx.fillStyle = '#2c3e50';
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText(totalStudentsInSystem, centerX, centerY - 10);
      
      // "Total Students" label
      ctx.font = "600 14px 'Inter', 'Segoe UI', 'Roboto', sans-serif";
      ctx.fillStyle = '#7f8c8d';
      ctx.fillText('Total Students', centerX, centerY + 20);
      
      ctx.restore();
    }
  }]
});

// Add click animation
predictiveChart.canvas.addEventListener('click', function(event) {
  this.style.transform = 'scale(0.98)';
  setTimeout(() => {
    this.style.transform = 'scale(1)';
  }, 150);
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