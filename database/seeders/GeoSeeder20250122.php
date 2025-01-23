<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class GeoSeeder20250122 extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Snapshots\Snapshot20250122\EntitiesTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\FlagsTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\RelationsTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\LocationsTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\LanguagesTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\EntityAbbreviationsTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\EntityNamesTableSeeder::class);
        $this->call(Snapshots\Snapshot20250122\EntityLanguagesTableSeeder::class);
    }
}
