<?php

namespace Looper\Models\database\entities;

class Exercise extends AbstractEntity
{

    protected const TABLE_NAME = 'exercises';

    private string $title;
    private int    $status;
    private array  $questions;
}
