<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservation
 * 
 * @property int $post_id
 * @property int $user_id
 * @property Carbon $date_arrivee
 * @property Carbon $date_depart
 * @property int $nombre_nuits
 * @property int $nombre_invites
 * @property string $statut
 * @property int $montant_total
 * @property string $devise
 * @property string|null $id_paiement_intention
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Post $post
 * @property User $user
 *
 * @package App\Models
 */
class Reservation extends Model
{
	protected $table = 'reservations';
	public $incrementing = false;

	protected $casts = [
		'post_id' => 'int',
		'user_id' => 'int',
		'date_arrivee' => 'datetime',
		'date_depart' => 'datetime',
		'nombre_nuits' => 'int',
		'nombre_invites' => 'int',
		'montant_total' => 'int'
	];

	protected $fillable = [
		'post_id',
		'user_id',
		'date_arrivee',
		'date_depart',
		'nombre_nuits',
		'nombre_invites',
		'statut',
		'montant_total',
		'devise',
		'id_paiement_intention'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
