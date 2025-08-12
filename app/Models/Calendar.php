<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Calendar
 * 
 * @property int $id
 * @property int $post_id
 * @property Carbon $date
 * @property bool $est_bloque
 * @property int|null $prix_modifie
 * @property int|null $duree_min_modifiee
 * 
 * @property Post $post
 *
 * @package App\Models
 */
class Calendar extends Model
{
	protected $table = 'calendars';
	public $timestamps = false;

	protected $casts = [
		'post_id' => 'int',
		'date' => 'datetime',
		'est_bloque' => 'bool',
		'prix_modifie' => 'int',
		'duree_min_modifiee' => 'int'
	];

	protected $fillable = [
		'post_id',
		'date',
		'est_bloque',
		'prix_modifie',
		'duree_min_modifiee'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
