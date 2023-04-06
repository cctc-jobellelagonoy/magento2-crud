<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagProduct extends Model
{
    public $id;
    public $sku;
    public $name;
    public $price;
    public $status;
    public $total_count;
    public $description;
    public $file;


    public function __construct($id, $sku, $name, $price, $status, $total_count, $description, $file)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->status = $status;
        $this->total_count = $total_count;
        $this->description = $description;
        $this->file = $file;
    }
}
