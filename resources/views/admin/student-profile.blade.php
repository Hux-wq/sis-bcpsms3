<x-app-layout>

    <x-page-title header="{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}" :links='["student" => "/student", "profile" => "/student/profile/{$student->id}"]'/>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Enhanced Design</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #667eea;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-color: #f093fb;
            --success-color: #4ade80;
            --warning-color: #facc15;
            --danger-color: #f87171;
            --info-color: #60a5fa;
            --dark-color: #1e293b;
            --light-bg: #f8fafc;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --card-shadow-hover: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --border-radius: 12px;
            --border-radius-lg: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container-fluid {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem;
            border-radius: var(--border-radius-lg);
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }

        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 0.5rem 1rem;
        }

        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .card {
            background: white;
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-2px);
        }

        .profile-card {
            text-align: center;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .profile-img:hover {
            transform: scale(1.05);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .student-number {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #22c55e 100%);
            color: white;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
        }

        .details-section {
            padding: 1.5rem;
        }

        .details-section h5 {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s ease;
        }

        .detail-row:hover {
            background-color: #f8fafc;
            border-radius: 8px;
            margin: 0 -0.5rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 500;
            color: #64748b;
            min-width: 120px;
        }

        .detail-value {
            font-weight: 400;
            color: var(--dark-color);
            text-transform: capitalize;
        }

        .stats-card {
            background: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stats-card:hover::before {
            transform: scaleX(1);
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--card-shadow-hover);
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stats-present { background: linear-gradient(135deg, var(--success-color) 0%, #22c55e 100%); }
        .stats-absent { background: linear-gradient(135deg, var(--danger-color) 0%, #ef4444 100%); }
        .stats-late { background: linear-gradient(135deg, var(--warning-color) 0%, #f59e0b 100%); }
        .stats-total { background: linear-gradient(135deg, var(--info-color) 0%, #3b82f6 100%); }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .stats-label {
            color: #64748b;
            font-weight: 500;
        }

        .billing-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: var(--border-radius);
            padding: 2rem;
            margin: 2rem 0;
        }

        .billing-amount {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .expense-list {
            list-style: none;
            padding: 0;
        }

        .expense-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
        }

        .expense-list li:last-child {
            border-bottom: none;
        }

        .nav-tabs {
            border: none;
            margin-bottom: 1.5rem;
        }

        .nav-tabs .nav-link {
            border: none;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 8px;
            margin-right: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background: var(--primary-gradient);
            color: white;
            box-shadow: var(--card-shadow);
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table tbody td {
            padding: 1rem;
            border-color: #e2e8f0;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .modal-content {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }

        .modal-header {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .text-success { color: var(--success-color) !important; }
        .text-danger { color: var(--danger-color) !important; }
        .text-warning { color: #f59e0b !important; }
        .text-info { color: var(--info-color) !important; }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 1rem;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
            
            .stats-card {
                margin-bottom: 1rem;
            }
            
            .detail-row {
                flex-direction: column;
                gap: 0.25rem;
            }
            
            .detail-label {
                min-width: auto;
                font-size: 0.875rem;
            }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-up {
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
        <!-- Main Profile Section -->
        <div class="row g-4 slide-up">
            <!-- Profile Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="profile-card">
                              <form id="createAccountForm">
                                @csrf
                                
                            <img src="/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <h1 class="text-capitalize fs-5  fw-bold">{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</h1>
                            <h6>{{$student->student_number}}</h6>
                            <input type="hidden" name="email" value="{{$student->student_number . '@student.com'}}">
                            <input type="hidden" name="password" value="{{$student->last_name . '1234!'}}">
                            <input type="hidden" name="id" value="{{$student->id}}">
                            <button type="button" class="btn btn-success" id="createAccountButton"
                            @if(in_array(strtolower($student->enrollment_status), ['graduated', 'failed', 'dropped out'])) disabled title="Account creation disabled for this enrollment status" @endif
                            >Create Account</button>
                                <button type="button" class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#requestDocumentModal">Request Document</button>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="details-section">
                        <h5><i class="fas fa-info-circle me-2"></i>Profile Details</h5>
                        <div class="detail-row">
                            <div class="col col-md-4 label text-nowrap">Last Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->last_name}}</div>
                        </div>
                        <div class="detail-row">
                           <div class="col col-md-4 label text-nowrap">First Name</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->first_name}}</div>
                        </div>
                        <div class="detail-row">
                           <div class="col col-md-4 label text-nowrap">Middle</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->middle_name}}</div>
                        </div>
                        <div class="detail-row">
                            <div class="col col-md-4 label text-nowrap">Age</div>
                        <div class="col-lg-9 col-md-8">{{$student->age}}</div>
                        </div>
                        <div class="detail-row">
                            <div class="col col-md-4 label text-nowrap">Gender</div>
                        <div class="col-lg-9 col-md-8 text-capitalize">{{$student->gender}}</div>
                        </div>
                        <div class="detail-row">
                             <div class="col col-md-4 label text-nowrap">Birthdate</div>
                        <div class="col-lg-9 col-md-8">{{$student->birthdate}}</div>
                        </div>
                        <div class="detail-row">
                            <div class="col col-md-4 label text-nowrap">BirthPlace</div>
                        <div class="col-lg-9 col-md-8">{{$student->place_of_birth}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Academic Details -->
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="details-section">
                        <h5><i class="fas fa-graduation-cap me-2"></i>Academic Information</h5>
                         @php
                        $latestAcadRecord = collect($acad_records)->sortByDesc('year_level')->first();
                        
                        @endphp
                        <div class="detail-row">
                            <div class="label col-4 text-nowrap">Year Level</div>
                             <div class="col-8">
                          @php
                              $yearLevel = $latestAcadRecord->year_level ?? null;
                              $yearText = match($yearLevel) {
                                  1 => '1st year',
                                  2 => '2nd year',
                                  3 => '3rd year',
                                  4 => '4th year',
                                  default => 'N/A',
                              };
                          @endphp
                          {{ $yearText }}
                         </div>
                        </div>
                        <div class="detail-row">
                            <div class="label col-4 text-nowrap">Semester</div>
                        <div class="col-8">
                          @php
                              $semester = $latestAcadRecord->semester ?? null;
                              $semestertext = match($semester) {
                                  1 => '1st Semester',
                                  2 => '2nd Semester',
                                  default => 'N/A',
                              };
                          @endphp
                          {{$semestertext}}
                         </div>
                        </div>
                        <div class="detail-row">
                            <div class="label col-4 text-nowrap">School Year</div>
                        <div class="col-8" >{{ $latestAcadRecord->school_year ?? 'N/A' }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="label col-4 text-nowrap">Program</div>
                        <div class="col-8 text-capitalize" >{{$student->program->name ?? 'N/A'}}</div>
                        </div>
                        <div class="detail-row">
                            <div class="label col-4 text-nowrap">Email</div>
                        <div class="col-8" >{{$student->email_address ?? 'N/A'}}</div>
                        </div>
                        <div class="detail-row">
                           <div class="label col-4 text-nowrap">Section</div>
                        <div class="col-8 text-capitalize" >{{ $latestAcadRecord->section->section ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Billing Section -->
        <div class="billing-card fade-in" style="animation-delay: 0.2s;">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-receipt me-2"></i>Billing Liquidation</h5>
                    <div class="billing-amount">₱15,000.00</div>
                    <p class="mb-4">Remaining Balance</p>
                    
                    <h6>Breakdown of Expenses</h6>
                    <ul class="expense-list">
                        <li><span>Tuition Fee</span> <span>₱7,000.00</span></li>
                        <li><span>Miscellaneous Fee</span> <span>₱3,000.00</span></li>
                        <li><span>Library Fee</span> <span>₱2,000.00</span></li>
                        <li><span>Laboratory Fee</span> <span>₱3,000.00</span></li>
                    </ul>
                </div>
                <div class="col-md-6 text-end">
                    <h6>Paid Balance</h6>
                    <div class="billing-amount">₱35,000.00</div>
                </div>
            </div>
        </div>

        <!-- Attendance Overview -->
        <div class="card slide-up" style="animation-delay: 0.4s;">
            <div class="details-section">
                <h5><i class="fas fa-chart-bar me-2"></i>Attendance Overview</h5>
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <div class="stats-card" data-bs-toggle="modal" data-bs-target="#presentModal">
                            <div class="stats-icon stats-present">
                                <i class="fas fa-check"></i>
                            </div>
                        <div class="stats-number">{{ $presentPercentage }}%</div>
                        <div class="stats-label">Present</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stats-card" data-bs-toggle="modal" data-bs-target="#absentModal">
                            <div class="stats-icon stats-absent">
                                <i class="fas fa-times"></i>
                            </div>
                        <div class="stats-number">{{ $absentPercentage }}%</div>
                        <div class="stats-label">Absent</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stats-card" data-bs-toggle="modal" data-bs-target="#lateModal">
                            <div class="stats-icon stats-late">
                                <i class="fas fa-clock"></i>
                            </div>
                        <div class="stats-number">{{ $latePercentage }}%</div>
                        <div class="stats-label">Late</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="stats-card" data-bs-toggle="modal" data-bs-target="#totalDaysModal">
                            <div class="stats-icon stats-total">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="stats-number">{{ $totalCount }}</div>
                            <div class="stats-label">Total Days</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades Section -->
        <div class="dashboard-card grades-card p-4 animate-fade-in" style="background-color: #764ba2; border-radius: 12px; margin-top: 2rem;">
            <h3 class="section-title mb-4" style="color: white;">
                <i class="fas fa-graduation-cap me-2"></i>
                Academic Performance
            </h3>

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                @for ($year = 1; $year <= 4; $year++)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if($year == 1) active @endif" 
                                id="year-{{ $year }}-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#year-{{ $year }}" 
                                type="button" 
                                role="tab" 
                                aria-controls="year-{{ $year }}" 
                                aria-selected="{{ $year == 1 ? 'true' : 'false' }}">
                            {{ $year }}{{ ['st', 'nd', 'rd', 'th'][$year - 1] }} Year
                        </button>
                    </li>
                @endfor
            </ul>

            <div class="tab-content pt-3">
               
                @for ($year = 1; $year <= 4; $year++)
                    <div class="tab-pane fade @if($year == 1) show active @endif"
                        id="year-{{ $year }}" 
                        role="tabpanel" 
                        aria-labelledby="year-{{ $year }}-tab">
                        @php
                            $semesterLabels = [
                                1 => '1st Semester',
                                2 => '2nd Semester',
                            ];
                            $semesters = [1, 2];
                            $yearAverages = [];
                        @endphp
                    
                        @foreach ($semesters as $semester)
                            <h5 class="text-white mb-3">{{ $semesterLabels[$semester] }} Semester</h5>
                            @php
                                $semesterGrades = [];
                                $courses = $academicPerformance[$year][$semester] ?? collect();
                            @endphp
                            
                            @if($courses->isEmpty())
                                <p class="text-white">No courses available for this semester.</p>
                            @else
                                <div class="grades-table">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Grade</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($courses as $course)
                                                @php
                                                    $grade = $course->grade;
                                                    if ($grade === null) {
                                                        $status = 'Pending';
                                                        $displayGrade = 'Pending';
                                                    } else {
                                                        $status = $grade <= 3.0 ? 'Passed' : 'Failed';
                                                        $displayGrade = number_format($grade, 2);
                                                        $semesterGrades[] = floatval($grade);
                                                    }
                                                @endphp
                                                <tr>
                                                    <td>{{ $course->course_code }}</td>
                                                <td>{{ $course->title }}</td>
                                                    <td>{{ $displayGrade }}</td>
                                                    <td>{{ $status }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endfor
            </div>
    <!-- Request Document Modal -->
    <div class="modal fade" id="requestDocumentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-file-alt me-2"></i>Request Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="modal-body">
                    <div class="mb-3">
                        <label for="documentType" class="form-label">Document Type</label>
                        <input type="text" class="form-control" id="documentType" placeholder="Enter document name" required>
                    </div>
                    <div class="mb-3">
                        <label for="documentFormat" class="form-label">Document Format</label>
                        <select class="form-select" id="documentFormat" required>
                            <option value="">Select format</option>
                            <option value="Original">Original</option>
                            <option value="Xerox">Xerox</option>
                            <option value="Photocopy">Photocopy</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="copies" class="form-label">Number of Copies</label>
                        <input type="number" class="form-control" id="copies" min="1" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="submitDate" class="form-label">Date to be Submitted</label>
                        <input type="date" class="form-control" id="submitDate" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Present Attendance Modals -->
<div class="modal fade" id="presentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-check me-2"></i>Present Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Present (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presentAttendances->groupBy('subject_id') as $subjectId => $attendances)
                        <tr>
                            <td>{{ $attendances->first()->subject->course_code }}</td>
                            <td>
                                @php
                                    $presentCount = $attendances->count();
                                    $totalCountSubject = $absentAttendances->where('subject_id', $subjectId)->count() + $presentAttendances->where('subject_id', $subjectId)->count() + $lateAttendances->where('subject_id', $subjectId)->count();
                                    $presentPercentageSubject = $totalCountSubject > 0 ? round(($presentCount / $totalCountSubject) * 100) : 0;
                                @endphp
                                {{ $presentPercentageSubject }}%
                            </td>
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


<!-- Absent attendance Modal -->
<div class="modal fade" id="absentModal" tabindex="-1" aria-labelledby="absentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="absentModalLabel">Absence Breakdown by Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Course code</th>
                            <th>Absent (%)</th>
                            <th>Date(s) Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absentAttendances->groupBy('subject_id') as $subjectId => $attendances)
                        <tr>
                            <td>{{ $attendances->first()->subject->course_code }}</td>
                            <td>
                                @php
                                    $absentCount = $attendances->count();
                                    $totalCountSubject = $absentAttendances->where('subject_id', $subjectId)->count() + $presentAttendances->where('subject_id', $subjectId)->count() + $lateAttendances->where('subject_id', $subjectId)->count();
                                    $absencePercentageSubject = $totalCountSubject > 0 ? round(($absentCount / $totalCountSubject) * 100) : 0;
                                @endphp
                                {{ $absencePercentageSubject }}%
                            </td>
                            <td>
                                @php
                                    $absentDates = $attendances->pluck('attendance_date')->map(function($date) {
                                        return \Carbon\Carbon::parse($date)->format('Y-m-d');
                                    })->toArray();
                                @endphp
                                {{ implode(', ', $absentDates) }}
                            </td>
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

<!-- Late Attendance Modal -->
<div class="modal fade" id="lateModal" tabindex="-1" aria-labelledby="lateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lateModalLabel">Late Breakdown by Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Course code</th>
                            <th>Late (%)</th>
                            <th>Date(s) Late</th>
                            <th>Time(s) Late</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lateAttendances->groupBy('subject_id') as $subjectId => $attendances)
                        <tr>
                            <td>{{ $attendances->first()->subject->course_code }}</td>
                            <td>
                                @php
                                    $lateCount = $attendances->count();
                                    $totalCountSubject = $absentAttendances->where('subject_id', $subjectId)->count() + $presentAttendances->where('subject_id', $subjectId)->count() + $lateAttendances->where('subject_id', $subjectId)->count();
                                    $latePercentageSubject = $totalCountSubject > 0 ? round(($lateCount / $totalCountSubject) * 100) : 0;
                                @endphp
                                {{ $latePercentageSubject }}%
                            </td>
                            <td>
                                @php
                                    $lateDates = $attendances->pluck('attendance_date')->map(function($date) {
                                        return \Carbon\Carbon::parse($date)->format('Y-m-d');
                                    })->toArray();
                                @endphp
                                {{ implode(', ', $lateDates) }}
                            </td>
                            <td>
                                @php
                                    $lateTimes = $attendances->pluck('check_in_time')->toArray();
                                @endphp
                                {{ implode(', ', $lateTimes) }}
                            </td>
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


<!-- Total Days Modal -->
<div class="modal fade" id="totalDaysModal" tabindex="-1" aria-labelledby="totalDaysModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="totalDaysModalLabel">
                    <i class="fas fa-calendar me-2"></i>
                    Attendance Summary
                </h5>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-center p-3" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border-radius: 12px; color: white;">
                            <h4 class="mb-1">{{ $totalPresent }}</h4>
                            <small class="opacity-75">Present Days</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); border-radius: 12px; color: white;">
                            <h4 class="mb-1">{{ $totalAbsent }}</h4>
                            <small class="opacity-75">Absent Days</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; color: white;">
                            <h4 class="mb-1">{{ $totalLate }}</h4>
                            <small class="opacity-75">Late Days</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; color: white;">
                            <h4 class="mb-1">{{ $totalPresent + $totalAbsent + $totalLate }}</h4>
                            <small class="opacity-75">Total Days</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth scrolling and enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Animate cards on scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            document.querySelectorAll('.card').forEach(card => {
                observer.observe(card);
            });

            // Enhanced button interactions
            const createAccountButton = document.getElementById('createAccountButton');
            const createAccountForm = document.getElementById('createAccountForm');

            if (createAccountButton && createAccountForm) {
                createAccountButton.addEventListener('click', function() {
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';

                    const formData = new FormData(createAccountForm);

                    fetch("{{ route('studentUserAccount.create') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            createAccountButton.innerHTML = '<i class="fas fa-check me-2"></i>Account Created!';
                            createAccountButton.classList.remove('btn-success');
                            createAccountButton.classList.add('btn-info');
                        } else {
                            alert(data.message || 'Failed to create account.');
                            createAccountButton.disabled = false;
                            createAccountButton.innerHTML = 'Create Account';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while creating the account.');
                        createAccountButton.disabled = false;
                        createAccountButton.innerHTML = 'Create Account';
                    });
                });
            }

            // Form validation
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Add your form submission logic here
                    alert('Form submitted successfully!');
                });
            });
        });
    </script>
</body>
</html>

</x-app-layout>
