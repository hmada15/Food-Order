<?php

namespace App\Models;


use Carbon\Carbon;
use \DateTimeInterface;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{

    use HasApiTokens;

    public $table = 'clients';

    protected $hidden = [
        'remember_token',
        'password',
    ];

    const LANGUAGE_RADIO = [
        'option-en' => 'English',
        'option-ar' => 'Arabic',
    ];

    const GENDER_RADIO = [
        'option-male'   => 'Male',
        'option-female' => 'Female',
    ];

    protected $dates = [
        'email_verified_at',
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'gender',
        'language',
        'note',
        'email_verified_at',
        'password',
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function clientAddress()
    {
        return $this->hasMany(ClientAddress::class);
    }
}
