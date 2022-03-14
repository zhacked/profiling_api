<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AchievementSeeder::class,
            AffiliationSeeder::class,
            ApplicationSeeder::class,
            BannerSeeder::class,
            DepartmentSeeder::class,
            EducationalBackgroundSeeder::class,
            EducationSeeder::class,
            IndustrySeeder::class,
            JobLevelSeeder::class,
            JobSeeder::class,
            JobTypeSeeder::class,
            LocationSeeder::class,
            ProficiencyLevelSeeder::class,
            ProjectSeeder::class,
            RolesSeeder::class,
            SchedulerSeeder::class,
            SkillSeeder::class,
            TrainingSeeder::class,
            UsersSeeder::class,

        ]);
    }
}
