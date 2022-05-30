<?php

namespace App\Repositories\Interfaces;

interface ArticleRepositoryInterface
{
    public function get();
    public function getArticleWithTagById($id);
    public function filterArticle($validator);
}
