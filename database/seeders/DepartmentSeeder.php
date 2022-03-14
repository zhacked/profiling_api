<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'Administration and General',
            'Asset Management',
            'Bakery and Pastry',
            'Cargo',
            'Casino',
            'Catering', 
            'Club Floor',
            'Concierge',
            'Customer Service',
            'E-commerce',
            'Engineering / Technical Services',
            'Finance / Accounting',
            'Flight Crew',
            'Food and Beverage Kitchen',
            'Food and Beverage Others',
            'Food and Beverage Service',
            'Front Office' ,
            'Ground Crew',
            'Guest Relations',
            'Housekeeping',
            'Human Resources' ,
            'Information Technology',
            'Legal',
            'Logistics',
            'Management',
            'Marketing Communications',
            'Meetings and Events',
            'Operations',
            'Others',
            'Passenger Handling',
            'Procurement',
            'Public Relations', 
            'Recreation and Entertainment',
            ' Reservations',
            'Retail',
            'Revenue Management',
            'Rooms Division',
            'Sales' ,
            'Sales and Marketing',
            'Security',
            'Spa and Wellness',
            'Surveillance',
            'Talent Acquisition',
            'Transportation',
  
        ];

        foreach($departments as $department) {
            Department::create([
                'name'  => $department
            ]);
        }
    }
}
