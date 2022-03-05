<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Agenda extends Model
{
    protected $fillable = [
        'specialty_id',
        'professional_id',
        'name',
        'source_id',
        'birthdate',
        'cpf',
    ];

    protected $casts = [
        'specialty_id' => 'int',
        'professional_id' => 'int',
        'name' => 'string',
        'source_id' => 'int',
        'birthdate' => 'date:d/m/Y',
        'date_time' => 'date:d/m/Y às h:i:s',
        'cpf' => 'string',
    ];

    public function setBirthdateAttribute($value)
    {
        if ($value) {
            $data = new DateTime($value);
            $this->attributes['birthdate'] = $data->format('Y-m-d');
        }
    }

    public function getBirthdateAttribute($value)
    {
        new DateTime($value);
        $data = new DateTime($this->attributes['birthdate']);
        return $data->format('d/m/Y');
    }

    public function getDateTimeAttribute($value)
    {
        if ($value) {
            new DateTime($value);
            $data = new DateTime($this->attributes['date_time']);
            return $data->format('d/m/Y às h:i:s');
        }
    }
}
