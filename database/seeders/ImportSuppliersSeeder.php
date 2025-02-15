<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ImportSuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = base_path('database/data.csv');  // Path to your CSV file
        $csvData = file_get_contents($csvFile);
        $rows = explode("\n", $csvData);
        $header = str_getcsv(array_shift($rows));  // Get the first row as header

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if (count($data) == count($header)) {
                $data = array_combine($header, $data);

                // Insert Supplier Data
                $supplier = DB::table('suppliers')->firstOrCreate(
                    ['supplier_name' => $data['supplier_name']],
                    ['supplier_name' => $data['supplier_name']]
                );
            }
        }
    }
}
