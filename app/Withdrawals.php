<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Withdrawals extends Model
{
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'amount',
    ];
  //create a relationship between withdrawals and user
     public function user() {
        return $this->belongsTo('App\User');
    }
    
  
}
