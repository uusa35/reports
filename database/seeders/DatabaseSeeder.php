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
//        $governates = json_decode(file_get_contents('https://api.mirsalapp.com/rest/areas?lang=en'), true);
        $governates = [
            [
                name_ar => 'محافظة العاصمة',
                name_en => 'Al Asima Governate',
            ],
            [
                name_ar => 'محافظة الأحمدي',
                name_en => 'Al Ahmadi Governate',
            ],
            [
                name_ar => 'محافظة الفروانية',
                name_en => 'Al Farwaniya Governate',
            ],
            [
                name_ar => 'محافظة حولي',
                name_en => 'Al Hawali Governate',
            ],
            [
                name_ar => 'محافظة الجهراء',
                name_en => 'Al Jahra Governate',
            ],
            [
                name_ar => 'محافظة مبارك الكبير',
                name_en => 'Al Mubarak Al kabeer Governate',
            ],
        ];
        $departments = [
            [
                name_ar => 'مرور العاصمة',
                name_en => 'Al-Asima Traffic Department',
            ],
            [
                name_ar => 'مرور الأحمدي',
                name_en => 'Al Ahmadi Traffic Department',
            ],
            [
                name_ar => 'مرور الفروانية',
                name_en => 'Al Farwaniya Traffic Department',
            ],
            [
                name_ar => 'مرور حولي',
                name_en => 'Al Hawali Traffic Department',
            ],
            [
                name_ar => 'مرور الجهراء',
                name_en => 'Al Jahra Traffic Department',
            ],
            [
                name_ar => 'مرور مبارك الكبير',
                name_en => 'Al Mubarak Al kabeer Traffic Department',
            ],
        ];
        foreach ($governates as $gov) {
            dd($gov);
            Governate::create([
                'name_ar' => $gov['name_ar'],
                'name_en' => $gov['name_en']
            ]);
        }
        ReportType::factory(3)->create();
        User::factory(100)->create()->each(function ($u) {
            if ($u->id === 1) {
                $u->update(['is_admin' => true, 'email' => 'admin@admin.com', 'active' => true, 'civil_id_no' => 1111, 'passport_no' => 1111]);
            } else if ($u->id === 2) {
                $u->update(['is_admin' => false, 'email' => 'officer@officer.com', 'is_officer' => true, 'active' => true, 'civil_id_no' => 2222, 'file_no' => 2222]);
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
