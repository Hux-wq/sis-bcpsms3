<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Departments Table
$departmentData = [
    'code' => 'CS',
    'name' => 'Computer Science',
    'head_id' => null,
];

$department = DB::table('departments')->insertGetId($departmentData);

// Programs Table
$programData = [
    'code' => 'BSCS',
    'name' => 'Bachelor of Science in Computer Science',
    'department_id' => $department,
];

$program = DB::table('programs')->insertGetId($programData);

// Sections Table
$sectionData = [
    ['section' => 1, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 1, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 2, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 1, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 2, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 1, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 2, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 1, 'specialization' => 1, 'department_id'=>$department],
    ['section' => 1, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 2, 'specialization' => 1, 'department_id'=>$department],
];

DB::table('sections')->insert($sectionData);

// Student Data
$studentData = [
    'first_name' => 'John',
    'middle_name' => 'Michael',
    'last_name' => 'Doe',
    'suffix_name' => null,
    'age' => 20,
    'gender' => 'male',
    'birthdate' => '2003-01-15',
    'religion' => 'Christian',
    'place_of_birth' => 'Manila',
    'current_address' => '123 Main St, Manila',
    'email_address' => 'john.doe@example.com',
    'contact_number' => '09123456789',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $program,
    'desired_major' => 'Software Development',
    'enrollment_status' => 'Enrolled',
];

    $studentId = DB::table('students')->insertGetId($studentData);

// Academic Records
    $academicRecordsData = [
        ['student_id' => $studentId, 'section_id' => 1, 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.50],
        ['student_id' => $studentId, 'section_id' => 2, 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.60],
        ['student_id' => $studentId, 'section_id' => 3, 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.70],
        ['student_id' => $studentId, 'section_id' => 4, 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.80],
        ['student_id' => $studentId, 'section_id' => 5, 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.90],
        ['student_id' => $studentId, 'section_id' => 6, 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' =>3.95],
        ['student_id' => $studentId, 'section_id' => 7, 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 4.00],
        ['student_id' => $studentId, 'section_id' => 8, 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
    ];

    DB::table('academic_records')->insert($academicRecordsData);

    // Document Lists
    $documentListsData = [
        ['name' => 'Birth Certificate'],
        ['name' => 'High School Diploma'],
        ['name' => 'Transcript of Records'],
    ];

    DB::table('document_lists')->insert($documentListsData);

    // Required Documents
    $requiredDocumentsData = [
        ['student_id' => $studentId, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
        ['student_id' => $studentId, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
        ['student_id' => $studentId, 'docu_name' => 'Transcript of Records', 'status' => 'pending'],
    ];

    DB::table('req_documents')->insert($requiredDocumentsData);


    // Departments Table (Assuming CS department already exists)
$departmentId = DB::table('departments')->where('code', 'CS')->value('id');

// Programs Table (Assuming BSCS program already exists)
$programId = DB::table('programs')->where('code', 'BSCS')->value('id');

// Sections Table (Assuming sections already exist)
$sectionIds = DB::table('sections')->where('department_id', $departmentId)->pluck('id')->toArray();

// Student Data (Second Student)
$studentData2 = [
    'first_name' => 'Alice',
    'middle_name' => 'Jane',
    'last_name' => 'Smith',
    'suffix_name' => null,
    'age' => 19,
    'gender' => 'female',
    'birthdate' => '2004-05-20',
    'religion' => 'Catholic',
    'place_of_birth' => 'Cebu',
    'current_address' => '456 Oak St, Cebu',
    'email_address' => 'alice.smith@example.com',
    'contact_number' => '09987654321',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $programId,
    'desired_major' => 'Data Science',
    'enrollment_status' => 'Enrolled',
];

$studentId2 = DB::table('students')->insertGetId($studentData2);

// Academic Records (Second Student)
$academicRecordsData2 = [
    ['student_id' => $studentId2, 'section_id' => $sectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.80],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 4.00],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.75],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.85],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId2, 'section_id' => $sectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 3.95],
];

DB::table('academic_records')->insert($academicRecordsData2);

// Required Documents (Second Student)
$requiredDocumentsData2 = [
    ['student_id' => $studentId2, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId2, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId2, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData2);



// Departments Table (Assuming CS department already exists)
$departmentId = DB::table('departments')->where('code', 'CS')->value('id');

// Programs Table (Assuming BSCS program already exists)
$programId = DB::table('programs')->where('code', 'BSCS')->value('id');

// Sections Table (Assuming sections already exist)
$sectionIds = DB::table('sections')->where('department_id', $departmentId)->pluck('id')->toArray();

// Student Data (Third Student)
$studentData3 = [
    'first_name' => 'Robert',
    'middle_name' => 'William',
    'last_name' => 'Brown',
    'suffix_name' => 'Jr.',
    'age' => 21,
    'gender' => 'male',
    'birthdate' => '2002-11-10',
    'religion' => 'None',
    'place_of_birth' => 'Davao',
    'current_address' => '789 Pine St, Davao',
    'email_address' => 'robert.brown@example.com',
    'contact_number' => '09876543210',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $programId,
    'desired_major' => 'Game Development',
    'enrollment_status' => 'Enrolled',
];

$studentId3 = DB::table('students')->insertGetId($studentData3);

// Academic Records (Third Student)
$academicRecordsData3 = [
    ['student_id' => $studentId3, 'section_id' => $sectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.20],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.30],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.40],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.50],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.60],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.70],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.80],
    ['student_id' => $studentId3, 'section_id' => $sectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 3.90],
];

DB::table('academic_records')->insert($academicRecordsData3);

// Required Documents (Third Student)
$requiredDocumentsData3 = [
    ['student_id' => $studentId3, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId3, 'docu_name' => 'High School Diploma', 'status' => 'pending'],
    ['student_id' => $studentId3, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData3);


// Departments Table (Assuming CS department already exists)
$departmentId = DB::table('departments')->where('code', 'CS')->value('id');

// Programs Table (Assuming BSCS program already exists)
$programId = DB::table('programs')->where('code', 'BSCS')->value('id');

// Sections Table (Assuming sections already exist)
$sectionIds = DB::table('sections')->where('department_id', $departmentId)->pluck('id')->toArray();

// Student Data (Fourth Student)
$studentData4 = [
    'first_name' => 'Emily',
    'middle_name' => 'Rose',
    'last_name' => 'Garcia',
    'suffix_name' => null,
    'age' => 22,
    'gender' => 'female',
    'birthdate' => '2001-08-25',
    'religion' => 'Iglesia ni Cristo',
    'place_of_birth' => 'Laguna',
    'current_address' => '1011 Acacia St, Laguna',
    'email_address' => 'emily.garcia@example.com',
    'contact_number' => '09771122334',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $programId,
    'desired_major' => 'Artificial Intelligence',
    'enrollment_status' => 'Enrolled',
];

$studentId4 = DB::table('students')->insertGetId($studentData4);

// Academic Records (Fourth Student)
$academicRecordsData4 = [
    ['student_id' => $studentId4, 'section_id' => $sectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.65],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.75],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.85],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.55],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.65],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.75],
    ['student_id' => $studentId4, 'section_id' => $sectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 3.85],
];

DB::table('academic_records')->insert($academicRecordsData4);

// Required Documents (Fourth Student)
$requiredDocumentsData4 = [
    ['student_id' => $studentId4, 'docu_name' => 'Birth Certificate', 'status' => 'pending'],
    ['student_id' => $studentId4, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId4, 'docu_name' => 'Transcript of Records', 'status' => 'pending'],
];

DB::table('req_documents')->insert($requiredDocumentsData4);


// Departments Table (Assuming CS department already exists)
$departmentId = DB::table('departments')->where('code', 'CS')->value('id');

// Programs Table (Assuming BSCS program already exists)
$programId = DB::table('programs')->where('code', 'BSCS')->value('id');

// Sections Table (Assuming sections already exist)
$sectionIds = DB::table('sections')->where('department_id', $departmentId)->pluck('id')->toArray();

// Student Data (Fifth Student)
$studentData5 = [
    'first_name' => 'David',
    'middle_name' => 'Lee',
    'last_name' => 'Reyes',
    'suffix_name' => null,
    'age' => 20,
    'gender' => 'male',
    'birthdate' => '2003-03-12',
    'religion' => 'Buddhist',
    'place_of_birth' => 'Quezon City',
    'current_address' => '1213 Sampaguita St, Quezon City',
    'email_address' => 'david.reyes@example.com',
    'contact_number' => '09665544332',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $programId,
    'desired_major' => 'Cybersecurity',
    'enrollment_status' => 'Enrolled',
];

$studentId5 = DB::table('students')->insertGetId($studentData5);

// Academic Records (Fifth Student)
$academicRecordsData5 = [
    ['student_id' => $studentId5, 'section_id' => $sectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.10],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.25],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.45],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.65],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.85],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.98],
    ['student_id' => $studentId5, 'section_id' => $sectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
];

DB::table('academic_records')->insert($academicRecordsData5);

// Required Documents (Fifth Student)
$requiredDocumentsData5 = [
    ['student_id' => $studentId5, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId5, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId5, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData5);


// New Department
$newDepartmentData = [
    'code' => 'ENG',
    'name' => 'Engineering',
    'head_id' => null,
];

$newDepartmentId = DB::table('departments')->insertGetId($newDepartmentData);

// New Program
$newProgramData = [
    'code' => 'BSEE',
    'name' => 'Bachelor of Science in Electrical Engineering',
    'department_id' => $newDepartmentId,
];

$newProgramId = DB::table('programs')->insertGetId($newProgramData);

// New Sections
$newSectionData = [
    ['section' => 2, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 1, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 2, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 1, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 2, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 1, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 2, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 1, 'specialization' => 2, 'department_id' => $newDepartmentId],
    ['section' => 2, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 2, 'specialization' => 2, 'department_id' => $newDepartmentId],
];

DB::table('sections')->insert($newSectionData);

$newSectionIds = DB::table('sections')->where('department_id', $newDepartmentId)->pluck('id')->toArray();

// Student Data (Sixth Student - Engineering)
$studentData6 = [
    'first_name' => 'Sophia',
    'middle_name' => 'Marie',
    'last_name' => 'Santos',
    'suffix_name' => null,
    'age' => 21,
    'gender' => 'female',
    'birthdate' => '2002-06-30',
    'religion' => 'Agnostic',
    'place_of_birth' => 'Batangas',
    'current_address' => '1415 Laurel St, Batangas',
    'email_address' => 'sophia.santos@example.com',
    'contact_number' => '09554433221',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $newProgramId,
    'desired_major' => 'Power Systems',
    'enrollment_status' => 'Enrolled',
];

$studentId6 = DB::table('students')->insertGetId($studentData6);

// Academic Records (Sixth Student - Engineering)
$academicRecordsData6 = [
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.40],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.55],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.70],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.85],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 4.00],
    ['student_id' => $studentId6, 'section_id' => $newSectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
];

DB::table('academic_records')->insert($academicRecordsData6);

// Required Documents (Sixth Student - Engineering)
$requiredDocumentsData6 = [
    ['student_id' => $studentId6, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId6, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId6, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData6);


// New Department (Business Administration)
$businessDepartmentData = [
    'code' => 'BA',
    'name' => 'Business Administration',
    'head_id' => null,
];

$businessDepartmentId = DB::table('departments')->insertGetId($businessDepartmentData);

// New Program (Bachelor of Science in Accountancy)
$accountancyProgramData = [
    'code' => 'BSA',
    'name' => 'Bachelor of Science in Accountancy',
    'department_id' => $businessDepartmentId,
];

$accountancyProgramId = DB::table('programs')->insertGetId($accountancyProgramData);

// New Sections (Accountancy)
$accountancySectionData = [
    ['section' => 3, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 1, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 2, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 1, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 2, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 1, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 2, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 1, 'specialization' => 3, 'department_id' => $businessDepartmentId],
    ['section' => 3, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 2, 'specialization' => 3, 'department_id' => $businessDepartmentId],
];

DB::table('sections')->insert($accountancySectionData);

$accountancySectionIds = DB::table('sections')->where('department_id', $businessDepartmentId)->pluck('id')->toArray();

// Student Data (Seventh Student - Accountancy)
$studentData7 = [
    'first_name' => 'Isabella',
    'middle_name' => 'Grace',
    'last_name' => 'Cruz',
    'suffix_name' => null,
    'age' => 20,
    'gender' => 'female',
    'birthdate' => '2003-09-18',
    'religion' => 'Protestant',
    'place_of_birth' => 'Iloilo',
    'current_address' => '1617 Rosario St, Iloilo',
    'email_address' => 'isabella.cruz@example.com',
    'contact_number' => '09443322110',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $accountancyProgramId,
    'desired_major' => 'Financial Accounting',
    'enrollment_status' => 'Enrolled',
];

$studentId7 = DB::table('students')->insertGetId($studentData7);

// Academic Records (Seventh Student - Accountancy)
$academicRecordsData7 = [
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.75],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.85],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.80],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId7, 'section_id' => $accountancySectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
];

DB::table('academic_records')->insert($academicRecordsData7);

// Required Documents (Seventh Student - Accountancy)
$requiredDocumentsData7 = [
    ['student_id' => $studentId7, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId7, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId7, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData7);

// Departments Table (Assuming CS department already exists)
$departmentId = DB::table('departments')->where('code', 'CS')->value('id');

// Programs Table (Assuming BSCS program already exists)
$programId = DB::table('programs')->where('code', 'BSCS')->value('id');

// Sections Table (Assuming sections already exist)
$sectionIds = DB::table('sections')->where('department_id', $departmentId)->pluck('id')->toArray();

// Student Data (Eighth Student - Computer Science with variation)
$studentData8 = [
    'first_name' => 'Ethan',
    'middle_name' => 'James',
    'last_name' => 'Ramos',
    'suffix_name' => null,
    'age' => 19,
    'gender' => 'male',
    'birthdate' => '2004-01-28',
    'religion' => 'Atheist',
    'place_of_birth' => 'Taguig',
    'current_address' => '1819 Kalayaan Ave, Taguig',
    'email_address' => 'ethan.ramos@example.com',
    'contact_number' => '09332211009',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $programId, // Same program as previous CS students
    'desired_major' => 'Mobile Development',
    'enrollment_status' => 'Enrolled',
];

$studentId8 = DB::table('students')->insertGetId($studentData8);

// Academic Records (Eighth Student - Computer Science with variation)
// We'll use the existing section IDs, but we can change the GPA and other details
$academicRecordsData8 = [
    ['student_id' => $studentId8, 'section_id' => $sectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.35],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.50],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.65],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.80],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.98],
    ['student_id' => $studentId8, 'section_id' => $sectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
];

DB::table('academic_records')->insert($academicRecordsData8);

// Required Documents (Eighth Student - Computer Science with variation)
$requiredDocumentsData8 = [
    ['student_id' => $studentId8, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId8, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId8, 'docu_name' => 'Transcript of Records', 'status' => 'pending'],
];

DB::table('req_documents')->insert($requiredDocumentsData8);

// New Department (Arts and Sciences)
$artsSciencesDepartmentData = [
    'code' => 'AS',
    'name' => 'Arts and Sciences',
    'head_id' => null,
];

$artsSciencesDepartmentId = DB::table('departments')->insertGetId($artsSciencesDepartmentData);

// New Program (Bachelor of Arts in Communication)
$communicationProgramData = [
    'code' => 'BAComm',
    'name' => 'Bachelor of Arts in Communication',
    'department_id' => $artsSciencesDepartmentId,
];

$communicationProgramId = DB::table('programs')->insertGetId($communicationProgramData);

// New Sections (Communication)
$communicationSectionData = [
    ['section' => 4, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 1, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 2, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 1, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 2, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 1, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 2, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 1, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
    ['section' => 4, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 2, 'specialization' => 4, 'department_id' => $artsSciencesDepartmentId],
];

DB::table('sections')->insert($communicationSectionData);

$communicationSectionIds = DB::table('sections')->where('department_id', $artsSciencesDepartmentId)->pluck('id')->toArray();

// Student Data (Ninth Student - Communication)
$studentData9 = [
    'first_name' => 'Olivia',
    'middle_name' => 'Grace',
    'last_name' => 'Reyes',
    'suffix_name' => null,
    'age' => 20,
    'gender' => 'female',
    'birthdate' => '2003-07-15',
    'religion' => 'Christian',
    'place_of_birth' => 'Cebu City',
    'current_address' => '2021 Osmeña Blvd, Cebu City',
    'email_address' => 'olivia.reyes@example.com',
    'contact_number' => '09221100998',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $communicationProgramId,
    'desired_major' => 'Journalism',
    'enrollment_status' => 'Enrolled',
];

$studentId9 = DB::table('students')->insertGetId($studentData9);

// Academic Records (Ninth Student - Communication)
$academicRecordsData9 = [
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.55],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.65],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.75],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.85],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.98],
    ['student_id' => $studentId9, 'section_id' => $communicationSectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
];

DB::table('academic_records')->insert($academicRecordsData9);

// Required Documents (Ninth Student - Communication)
$requiredDocumentsData9 = [
    ['student_id' => $studentId9, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId9, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId9, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData9);

// New Department (Education)
$educationDepartmentData = [
    'code' => 'ED',
    'name' => 'Education',
    'head_id' => null,
];

$educationDepartmentId = DB::table('departments')->insertGetId($educationDepartmentData);

// New Program (Bachelor of Elementary Education)
$elementaryEducationProgramData = [
    'code' => 'BEEd',
    'name' => 'Bachelor of Elementary Education',
    'department_id' => $educationDepartmentId,
];

$elementaryEducationProgramId = DB::table('programs')->insertGetId($elementaryEducationProgramData);

// New Sections (Elementary Education)
$elementaryEducationSectionData = [
    ['section' => 5, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 1, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2023-2024', 'semester' => 2, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 1, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2024-2025', 'semester' => 2, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 1, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2025-2026', 'semester' => 2, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 1, 'specialization' => 5, 'department_id' => $educationDepartmentId],
    ['section' => 5, 'adviser' => null, 'semester_year' => '2026-2027', 'semester' => 2, 'specialization' => 5, 'department_id' => $educationDepartmentId],
];

DB::table('sections')->insert($elementaryEducationSectionData);

$elementaryEducationSectionIds = DB::table('sections')->where('department_id', $educationDepartmentId)->pluck('id')->toArray();

// Student Data (Tenth Student - Elementary Education)
$studentData10 = [
    'first_name' => 'Liam',
    'middle_name' => 'Gabriel',
    'last_name' => 'Fernandez',
    'suffix_name' => null,
    'age' => 21,
    'gender' => 'male',
    'birthdate' => '2002-04-10',
    'religion' => 'Catholic',
    'place_of_birth' => 'Baguio City',
    'current_address' => '2223 Session Rd, Baguio City',
    'email_address' => 'liam.fernandez@example.com',
    'contact_number' => '09110099887',
    'enrollment_date' => '2023-08-01',
    'enrollment_for' => '4th Year',
    'program_id' => $elementaryEducationProgramId,
    'desired_major' => 'General Education',
    'enrollment_status' => 'Enrolled',
];

$studentId10 = DB::table('students')->insertGetId($studentData10);

// Academic Records (Tenth Student - Elementary Education)
$academicRecordsData10 = [
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[0], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 1, 'cumulative_gpa' => 3.60],
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[1], 'school_year' => '2023-2024', 'year_level' => 1, 'semester' => 2, 'cumulative_gpa' => 3.70],
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[2], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 1, 'cumulative_gpa' => 3.80],
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[3], 'school_year' => '2024-2025', 'year_level' => 2, 'semester' => 2, 'cumulative_gpa' => 3.90],
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[4], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 1, 'cumulative_gpa' => 3.95],
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[5], 'school_year' => '2025-2026', 'year_level' => 3, 'semester' => 2, 'cumulative_gpa' => 3.98],
    ['student_id' => $studentId10, 'section_id' => $elementaryEducationSectionIds[6], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 1, 'cumulative_gpa' => 3.99],
    ['student_id' => $studentId10, 'section_id' =>$elementaryEducationSectionIds[7], 'school_year' => '2026-2027', 'year_level' => 4, 'semester' => 2, 'cumulative_gpa' => 4.00],
];

DB::table('academic_records')->insert($academicRecordsData10);

// Required Documents (Tenth Student - Elementary Education)
$requiredDocumentsData10 = [
    ['student_id' => $studentId10, 'docu_name' => 'Birth Certificate', 'status' => 'submitted'],
    ['student_id' => $studentId10, 'docu_name' => 'High School Diploma', 'status' => 'submitted'],
    ['student_id' => $studentId10, 'docu_name' => 'Transcript of Records', 'status' => 'submitted'],
];

DB::table('req_documents')->insert($requiredDocumentsData10);  

    }
}
