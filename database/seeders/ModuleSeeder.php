<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('modules')->insert([
            // ['name' => 'Introduction to Programming', 'global_level_id' => 4, 'description' => 'Covers Python and basic algorithms'],
            // ['name' => 'Human-Computer Interaction', 'global_level_id' => null, 'description' => 'User experience and design principles'],
            // ['name' => 'Constitutional Law', 'global_level_id' => 4, 'description' => 'Foundation in legal systems'],

            //Computer Science & IT
            ['name' => 'Introduction to Programming', 'global_level_id' => 1, 'description' => 'Fundamentals of Python and basic algorithms'],
            ['name' => 'Object-Oriented Programming', 'global_level_id' => 2, 'description' => 'Java/C++ and OOP principles'],
            ['name' => 'Data Structures & Algorithms', 'global_level_id' => 3, 'description' => 'Advanced algorithms and efficiency analysis'],
            ['name' => 'Machine Learning', 'global_level_id' => 4, 'description' => 'Neural networks and AI model training'],
            ['name' => 'Database Systems', 'global_level_id' => 2, 'description' => 'SQL, normalization, and relational databases'],
            ['name' => 'Web Development', 'global_level_id' => 2, 'description' => 'HTML, CSS, JavaScript, and frameworks'],
            ['name' => 'Computer Networks', 'global_level_id' => 3, 'description' => 'TCP/IP, routing, and network security'],
            ['name' => 'Operating Systems', 'global_level_id' => 3, 'description' => 'Kernels, processes, and memory management'],
            ['name' => 'Cybersecurity Fundamentals', 'global_level_id' => 2, 'description' => 'Encryption, firewalls, and ethical hacking'],
            ['name' => 'Cloud Computing', 'global_level_id' => 4, 'description' => 'AWS, Azure, and distributed systems'],
            ['name' => 'Human-Computer Interaction', 'global_level_id' => 3, 'description' => 'UX design and usability testing'],

            //Business & Management
            ['name' => 'Principles of Marketing', 'global_level_id' => 1, 'description' => '4Ps, branding, and consumer behavior'],
            ['name' => 'Financial Accounting', 'global_level_id' => 2, 'description' => 'Balance sheets and income statements'],
            ['name' => 'Organizational Behavior', 'global_level_id' => 2, 'description' => 'Team dynamics and leadership'],
            ['name' => 'Strategic Management', 'global_level_id' => 4, 'description' => 'Corporate decision-making and long-term planning'],
            ['name' => 'Business Analytics', 'global_level_id' => 3, 'description' => 'Data-driven decision-making'],
            ['name' => 'International Business', 'global_level_id' => 3, 'description' => 'Global trade and multinational operations'],
            
            //Law
            ['name' => 'Introduction to Law', 'global_level_id' => 1, 'description' => 'Legal systems and basic terminology'],
            ['name' => 'Constitutional Law', 'global_level_id' => 2, 'description' => 'Government structures and civil rights'],
            ['name' => 'Contract Law', 'global_level_id' => 3, 'description' => 'Agreements, breaches, and remedies'],
            ['name' => 'Criminal Law', 'global_level_id' => 3, 'description' => 'Felonies, defenses, and legal procedures'],
            ['name' => 'International Law', 'global_level_id' => 4, 'description' => 'Treaties and cross-border disputes'],

            //Engineering
            ['name' => 'Engineering Mathematics', 'global_level_id' => 1, 'description' => 'Calculus and linear algebra for engineers'],
            ['name' => 'Thermodynamics', 'global_level_id' => 2, 'description' => 'Heat transfer and energy systems'],
            ['name' => 'Circuit Analysis', 'global_level_id' => 2, 'description' => 'Ohm’s Law and electronic components'],
            ['name' => 'Control Systems', 'global_level_id' => 4, 'description' => 'Feedback loops and automation'],
            ['name' => 'Robotics', 'global_level_id' => 4, 'description' => 'Kinematics and AI-driven machines'],

            //Medicine & Health Sciences
            ['name' => 'Anatomy & Physiology', 'global_level_id' => 1, 'description' => 'Human body systems and functions'],
            ['name' => 'Biochemistry', 'global_level_id' => 2, 'description' => 'Metabolic pathways and molecular biology'],
            ['name' => 'Pharmacology', 'global_level_id' => 3, 'description' => 'Drug interactions and mechanisms'],
            ['name' => 'Clinical Medicine', 'global_level_id' => 4, 'description' => 'Diagnosis and treatment protocols'],

            //Humanities & Social Sciences
            ['name' => 'Introduction to Psychology', 'global_level_id' => 1, 'description' => 'Behavioral theories and cognitive processes'],
            ['name' => 'Sociological Theory', 'global_level_id' => 3, 'description' => 'Marx, Weber, and Durkheim'],
            ['name' => 'Political Philosophy', 'global_level_id' => 4, 'description' => 'Hobbes, Locke, and Rousseau'],

            //Natural Sciences
            ['name' => 'General Chemistry', 'global_level_id' => 1, 'description' => 'Atomic structure and chemical bonds'],
            ['name' => 'Quantum Physics', 'global_level_id' => 4, 'description' => 'Wave functions and particle duality'],

            //Arts & Design
            ['name' => 'Color Theory', 'global_level_id' => 1, 'description' => 'Palettes and visual harmony'],
            ['name' => '3D Modeling', 'global_level_id' => 3, 'description' => 'Blender/Maya and digital sculpting'],

            // Interdisciplinary
            ['name' => 'Research Methods', 'global_level_id' => 2, 'description' => 'Qualitative and quantitative approaches'],
            ['name' => 'Ethics in Technology', 'global_level_id' => 3, 'description' => 'AI bias and digital privacy'],
        ]);
    }
}