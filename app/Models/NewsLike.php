<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
	use HasFactory;

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

	/**
	 * Получение лайка пользователя на новости
	 *
	 * @param integer $user
	 * @param integer $news
	 * @return boolean
	 */
	public static function hasLike(int $user, int $news): ?NewsLike
	{
		return self::where('user', $user)
			->where('news', $news)->first();
	}

	public static function toggleLike(int $user, int $news): string
	{
		$state = 'liked';
		$like = self::hasLike($user, $news);

		if ($like) {
			$like->delete();
			$state = 'unliked';
		} else {
			$like = new self();
			$like->user = $user;
			$like->news = $news;
			$like->save();
		}

		return $state;
	}
}
