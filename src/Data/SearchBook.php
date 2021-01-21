<?php

namespace App\Data;

class SearchBook
{
    /**
     * @var string
     */
    public $title = '';

    /**
     * @var int
     */
    public $date = null;

    /**
     * @var string
     */
    public $author = '';

    /**
     * @var string
     */
    public $authorBirthDate = '';

    /**
     * @var $category[]
     */
    public $category = [];
}
