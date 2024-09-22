<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    protected $guarded = [];
}
