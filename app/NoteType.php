<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class NoteType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description',
	];

}

