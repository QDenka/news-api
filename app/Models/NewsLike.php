<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsLike
 * 
 * @property int $id
 * @property int $news
 * @property int $user
 * @property Carbon $likedAt
 * 
 *
 * @package App\Models
 */
class NewsLike extends Model
{
	protected $table = 'news_likes';
	public $timestamps = false;

	protected $casts = [
		'news' => 'int',
		'user' => 'int',
		'likedAt' => 'datetime'
	];

	protected $dates = [
		'likedAt'
	];

	protected $fillable = [
		'news',
		'user',
		'likedAt'
	];

	public function news()
	{
		return $this->belongsTo(News::class, 'news');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user');
	}
}
