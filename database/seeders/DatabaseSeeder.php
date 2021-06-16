<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportType;
use App\Models\User;
use App\Models\Vehicle;
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
        ReportType::factory(4)->create();
        User::factory(20)->create()->each(function ($u) {
            if ($u->id === 1) {
                $u->update(['is_admin' => true, 'email' => 'admin@admin.com']);
            } else if ($u->id === 2) {
                $u->update(['is_admin' => false, 'email' => 'officer@officer.com', 'is_officer' => true]);
            } else if ($u->id === 3) {
                $u->update(['is_admin' => false, 'email' => 'user@user.com', 'is_officer' => false]);
            }
            $u->vehicles()->saveMany(Vehicle::factory(2)->create());
        });
        Report::factory(50)->create()->each(function ($q) {
            return $q->vehicles()->saveMany(Vehicle::factory(2));
        });
    }
}
