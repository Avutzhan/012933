<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleController extends Controller
{
    private ArticleRepositoryInterface $article;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->article = $articleRepository;
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ArticleRequest $request)
    {
        return response()->json($this->article->filterArticle($request->validated()));
    }
}
