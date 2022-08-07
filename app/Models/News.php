<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * 
 * @property int $id
 * @property string $title
 * @property int $category
 * @property int $author
 * @property Carbon $publishedAt
 * 
 * @property User $user
 * @property Collection|NewsLike[] $news_likes
 *
 * @package App\Models
 */
class News extends Model
{
	protected $table = 'news';
	public $timestamps = false;

	protected $casts = [
		'category' => 'int',
		'author' => 'int',
		'publishedAt' => 'datetime'
	];

	protected $dates = [
		'publishedAt'
	];

	protected $fillable = [
		'title',
		'category',
		'author',
		'publishedAt'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'author');
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'category');
	}

	public function news_likes()
	{
		return $this->hasMany(NewsLike::class, 'news');
	}
}
