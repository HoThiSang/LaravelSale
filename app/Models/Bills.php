<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bills extends Model
{
  use HasFactory;
  protected $table = 'bills';


  public function bill_detail()
  {
    return $this->hasMany('App\Models\BillDetail', 'id_customer', 'id');
  }

 

  public function creatNewBill($data)
  {
    return DB::table($this->table)->insertGetId($data);
  }
}
