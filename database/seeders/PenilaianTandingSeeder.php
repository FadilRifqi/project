<?php

namespace Database\Seeders;

use App\Models\PenilaianTanding;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianTandingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $PenilaianTanding = [
            [
                'babak' => 1,
                'atlet'=>1
            ],
            [
                'babak' => 2,
                'atlet'=>1
            ],
            [
                'babak' => 3,
                'atlet'=>1
            ],
            [
                'babak' => 1,
                'atlet'=>2
            ],
            [
                'babak' => 2,
                'atlet'=>2
            ],
            [
                'babak' => 3,
                'atlet'=>2
            ]
        ];
        PenilaianTanding::query()->insert($PenilaianTanding);
    }
    
}
