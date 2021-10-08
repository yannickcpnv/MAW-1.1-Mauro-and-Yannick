<?php

namespace Looper\Models\database\entities;

use DateTime;

class Take extends AbstractEntity
{

    protected const TABLE_NAME = 'takes';

    protected DateTime $timestamp;
    protected array    $answers;
}
