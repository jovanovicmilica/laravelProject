<?php

namespace Database\Seeders;

use App\Models\Supplier;
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
        $csvFile = public_path('suppliers.csv');
        $csvData = file_get_contents($csvFile);
        $rows = explode("\n", $csvData);
        $header = str_getcsv(array_shift($rows));

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if (count($data) == count($header)) {
                $data = array_combine($header, $data);

                if($data['supplier_name']!=""){
                    Supplier::firstOrCreate(
                        ['supplier_name' => $data['supplier_name']],
                    );
                }

            }
        }
    }
}
