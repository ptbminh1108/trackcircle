<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
        'user_id',
        'customer_type',
        'customer_number',
        'salutation',
        'firstname',
        'lastname',
        'company_initial',
        'company_name',
        'display_name',
        'customer_email',
        'company_phone',
        'company_mobile_phone'
   ];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   // protected $hidden = [
   //     'password',
   //     'remember_token',
   // ];

   /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
   protected $casts = [
       'created_at' => 'datetime',
       'updated_at' => 'datetime',
   ];

   public function users(): HasMany
   {
       return $this->HasMany(User::class,'id');
   }
}
