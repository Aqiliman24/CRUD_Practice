<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'quantity', 'detail','user_id','attachment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function search()
    {
        Route::any('/search',function()
        {
            $q = Input::get ( 'q' );
            $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
            if(count($user) > 0)
                return view('welcome')->withDetails($Product)->withQuery ( $q );
            else return view ('welcome')->withMessage('No Details found. Try to search again !');
        });
    }

}
