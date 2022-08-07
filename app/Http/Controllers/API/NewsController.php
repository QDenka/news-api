<?php

namespace App\Http\Controller\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Traits\ApiResponser;
use App\Repositories\NewsRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use ApiResponser;

    public function get(Request $request): ResponseFactory
    {
        $news = NewsRepository::getByRequest($request, 10);

        return $this->success(
            'Get news successful',
            compact('news')
        );
    }

    public function create(CreateNewsRequest $request)
    {
        $news = NewsRepository::create($request->all());

        return $this->success(
            'News successful created',
            compact('news')
        );
    }
}
