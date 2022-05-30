<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function get()
    {
        return Article::get();
    }

    public function getArticleWithTagById($id)
    {
        return Article::with('tags')->where('id', $id)->get();
    }

    public function filterArticle($validator)
    {
        $query = Article::with('tags');

        $search_by_title = $validator['search_by_title'];
        if ($search_by_title) {
            $query->where('title', 'like', '%' . $search_by_title . '%');
        }

        $from = $validator['from'];
        $to = $validator['to'];
        if ($from) {
            $query->whereBetween('created_at', [$from, $to]);
        }

        $search_by_tag_name = $validator['search_by_tag_name'];
        if ($search_by_tag_name) {
            $query->whereHas('tags', function($q) use ($search_by_tag_name) {
                $q->where('tag_name', $search_by_tag_name);
            });
        }

        $tag_active = (boolean) $validator['tag_active'];
        if ($tag_active) {
            $query->whereHas('tags', function($q) use ($tag_active) {
                $q->where('active', $tag_active);
            });
        }

        $order_by = $validator['order_by'];
        $direction = $validator['direction'] ?? 'asc';
        if ($order_by) {
            $query->orderBy($order_by, $direction);
        }



        return $query->get();
    }

}
