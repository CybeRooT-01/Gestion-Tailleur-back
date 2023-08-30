<?php

namespace Database\Seeders;

use App\Models\taille;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tailleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tailles = [
            [
                "libelle"=>"XXS"
            ],
            [
                "libelle"=>"XS"
            ],
            [
                "libelle"=>"S"
            ],
            [
                "libelle"=>"M"
            ],
            [
                "libelle"=>"L"
            ],
            [
                "libelle"=>"XL"
            ],
            [
                "libelle"=>"XXL"
            ],
        ];
        taille::insert($tailles);
    }
}
