<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomFieldDefinition extends Model
{
    protected $table = 'custom_field_definitions';

    protected $fillable = [
        'company_id',
        'entity_type',
        'name',
        'label',
        'type',
        'options',
        'is_required',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
    ];

    public $timestamps = true;
}
