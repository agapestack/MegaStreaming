<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'videos'; //TODO pas utile, par défaut il considère que table = nom du model au pluriel

    //TODO ajouter une propriété protected $fillable, exploitable dans les controllers : https://laravel.com/docs/7.x/eloquent#mass-assignment
    //TODO ajouter des casts, très utile pour forcer la reception d'une valeur de la BDD dans le bon format: https://laravel.com/docs/7.x/eloquent-mutators#attribute-casting
    // exemple pour ton bool `processed`, en BDD c'est 0 ou 1, tu veux le recevoir en bool
    // --> tu cast et tu n'as plus de risque de typage (un des défauts de nodejs sans typescript notamment)
}
