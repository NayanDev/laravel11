<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $qualifications = [
            'SMA',
            'Bachelor',
            'Sertifikasi APT',
            'Magister',
            'Doctoral',
            'Professor',
        ];

        foreach ($qualifications as $name) {
            Qualification::create(['name' => $name]);
        }
    }
}
