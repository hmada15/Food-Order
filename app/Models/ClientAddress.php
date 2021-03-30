<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ClientAddress extends Model
{
    use SoftDeletes;

    public $table = 'client_addresses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const BUILDING_TYPE_SELECT = [
        'option-villa'     => 'Villa',
        'option-apartment' => 'Apartment',
        'option-office'    => 'Office',
    ];

    protected $fillable = [
        'client_id',
        'area',
        'street_name',
        'building_type',
        'building_name',
        'floor_number',
        'apartment_number',
        'landmark',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function scopeAuthorized($query)
    {
        return $query->where('client_id', auth()->id());
    }
}
