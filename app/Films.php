<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model {

    protected $fillable = [
        'id','name','category','premiere','description','pegi','created_at','updated_at',
    ];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}