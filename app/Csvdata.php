<?php

namespace LoaMonitor;

use Illuminate\Database\Eloquent\Model;

class Csvdata extends Model
{
    protected $fillable = [
      'stamnr',
	  'geboortedatum',
	  'roepnaam',
	  'tussenv',
	  'achternaam',
	  'woonplaats',
	  'klas',
	  'created_at'
    ];
}
