<?php

namespace Database\Seeders;

use App\Models\Governate;
use App\Models\Report;
use App\Models\ReportType;
use App\Models\User;
use App\Models\Vehicle;
use Database\Factories\GovernateFactory;
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
        $governates = json_decode(file_get_contents('https://api.mirsalapp.com/rest/areas?lang=en'), true);
        $govs = collect($governates['data']);
        foreach ($govs->pluck('name') as $key => $val) {
            Governate::create([
                'name' => $val
            ]);
        }
        ReportType::factory(3)->create();
        User::factory(100)->create()->each(function ($u) {
            if ($u->id === 1) {
                $u->update(['is_admin' => true, 'email' => 'admin@admin.com', 'active' => true, 'civil_id_no' => 1111, 'passport_no' => 1111]);
            } else if ($u->id === 2) {
                $u->update(['is_admin' => false, 'email' => 'officer@officer.com', 'is_officer' => true, 'active' => true, 'civil_id_no' => 2222, 'police_no' => 2222]);
            } else if ($u->id === 3) {
                $u->update(['is_admin' => false, 'email' => 'user@user.com', 'is_officer' => false, 'active' => true, 'civil_id_no' => 3333, 'passport_no' => 3333]);
            }
            $u->vehicles()->saveMany(Vehicle::factory(2)->create());
        });
        Report::factory(50)->create()->each(function ($q) {
            return $q->vehicles()->saveMany(Vehicle::factory(2));
        });
    }
}
