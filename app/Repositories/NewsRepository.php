<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsRepository implements RepositoryInterface
{
    public static function getAll(): News
    {
        return News::get();
    }

    public static function getByRequest(Request $request, ?int $perPage = null): News
    {
        $news = News::query();

        if ($request->category)
            $news->where('category', $request->category);

        $news->orderByDesc('publishedAt');

        return $perPage ? $news->paginate($perPage) : $news->get();
    }

    public static function create(array $params): News
    {
        $params['author'] = Auth::user()->id;
        $params['category'] = CategoryRepository::getByTitle($params['category'])->id;

        $news = News::createOrFail($params);

        return $news;
    }
}
