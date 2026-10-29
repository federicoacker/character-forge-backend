<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $catalogTables = [
            'backgrounds',
            'feats',
            'features',
            'professions',
            'proficiencies',
            'species',
            'spells',
        ];

        foreach ($catalogTables as $table) {
            if (DB::table($table)->exists()) {
                throw new RuntimeException(
                    "Catalog data already exists in {$table}; refusing to seed duplicate records."
                );
            }
        }

        DB::transaction(function (): void {
            $this->call([
                ProficienciesTableSeeder::class,
                FeatsTableSeeder::class,
                FeaturesTableSeeder::class,
                BackgroundsTableSeeder::class,
                SpeciesTableSeeder::class,
                ProfessionsTableSeeder::class,
                SpellsTableSeeder::class,
                FeatureSpeciesTableSeeder::class,
            ]);
        });
    }
}
