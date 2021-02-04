<?php

namespace App\Classe;

use App\Entity\Category;
use App\Entity\Domains;

class Search
{
    /**
     * @var $string
     */
    public $string = '';

    /**
     * @var Category[]
     */
    public $categories = [];

    /**
     * @var Domains[]
     */
    public $domaines = [];
}