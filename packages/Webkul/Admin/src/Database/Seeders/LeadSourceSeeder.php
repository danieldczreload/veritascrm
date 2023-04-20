<?php

namespace Webkul\Admin\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeadSourceSeeder extends Seeder
{

    public function run()
    {
        DB::table('lead_sources')->delete();

        $now = Carbon::now();

        DB::table('lead_sources')->insert([
            [
                'id'         => 1,
                'name'       => 'Correo electrónico',
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id'         => 2,
                'name'       => 'Página web',
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id'         => 3,
                'name'       => 'Redes sociales',
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id'         => 4,
                'name'       => 'Teléfono',
                'created_at' => $now,
                'updated_at' => $now,
            ], [
                'id'         => 5,
                'name'       => 'Visitas',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
