<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = 'categories'; //TODO pas utile, par défaut il considère que table = nom du model au pluriel

    //TODO ajouter une propriété protected $fillable, exploitable dans les controllers : https://laravel.com/docs/7.x/eloquent#mass-assignment
}
