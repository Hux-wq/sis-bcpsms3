<x-app-layout>
<x-page-title header="Dashboard" :links="['dashboard' => '/dashboard']"/>

<style>
    .dashboard-card {
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        border-radius: 16px;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    }
    
    .dashboard-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }
    
    .student-profile {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .profile-info-row {
        margin-bottom: 0.75rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .profile-info-row:last-child {
        border-bottom: none;
    }
    
    .profile-label {
        font-weight: 600;
        opacity: 0.9;
        font-size: 0.95rem;
    }
    
    .profile-value {
        font-weight: 400;
        font-size: 1rem;
    }
    
    .billing-card {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        border-radius: 20px;
        border: none;
    }
    
    .billing-amount {
        font-size: 2rem;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .expense-item {
        background: rgba(255,255,255,0.1);
        padding: 0.75rem 1rem;
        border-radius: 12px;
        margin-bottom: 0.5rem;
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .payment-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    
    .payment-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }
    
    .attendance-card {
        border: none;
        border-radius: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    
    .attendance-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .attendance-card.present {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }
    
    .attendance-card.absent {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
        color: white;
    }
    
    .attendance-card.late {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .attendance-card.total {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .attendance-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        backdrop-filter: blur(10px);
    }
    
    .attendance-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .attendance-label {
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.9;
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .grades-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        border: none;
    }
    
    .nav-tabs-custom {
        border: none;
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 4px;
        margin-bottom: 2rem;
    }
    
    .nav-tabs-custom .nav-link {
        border: none;
        background: transparent;
        color: rgba(255,255,255,0.7);
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .nav-tabs-custom .nav-link.active {
        background: rgba(255,255,255,0.2);
        color: white;
        backdrop-filter: blur(10px);
    }
    
    .grades-table {
        background: rgba(255,255,255,0.95);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }
    
    .grades-table th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        border: none;
        padding: 1rem;
    }
    
    .grades-table td {
        padding: 1rem;
        border: none;
        color: #2d3748;
    }
    
    .grades-table tbody tr {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .grades-table tbody tr:hover {
        background: rgba(102, 126, 234, 0.05);
    }
    
    .grade-badge {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .grade-badge.failed {
        background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    }
    
    .semester-summary {
        background: rgba(255,255,255,0.1);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }
    
    .modal-content {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    
    .modal-header {
        border: none;
        border-radius: 20px 20px 0 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .btn-close {
        filter: brightness(0) invert(1);
    }
    
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.5rem;
        position: relative;
        padding-left: 1rem;
    }
    
    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
</style>
      
<section class="section dashboard">
    <!-- Student Profile Card -->
    <div class="student-profile animate-fade-in">
        <div class="row align-items-center">
            <div class="col-12 col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <div class="attendance-icon me-3">
                        <i class="fa-solid fa-user fa-2x"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 fw-bold">{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</h2>
                        <p class="mb-0 opacity-75">Student Dashboard</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Program</div>
                                <div class="col-8 profile-value">{{$student->program->name ?? 'N/A'}}</div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">School ID</div>
                                <div class="col-8 profile-value">{{$student->student_number}}</div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Year Level</div>
                                <div class="col-8 profile-value">{{ $latestAcademicRecord->year_level ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Section</div>
                                <div class="col-8 profile-value">{{ $latestAcademicRecord->section->section ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Age</div>
                                <div class="col-8 profile-value">{{ $student->age ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Gender</div>
                                <div class="col-8 profile-value">{{ $student->gender ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Birth Date</div>
                                <div class="col-8 profile-value">{{ $student->birthdate ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="profile-info-row">
                            <div class="row">
                                <div class="col-4 profile-label">Email</div>
                                <div class="col-8 profile-value">{{ $student->email_address ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Billing Section -->
    <div class="dashboard-card billing-card p-4 mb-4 animate-fade-in">
        <h3 class="section-title text-white mb-4">
            <i class="fas fa-credit-card me-2"></i>
            Billing Overview
        </h3>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <h4 class="mb-2">Remaining Balance</h4>
                    <div class="billing-amount">₱{{ number_format(15000.00, 2) }}</div>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Fee Breakdown</h5>
                    <div class="expense-item">
                        <span>Tuition Fee</span>
                        <strong>₱{{ number_format(7000.00, 2) }}</strong>
                    </div>
                    <div class="expense-item">
                        <span>Miscellaneous Fee</span>
                        <strong>₱{{ number_format(3000.00, 2) }}</strong>
                    </div>
                    <div class="expense-item">
                        <span>Library Fee</span>
                        <strong>₱{{ number_format(2000.00, 2) }}</strong>
                    </div>
                    <div class="expense-item">
                        <span>Laboratory Fee</span>
                        <strong>₱{{ number_format(3000.00, 2) }}</strong>
                    </div>
                </div>
                
                <button type="button" class="payment-btn" data-bs-toggle="modal" data-bs-target="#makePaymentModal">
                    <i class="fas fa-credit-card me-2"></i>
                    Make Payment
                </button>
            </div>
            <div class="col-lg-6">
                <div class="text-end">
                    <h4 class="mb-2">Paid Balance</h4>
                    <div class="billing-amount">₱{{ number_format(35000.00, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Overview -->
    <div class="dashboard-card p-4 mb-4 animate-fade-in">
        <h3 class="section-title mb-4">
            <i class="fas fa-calendar-check me-2"></i>
            Attendance Overview
        </h3>
        
        <div class="row g-4">
            <div class="col-xl-3 col-md-6">
                <div class="attendance-card present p-3" data-bs-toggle="modal" data-bs-target="#presentModal">
                    <div class="d-flex align-items-center">
                        <div class="attendance-icon">
                            <i class="fas fa-check fa-lg"></i>
                        </div>
                        <div>
            <h3 class="attendance-number">{{ $presentPercentage }}%</h3>
            <p class="attendance-label">Present</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="attendance-card absent p-3" data-bs-toggle="modal" data-bs-target="#absentModal">
                    <div class="d-flex align-items-center">
                        <div class="attendance-icon">
                            <i class="fas fa-times fa-lg"></i>
                        </div>
                        <div>
            <h3 class="attendance-number">{{ $absentPercentage }}%</h3>
            <p class="attendance-label">Absent</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="attendance-card late p-3" data-bs-toggle="modal" data-bs-target="#lateModal">
                    <div class="d-flex align-items-center">
                        <div class="attendance-icon">
                            <i class="fas fa-clock fa-lg"></i>
                        </div>
                        <div>
            <h3 class="attendance-number">{{ $latePercentage }}%</h3>
            <p class="attendance-label">Late</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="attendance-card total p-3" data-bs-toggle="modal" data-bs-target="#totalDaysModal">
                    <div class="d-flex align-items-center">
                        <div class="attendance-icon">
                            <i class="fas fa-calendar fa-lg"></i>
                        </div>
                        <div>
                            @php
                                //$totalPresent = 95;
                                //$totalAbsent = 3;
                                //$totalLate = 2;
                                //$totalDays = $totalPresent + $totalAbsent + $totalLate;
                            @endphp
                            <h3 class="attendance-number">{{ $totalDays }}</h3>
                            <p class="attendance-label">Total Days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grades Overview -->
    <div class="dashboard-card grades-card p-4 animate-fade-in">
        <h3 class="section-title text-white mb-4">
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
                            $semesters = ['1st Semester', '2nd Semester'];
                            $yearAverages = [];
                        @endphp
                    
                    @foreach ($semesters as $semester)
                        <h5 class="text-white mb-3">{{ $semester }} Semester</h5>
                        @php
                            $semesterGrades = [];
                            $courses = $academicPerformance[$year][$semester] ?? collect();
                        @endphp
                        
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
                                        <td><strong>{{ $course->course_code }}</strong></td>
                                        <td>{{ $course->title }}</td>
                                        <td><span class="grade-badge">{{ $displayGrade }}</span></td>
                                        <td>
                                            <span class="grade-badge {{ $status === 'Failed' ? 'failed' : '' }}">
                                                {{ $status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @php
                            $semesterAverage = count($semesterGrades) > 0 ? array_sum($semesterGrades) / count($semesterGrades) : 0;
                            $yearAverages[$semester] = $semesterAverage;
                        @endphp
                    @endforeach
                    
                    @php
                        $totalAverage = count($yearAverages) > 0 ? array_sum($yearAverages) / count($yearAverages) : 0;
                        $totalStatus = $totalAverage <= 3.0 ? 'Passed' : 'Failed';
                    @endphp
                    
                    <div class="semester-summary">
                        <h5 class="text-white mb-2">Year {{ $year }} Summary</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-white">Overall Average:</span>
                            <div>
                                <span class="grade-badge me-2">{{ number_format($totalAverage, 2) }}</span>
                                <span class="grade-badge {{ $totalStatus === 'Failed' ? 'failed' : '' }}">
                                    {{ $totalStatus }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- Make Payment Modal -->
<div class="modal fade" id="makePaymentModal" tabindex="-1" aria-labelledby="makePaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="makePaymentModalLabel">
                    <i class="fas fa-credit-card me-2"></i>
                    Make Payment
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="makePaymentForm">
                    <div class="mb-3">
                        <label for="paymentFor" class="form-label">Payment For</label>
                        <input type="text" class="form-control" id="paymentFor" name="paymentFor" required>
                    </div>
                    <div class="mb-3">
                        <label for="paymentDetails" class="form-label">Details (Optional)</label>
                        <textarea class="form-control" id="paymentDetails" name="paymentDetails" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="paymentAmount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="text" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="makePaymentForm" class="payment-btn">Submit Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Present Modal -->
<div class="modal fade" id="presentModal" tabindex="-1" aria-labelledby="presentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presentModalLabel">
                    <i class="fas fa-check me-2"></i>
                    Attendance Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Check-In Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presentAttendances as $attendance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M d, Y') }}</td>
                                <td>{{ $attendance->subject->title }}</td>
                                <td>{{ $attendance->check_in_time ?? '—' }}</td>
                                <td class="font-semibold text-green-600">
                                    Present
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


<!-- Absent Modal -->
<div class="modal fade" id="absentModal" tabindex="-1" aria-labelledby="absentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="absentModalLabel">
                    <i class="fas fa-times me-2"></i>
                    Absence Breakdown by Course
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Absent (%)</th>
                            <th>Date(s) Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absentAttendances->groupBy('subject_id') as $subjectId => $attendances)
                        <tr>
                            <td><strong>{{ $attendances->first()->subject->course_code }}</strong></td>
                            <td>
                                @php
                                    $absentCount = $attendances->count();
                                    $totalCount = $absentAttendances->where('subject_id', $subjectId)->count() + $presentAttendances->where('subject_id', $subjectId)->count() + $lateAttendances->where('subject_id', $subjectId)->count();
                                    $absencePercentage = $totalCount > 0 ? round(($absentCount / $totalCount) * 100) : 0;
                                @endphp
                                <span class="grade-badge failed">{{ $absencePercentage }}%</span>
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

<!-- Late Modal -->
<div class="modal fade" id="lateModal" tabindex="-1" aria-labelledby="lateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lateModalLabel">
                    <i class="fas fa-clock me-2"></i>
                    Late Breakdown by Course
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Late (%)</th>
                            <th>Date(s) Late</th>
                            <th>Time(s) Late</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lateAttendances->groupBy('subject_id') as $subjectId => $attendances)
                        <tr>
                            <td><strong>{{ $attendances->first()->subject->course_code }}</strong></td>
                            <td>
                                @php
                                    $lateCount = $attendances->count();
                                    $totalCount = $absentAttendances->where('subject_id', $subjectId)->count() + $presentAttendances->where('subject_id', $subjectId)->count() + $lateAttendances->where('subject_id', $subjectId)->count();
                                    $latePercentage = $totalCount > 0 ? round(($lateCount / $totalCount) * 100) : 0;
                                @endphp
                                <span class="grade-badge" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">{{ $latePercentage }}%</span>
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

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe all dashboard cards
    document.querySelectorAll('.dashboard-card, .student-profile').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });

    //validation
    const paymentForm = document.getElementById('makePaymentForm');
    if (paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            submitBtn.disabled = true;
            
            // Simulate processing
            setTimeout(() => {
                alert('Payment submitted successfully!');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                bootstrap.Modal.getInstance(document.getElementById('makePaymentModal')).hide();
                paymentForm.reset();
            }, 2000);
        });
    }

    // Add hover effects to attendance cards
    document.querySelectorAll('.attendance-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Enhance tab switching with smooth transitions
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(e) {
            const target = document.querySelector(e.target.getAttribute('data-bs-target'));
            target.style.opacity = '0';
            target.style.transform = 'translateX(20px)';
            
            setTimeout(() => {
                target.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                target.style.opacity = '1';
                target.style.transform = 'translateX(0)';
            }, 50);
        });
    });
});

// Add ripple effect to buttons
function createRipple(event) {
    const button = event.currentTarget;
    const circle = document.createElement('span');
    const diameter = Math.max(button.clientWidth, button.clientHeight);
    const radius = diameter / 2;

    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
    circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
    circle.classList.add('ripple');

    const ripple = button.getElementsByClassName('ripple')[0];
    if (ripple) {
        ripple.remove();
    }

    button.appendChild(circle);
}

// Apply ripple effect to payment buttons
document.querySelectorAll('.payment-btn').forEach(btn => {
    btn.addEventListener('click', createRipple);
});

// Add CSS for ripple effect
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .payment-btn {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(rippleStyle);
</script>

</x-app-layout>