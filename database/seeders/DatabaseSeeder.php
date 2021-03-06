<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Governate;
use App\Models\Image;
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
        $governates = [
            [
                "name_ar" => 'محافظة العاصمة',
                "name_en" => 'Al Asima Governate',
            ],
            [
                "name_ar" => 'محافظة الأحمدي',
                "name_en" => 'Al Ahmadi Governate',
            ],
            [
                "name_ar" => 'محافظة الفروانية',
                "name_en" => 'Al Farwaniya Governate',
            ],
            [
                "name_ar" => 'محافظة حولي',
                "name_en" => 'Al Hawali Governate',
            ],
            [
                "name_ar" => 'محافظة الجهراء',
                "name_en" => 'Al Jahra Governate',
            ],
            [
                "name_ar" => 'محافظة مبارك الكبير',
                "name_en" => 'Al Mubarak Al kabeer Governate',
            ],
        ];
        $departments = [
            [
                "name_ar" => 'مرور العاصمة',
                "name_en" => 'Al-Asima Traffic Department',
                'is_traffic' => true
            ],
            [
                "name_ar" => 'مرور الأحمدي',
                "name_en" => 'Al Ahmadi Traffic Department',
                'is_traffic' => true
            ],
            [
                "name_ar" => 'مرور الفروانية',
                "name_en" => 'Al Farwaniya Traffic Department',
                'is_traffic' => true
            ],
            [
                "name_ar" => 'مرور حولي',
                "name_en" => 'Al Hawali Traffic Department',
                'is_traffic' => true
            ],
            [
                "name_ar" => 'مرور الجهراء',
                "name_en" => 'Al Jahra Traffic Department',
                'is_traffic' => true
            ],
            [
                "name_ar" => 'مرور مبارك الكبير',
                "name_en" => 'Al Mubarak Al kabeer Traffic Department',
                'is_traffic' => true
            ],
            [
                "name_ar" => 'تحقيق الحوادث',
                "name_en" => 'Accident Inspection Department.',
                'is_engineering' => true
            ],
            [
                "name_ar" => 'الطوارئ الطبية',
                "name_en" => 'Medical Emergency Department.',
                'is_medical' => true
            ],
            [
                "name_ar" => 'هندسة المرور',
                "name_en" => 'Traffic Engineering Department',
                'is_engineering' => true
            ],
            [
                "name_ar" => 'الإطفاء',
                "name_en" => 'Fire Department',
                'is_fire' => true
            ],
        ];
        $reportTypes = [
            [
                'name' => 'Minor Accident',
                'is_traffic' => true,
                'is_ambulance' => false,
                'is_fire' => false,
                'is_damage' => false,
            ],
            [
                'name' => 'Accident with Injury',
                'is_traffic' => true,
                'is_ambulance' => true,
                'is_fire' => false,
                'is_damage' => false,
            ],
            [
                'name' => 'Calling Ambulance',
                'is_traffic' => false,
                'is_ambulance' => true,
                'is_fire' => false,
                'is_damage' => false,
            ],
            [
                'name' => 'Fire Accident',
                'is_traffic' => true,
                'is_ambulance' => true,
                'is_fire' => false,
                'is_damage' => false,
            ],
            [
                'name' => 'Property Damage',
                'is_traffic' => false,
                'is_ambulance' => false,
                'is_damage' => true,
                'is_fire' => false
            ],
            [
                'name' => 'Traffic Violation',
                'is_traffic' => true,
                'is_ambulance' => false,
                'is_fire' => false,
                'is_damage' => false,
            ],
        ];
        foreach ($governates as $element) {
            Governate::create([
                'name_ar' => $element['name_ar'],
                'name_en' => $element['name_en']
            ]);
        }
        foreach ($departments as $element) {
            Department::create([
                'name_ar' => $element['name_ar'],
                'name_en' => $element['name_en'],
                "is_traffic" => array_key_exists('is_traffic', $element),
                "is_fire" => array_key_exists('is_fire', $element),
                "is_engineering" => array_key_exists('is_engineering', $element),
                "is_medical" => array_key_exists('is_medical', $element),
            ]);
        }
        foreach ($reportTypes as $element) {
            ReportType::factory(1)->create([
                'name' => $element['name'],
                'description' => $element['name'],
                'notes' => $element['name'],
                'is_traffic' => $element['is_traffic'],
                'is_ambulance' => $element['is_ambulance'],
                'is_fire' => $element['is_fire'],
                'is_damage' => $element['is_damage'],
            ]);
        }
        User::factory(100)->create()->each(function ($u) {
            if ($u->id === 1) {
                $u->update(['is_admin' => true, 'email' => 'admin@admin.com', 'active' => true, 'civil_id_no' => 111111111111, 'passport_no' => 1111]);
            } else if ($u->id === 2) {
                $u->update(['is_admin' => false, 'email' => 'officer@officer.com', 'is_officer' => true, 'active' => true, 'civil_id_no' => 222222222222, 'file_no' => 2222]);
            } else if ($u->id === 3) {
                $u->update(['is_admin' => false, 'email' => 'user@user.com', 'is_officer' => false, 'active' => true, 'civil_id_no' => 333333333333, 'passport_no' => 3333]);
            }
            $u->vehicles()->saveMany(Vehicle::factory(2)->create());
        });
        Report::factory(50)->create()->each(function ($q) {
            return $q->vehicles()->saveMany(Vehicle::factory(2));
            return $q->images()->saveMany(Image::factory(2));
        });
    }
}
