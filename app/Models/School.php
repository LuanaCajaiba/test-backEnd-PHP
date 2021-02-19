<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'city'];

    protected $dates = ['deleted_at'];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function test_models_can_be_instantiated()
    {
        $user = User::factory()->make();
    }
}
