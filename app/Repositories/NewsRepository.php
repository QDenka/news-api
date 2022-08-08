<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\News;
use App\Models\NewsLike;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class NewsRepository implements RepositoryInterface
{
    /**
     * Получение всех новостей
     *
     * @return News
     */
    public static function getAll(): News
    {
        return News::get();
    }

    /**
     * Получение новости по запросу
     *
     * @param Request $request
     * @param integer|null $perPage
     * @return News|LengthAwarePaginator
     */
    public static function getByRequest(Request $request, ?int $perPage = null): News|LengthAwarePaginator
    {
        $news = News::query()->with(['category', 'likes']);

        if ($request->category)
            $news->where('category', $request->category);

        $news->orderByDesc('publishedAt');

        return $perPage ? $news->paginate($perPage) : $news->get();
    }

    /**
     * Создание новости
     *
     * @param array $params
     * @return News
     */
    public static function create(array $params): News
    {
        $params['author'] = Auth::user()->id;

        $news = News::create($params);

        return $news;
    }

    /**
     * Добавить / Убрать лайк
     *
     * @param News $news
     * @return string
     */
    public static function toggleLike(News $news): string
    {
        return NewsLike::toggleLike(Auth::user()->id, $news->id);
    }
}
