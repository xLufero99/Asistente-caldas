<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ingreso
 *
 * @property $id
 * @property $monto
 * @property $nombre
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ingreso extends Model
{
    
    static $rules = [
		'monto' => 'required',
		'nombre' => 'required',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * 
     *
     * @var array
     */
    protected $fillable = ['monto','nombre','fecha'];



}
