<?php
/**
 * Created by PhpStorm.
 * User: SVV
 * Date: 31.08.2017
 * Time: 16:34
 */

namespace App\Repositories;


use App\Article;
use Intervention\Image\Facades\Image;

class ArticleRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function getAllArticles()
    {
        return $this->getAll();
    }

    public function getSingleArticle($slug)
    {
        return $this->one($slug);
    }

    public function addArticle($request)
    {
        $data = $request->except('_token', 'image');

        if (empty($data['slug'])) {
            $data['slug'] = $this->transliterate($data['title']);
        }

        if ($this->getSingleArticle($data['slug'])) {
            $request->merge(['slug' => $data['slug']]);
            $request->flash();
            return ['error' => 'This slug is already in use'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $image_name = str_random(12);

                $obj = new \stdClass;
                $obj->path = $image_name . '.jpg';
                $obj->max = $image_name . '_max.jpg';
                $obj->min = $image_name . '_min.jpg';

                $image = \Image::make($image);
                $path = public_path() . '/images/articles/';

                $image->fit(1500, 1000)->save($path . $obj->path);
                $image->fit(800, 600)->save($path . $obj->max);
                $image->fit(200, 150)->save($path . $obj->min);
            }

            $data['image'] = json_encode($obj);
        }

        $this->model->fill($data);

        if ($request->user()->articles()->save($this->model)) {
            $this->model->tags()->attach($data['tag_list']);
            return ['status' => 'Article successfully added'];
        }

    }

    public function updateArticle($request, $article)
    {
        $data = $request->except('_token', '_method', 'image');

        if (empty($data['slug'])) {
            $data['slug'] = $this->transliterate($data['title']);
        }

        $result = $this->getSingleArticle($data['slug']);

        if (isset($result)) {
            if ($result->id != $article->id) {
                $request->merge(['slug' => $data['slug']]);
                $request->flash();
                return ['error' => 'This slug is already in use'];
            }
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $image_name = str_random(12);

                $obj = new \stdClass;
                $obj->path = $image_name . '.jpg';
                $obj->max = $image_name . '_max.jpg';
                $obj->min = $image_name . '_min.jpg';

                $image = \Image::make($image);
                $path = public_path() . '/images/articles/';

                $image->fit(1500, 1000)->save($path . $obj->path);
                $image->fit(800, 600)->save($path . $obj->max);
                $image->fit(200, 150)->save($path . $obj->min);
            }

            $data['image'] = json_encode($obj);
        }

        $article->fill($data);

        if ($article->update()) {
            if(!empty($data['tag_list'])){
                $article->tags()->sync($data['tag_list']);
            }else{
                $article->tags()->detach();
            }

            return ['status' => 'Article successfully updated'];
        }

    }
}