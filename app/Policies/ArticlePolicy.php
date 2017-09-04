<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        return $user->canDo('SHOW_INDEX_ARTICLES');
    }

    public function create(User $user)
    {
        return $user->canDo('SHOW_CREATE_ARTICLE');
    }

    public function store(User $user)
    {
        return $user->canDo('STORE_ARTICLE');
    }
}
