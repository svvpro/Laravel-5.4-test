<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Article;
use App\Repositories\ArticleRepository;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ArticleController extends SiteController
{
    public function __construct(ArticleRepository $a_rep)
    {
        parent::__construct(new MenuRepository(new Menu()));
        $this->a_rep = $a_rep;
        $this->template = 'articles';
    }

    public function index()
    {
        $articles = Article::latest('created_at')->createdAt()->get();

        $articles->transform(function ($item) {
            $item->image = json_decode($item->image);
            return $item;
        });

        $content = view('articles-list', compact('articles'))->render();

        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function show(Article $article)
    {

        $article->image = json_decode($article->image);

        $content = view('article-single')->with('article', $article)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        return $this->renderOutput();
    }
}
