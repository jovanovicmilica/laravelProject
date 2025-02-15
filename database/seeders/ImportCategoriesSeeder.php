<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class ImportCategoriesSeeder extends Seeder
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

                if($data['category']!=""){
                    Category::firstOrCreate(
                        ['category_name' => $data['category']]
                    );
                }

            }
        }
    }
}
