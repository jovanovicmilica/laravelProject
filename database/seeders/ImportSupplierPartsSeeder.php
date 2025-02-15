<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Part;
use App\Models\Supplier;
use App\Models\Supplier_Part;
use Illuminate\Database\Seeder;

class ImportSupplierPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //



        $csvFile = public_path('suppliers.csv');
        $csvData = file_get_contents($csvFile);
        $rows = explode("\n", $csvData);
        $header = str_getcsv(array_shift($rows));

        foreach ($rows as $row) {
            $data = str_getcsv($row);
            if (count($data) == count($header)) {
                $data = array_combine($header, $data);



//                Supplier_Parts ////
//                • supplier_product_id (Pk).
//                • supplier_id.
//                • part_id.
//                • days_valid.
//                • priority_id.
//                • quantity.
//                • price.
//                • condition_id (Nullable)

                $condition_name = $data['condition'];
                $condition = Condition::where('condition_name', $condition_name)->first();

                $condition_id = $condition ? $condition->id : null;

                $supplier_name = $data['supplier_name'];
                $supplier = Supplier::where('supplier_name', $supplier_name)->first();

                $supplier_id = $supplier ? $supplier->id : null;

                $part_name = $data['part_number'];
                $part = Part::where('part_number', $part_name)->first();

                $part_id = $part ? $part->id : null;

                $daysValid = $data['days_valid']!="" ? (int)$data['days_valid'] : null;
                $priority = $data['priority']!="" ? (int)$data['priority'] : null;
                $quantity = $data['quantity']!="" ? (int)$data['quantity'] : null;
                $price = $data['price']!="" ? (int)$data['price'] : null;

                Supplier_Part::create([
                    'supplier_id' => $supplier_id,
                    'part_id' => $part_id,
                    'days_valid' => $daysValid,
                    'priority' => $priority,
                    'quantity' => $quantity,
                    'price' => $price,
                    'condition_id' => $condition_id
                ]);

            }
        }
    }
}
