<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $title
 * @property Carbon $createdAt
 * 
 * @property Collection|News[] $news
 *
 * @package App\Models
 */
class Category extends Model
{
	use HasFactory;

	protected $table = 'categories';
	public $timestamps = false;

	protected $casts = [
		'createdAt' => 'datetime'
	];

	protected $dates = [
		'createdAt'
	];

	protected $fillable = [
		'title',
		'createdAt'
	];

	public function news()
	{
		return $this->hasMany(News::class, 'category');
	}
}
