<?php

namespace App\Repositories;

use Illuminate\Http\Request;

/**
 * Интерфейс репозитория
 */
interface RepositoryInterface
{
    public static function getAll();
    public static function getByRequest(Request $request, ?int $perPage = null);

    public static function create(array $params);
}
