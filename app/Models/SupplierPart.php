<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPart extends Model
{
    use HasFactory;


    protected $table = 'supplier_parts';

    protected $primaryKey = 'supplier_product_id';


    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function part()
    {
        return $this->belongsTo(Part::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
