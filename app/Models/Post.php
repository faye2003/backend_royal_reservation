<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * 
 * @property int $id
 * @property int $user_id
 * @property string $titre
 * @property string $slug
 * @property string $type
 * @property string $description
 * @property string $ville
 * @property string $pays
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $prix_base
 * @property string $devise
 * @property int $frais_menage
 * @property int $pourcentage_frais_service
 * @property int $nb_min_nuits
 * @property int $nb_max_nuits
 * @property bool $reservation_instantanee
 * @property string $statut
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Reservation|null $reservation
 * @property Collection|Calendar[] $calendars
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'posts';

	protected $casts = [
		'user_id' => 'int',
		'latitude' => 'float',
		'longitude' => 'float',
		'prix_base' => 'int',
		'frais_menage' => 'int',
		'pourcentage_frais_service' => 'int',
		'nb_min_nuits' => 'int',
		'nb_max_nuits' => 'int',
		'reservation_instantanee' => 'bool'
	];

	protected $fillable = [
		'user_id',
		'titre',
		'slug',
		'type',
		'description',
		'ville',
		'pays',
		'latitude',
		'longitude',
		'prix_base',
		'devise',
		'frais_menage',
		'pourcentage_frais_service',
		'nb_min_nuits',
		'nb_max_nuits',
		'reservation_instantanee',
		'statut'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function reservation()
	{
		return $this->hasOne(Reservation::class);
	}

	public function calendars()
	{
		return $this->hasMany(Calendar::class);
	}
}
