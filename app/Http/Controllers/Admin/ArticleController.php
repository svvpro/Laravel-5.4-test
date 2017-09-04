<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\ArticleRequest;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Article;

class ArticleController extends AdminController
{
    protected $a_rep;

    public function __construct(ArticleRepository $a_rep)
    {
        parent::__construct();
        $this->a_rep = $a_rep;
        $this->template = 'admin.index';
    }

    public function index(Article $article)
    {

        if (\Gate::denies('index', $article)) {
            echo 'You have no-permission';
            exit();
        }

        $this->title = 'Articles manager';

        $articles = $this->a_rep->getAllArticles();

        $articles->transform(function ($item) {
            $item->image = json_decode($item->image);
            return $item;
        });


        $this->content = view('admin.articles.articles-list', compact('articles'))->render();

        return $this->renderOutput();
    }

    public function create(Article $article)
    {
        if (\Gate::denies('create', $article)) {
            echo 'You have no-permission';
            exit();
        }

        $this->title = 'Create article';

        $tags = Tag::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        $this->content = view('admin.articles.form', compact('categories', 'tags'))->render();

        return $this->renderOutput();
    }

    public function store(ArticleRequest $request)
    {

        $result = $this->a_rep->addArticle($request);

        if(is_array($result) && !empty($result['error'])){
            return redirect()->back()->with($result);
        }

        return redirect()->route('admin.articles.index')->with($result);
    }

    public function edit(Article $article)
    {
        $this->title = 'Edit article: '.$article->title;
        $tags = Tag::pluck('name', 'id');
        $categories = Category::pluck('name');
        $article->image = json_decode($article->image);
        $this->content = view('admin.articles.form', compact('categories', 'tags', 'article'))->render();
        return $this->renderOutput();
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->a_rep->updateArticle($request, $article);

        if (is_array($result) && !empty($result['error'])) {
            return redirect()->back()->with($result);
        }

        return redirect()->route('admin.articles.index')->with($result);
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('status', 'Article deleted successfully');
    }

}
