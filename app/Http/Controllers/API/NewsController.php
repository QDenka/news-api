<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Traits\ApiResponser;
use App\Models\Category;
use App\Models\News;
use App\Repositories\NewsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    use ApiResponser;

    /**
     * Получение списка новостей
     *
     * @param Request $request
     * @return Response
     */
    public function get(Request $request): Response
    {
        $news = NewsRepository::getByRequest($request, 10);

        return $this->success(
            'Get news successful',
            compact('news')
        );
    }

    /**
     * Создание новости
     *
     * @param CreateNewsRequest $request
     * @return Response
     */
    public function create(CreateNewsRequest $request): Response
    {
        $params = $request->all();
        $params['category'] = Category::where('title', $params['category'])->first()->id;
        $news = NewsRepository::create($params);

        return $this->success(
            'News successful created',
            compact('news')
        );
    }

    /**
     * Добавить / Убрать лайк
     *
     * @param News $news
     * @return Response
     */
    public function toggleLike(News $news): Response
    {
        $state = NewsRepository::toggleLike($news);

        return $this->success(
            'Like toggle successful',
            compact('state')
        );
    }
}
