<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MassSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 5 departments
        $departments = [
            ['code' => 'CS', 'name' => 'Computer Science'],
            ['code' => 'ENG', 'name' => 'Engineering'],
            ['code' => 'BUS', 'name' => 'Business Administration'],
            ['code' => 'SCI', 'name' => 'Natural Sciences'],
            ['code' => 'ART', 'name' => 'Arts and Humanities']
        ];

        foreach ($departments as $department) {
            DB::table('departments')->insert([
                'code' => $department['code'],
                'name' => $department['name'],
                'created_by' => 'system',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Get all department IDs
        $departmentIds = DB::table('departments')->pluck('id');

        // Program names for each department
        $programNames = [
            'CS' => [
                'Software Engineering', 'Artificial Intelligence', 'Data Science',
                'Cybersecurity', 'Computer Networks', 'Database Management',
                'Web Development', 'Mobile App Development', 'Game Development',
                'Cloud Computing'
            ],
            'ENG' => [
                'Civil Engineering', 'Mechanical Engineering', 'Electrical Engineering',
                'Chemical Engineering', 'Aerospace Engineering', 'Biomedical Engineering',
                'Industrial Engineering', 'Environmental Engineering', 'Petroleum Engineering',
                'Nuclear Engineering'
            ],
            'BUS' => [
                'Marketing', 'Finance', 'Accounting', 'Human Resources',
                'International Business', 'Entrepreneurship', 'Supply Chain Management',
                'Business Analytics', 'Management', 'Economics'
            ],
            'SCI' => [
                'Physics', 'Chemistry', 'Biology', 'Mathematics',
                'Environmental Science', 'Astronomy', 'Geology',
                'Biotechnology', 'Neuroscience', 'Marine Biology'
            ],
            'ART' => [
                'Literature', 'History', 'Philosophy', 'Psychology',
                'Sociology', 'Anthropology', 'Fine Arts', 'Music',
                'Theater', 'Film Studies'
            ]
        ];

        // Create 10 programs under each department
        foreach ($departmentIds as $departmentId) {
            $departmentCode = DB::table('departments')->where('id', $departmentId)->value('code');
            $programsForDepartment = $programNames[$departmentCode];

            foreach ($programsForDepartment as $index => $programName) {
                $programCode = $departmentCode . '-' . str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                
                DB::table('programs')->insert([
                    'code' => $programCode,
                    'name' => $programName,
                    'department_id' => $departmentId,
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // Get all program IDs with their department IDs
        $programs = DB::table('programs')->select('id', 'department_id', 'code')->get();

        // Course titles and descriptions for each department
        $courseData = [
            'CS' => [
                [
                    'title' => 'Introduction to Programming',
                    'description' => 'Basic programming concepts using a high-level language.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Data Structures and Algorithms',
                    'description' => 'Study of data structures and the algorithms that operate on them.',
                    'credits' => 4,
                    'level' => 200
                ],
                [
                    'title' => 'Database Systems',
                    'description' => 'Design and implementation of database systems.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Operating Systems',
                    'description' => 'Study of operating system principles and design.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Computer Networks',
                    'description' => 'Introduction to computer networking concepts and protocols.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Software Engineering',
                    'description' => 'Principles and practices of software development.',
                    'credits' => 4,
                    'level' => 400
                ],
                [
                    'title' => 'Artificial Intelligence',
                    'description' => 'Introduction to AI concepts and techniques.',
                    'credits' => 3,
                    'level' => 400
                ],
                [
                    'title' => 'Machine Learning',
                    'description' => 'Study of algorithms that learn from data.',
                    'credits' => 3,
                    'level' => 400
                ],
                [
                    'title' => 'Web Development',
                    'description' => 'Design and implementation of web applications.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Mobile App Development',
                    'description' => 'Design and development of mobile applications.',
                    'credits' => 3,
                    'level' => 300
                ]
            ],
            'ENG' => [
                [
                    'title' => 'Engineering Mathematics',
                    'description' => 'Mathematical methods for engineering applications.',
                    'credits' => 4,
                    'level' => 100
                ],
                [
                    'title' => 'Mechanics of Materials',
                    'description' => 'Study of deformable bodies and their reactions to forces.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Thermodynamics',
                    'description' => 'Study of energy and its transformations.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Fluid Mechanics',
                    'description' => 'Study of fluids and the forces on them.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Circuit Analysis',
                    'description' => 'Analysis of electrical circuits.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Control Systems',
                    'description' => 'Study of dynamical systems and their control.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Engineering Design',
                    'description' => 'Principles and practices of engineering design.',
                    'credits' => 4,
                    'level' => 300
                ],
                [
                    'title' => 'Materials Science',
                    'description' => 'Study of the properties of materials.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Robotics',
                    'description' => 'Design and control of robotic systems.',
                    'credits' => 3,
                    'level' => 400
                ],
                [
                    'title' => 'Renewable Energy Systems',
                    'description' => 'Study of renewable energy technologies.',
                    'credits' => 3,
                    'level' => 400
                ]
            ],
            'BUS' => [
                [
                    'title' => 'Principles of Management',
                    'description' => 'Introduction to management theory and practice.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Financial Accounting',
                    'description' => 'Introduction to accounting principles and practices.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Microeconomics',
                    'description' => 'Study of economic behavior at the individual and firm level.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Macroeconomics',
                    'description' => 'Study of economic systems at the national level.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Marketing Management',
                    'description' => 'Study of marketing principles and practices.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Corporate Finance',
                    'description' => 'Study of financial decision-making in corporations.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Business Law',
                    'description' => 'Legal principles affecting business operations.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Business Ethics',
                    'description' => 'Ethical issues in business practice.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Strategic Management',
                    'description' => 'Study of organizational strategy and policy.',
                    'credits' => 3,
                    'level' => 400
                ],
                [
                    'title' => 'International Business',
                    'description' => 'Study of business operations in a global context.',
                    'credits' => 3,
                    'level' => 400
                ]
            ],
            'SCI' => [
                [
                    'title' => 'General Chemistry',
                    'description' => 'Introduction to chemical principles and theories.',
                    'credits' => 4,
                    'level' => 100
                ],
                [
                    'title' => 'Organic Chemistry',
                    'description' => 'Study of carbon-based compounds.',
                    'credits' => 4,
                    'level' => 200
                ],
                [
                    'title' => 'General Physics',
                    'description' => 'Introduction to physical principles and theories.',
                    'credits' => 4,
                    'level' => 100
                ],
                [
                    'title' => 'Calculus',
                    'description' => 'Study of change and motion.',
                    'credits' => 4,
                    'level' => 100
                ],
                [
                    'title' => 'General Biology',
                    'description' => 'Introduction to biological principles and theories.',
                    'credits' => 4,
                    'level' => 100
                ],
                [
                    'title' => 'Genetics',
                    'description' => 'Study of heredity and variation in organisms.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Ecology',
                    'description' => 'Study of interactions between organisms and their environment.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Quantum Mechanics',
                    'description' => 'Study of physical phenomena at nanoscopic scales.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Biochemistry',
                    'description' => 'Study of chemical processes within living organisms.',
                    'credits' => 4,
                    'level' => 300
                ],
                [
                    'title' => 'Astrophysics',
                    'description' => 'Application of physics to astronomical objects.',
                    'credits' => 3,
                    'level' => 400
                ]
            ],
            'ART' => [
                [
                    'title' => 'Introduction to Literature',
                    'description' => 'Survey of literary works and critical approaches.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'World History',
                    'description' => 'Survey of major historical events and trends.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Introduction to Philosophy',
                    'description' => 'Survey of philosophical ideas and methods.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Introduction to Psychology',
                    'description' => 'Survey of psychological theories and methods.',
                    'credits' => 3,
                    'level' => 100
                ],
                [
                    'title' => 'Art History',
                    'description' => 'Survey of artistic styles and movements.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Music Theory',
                    'description' => 'Study of musical composition and structure.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Introduction to Sociology',
                    'description' => 'Survey of sociological theories and methods.',
                    'credits' => 3,
                    'level' => 200
                ],
                [
                    'title' => 'Creative Writing',
                    'description' => 'Practice in writing fiction, poetry, and drama.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Film Studies',
                    'description' => 'Critical analysis of cinematic works.',
                    'credits' => 3,
                    'level' => 300
                ],
                [
                    'title' => 'Cultural Anthropology',
                    'description' => 'Study of human cultures and societies.',
                    'credits' => 3,
                    'level' => 300
                ]
            ]
        ];

        // Create 10 courses under each program
        foreach ($programs as $program) {
            $departmentCode = DB::table('departments')->where('id', $program->department_id)->value('code');
            $coursesForDepartment = $courseData[$departmentCode];
            
            foreach ($coursesForDepartment as $index => $course) {
                $courseCode = $program->code . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
                
                DB::table('courses')->insert([
                    'course_code' => $courseCode,
                    'title' => $course['title'],
                    'description' => $course['description'],
                    'program_id' => $program->id,
                    'department_id' => $program->department_id,
                    'credits' => $course['credits'],
                    'level' => $course['level'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}