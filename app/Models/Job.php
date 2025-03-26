<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Created using `php artisan make:model Job` command
class Job extends Model {
    use HasFactory;

    protected $table = 'job_listings';

    protected $fillable = ['title', 'salary'];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }


    //it belongs to and can have many
    public function tags()
    {
        //foreignPivotkey used when the eloquent class is different
        return $this->belongsToMany(Tag::class, foreignPivotKey: "job_listing_id");
    }
}
