<?php
/**
 * Created by PhpStorm.
 * User: SVV
 * Date: 31.08.2017
 * Time: 14:59
 */

namespace App\Repositories;


abstract class Repository
{
    protected $model;

    protected function getAll($select = "*")
    {
        $builder = $this->model->select($select);

        return $builder->get();
    }

    protected function one($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function transliterate($string)
    {
        $str = mb_strtolower($string, 'UTF-8');

        $leters = [
            'a' => 'а',
            'b' => 'б',
            'v' => 'в',
            'g' => 'г,ґ',
            'd' => 'д',
            'e' => 'е,є,э',
            'jo' => 'ё',
            'zh' => 'ж',
            'z' => 'з',
            'i' => 'и,і',
            'ji' => 'ї',
            'j' => 'й',
            'k' => 'к',
            'l' => 'л',
            'm' => 'м',
            'n' => 'н',
            'o' => 'о',
            'p' => 'п',
            'r' => 'р',
            's' => 'с',
            't' => 'т',
            'u' => 'у',
            'f' => 'ф',
            'kh' => 'х',
            'ts' => 'ц',
            'ch' => 'ч',
            'sh' => 'ш',
            'shch' => 'щ',
            '' => 'ъ',
            'y' => 'ы',
            '' => 'ь',
            'yu' => 'ю',
            'ya' => 'я',
        ];

        foreach ($leters as $latin=>$cyrillic) {
            $cyrillic = explode(',', $cyrillic);
            $str = str_replace($cyrillic, $latin, $str);
        }

        $str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);

        $str = trim($str, '-');

        return $str;
    }
}