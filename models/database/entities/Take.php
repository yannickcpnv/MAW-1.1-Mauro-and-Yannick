<?php

namespace Looper\Models\database\entities;

use DateTime;

class Take extends AbstractEntity
{

    protected const TABLE_NAME = 'takes';

    private DateTime $timestamp;
    private array    $answers;
}
