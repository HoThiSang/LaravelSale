<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Các trường fillable nếu cần
    protected $fillable = [
        'name', 'gender', 'email', 'address', 'phone_number', 'note', 'created_at', 'updated_at',
    ];


     public static function getCustomerById($id)
    {
        return static::find($id);
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
