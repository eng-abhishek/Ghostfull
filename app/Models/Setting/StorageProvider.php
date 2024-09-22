<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class StorageProvider extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'storage_providers';

    protected $guarded = [];
}
