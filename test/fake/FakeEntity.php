<?php

namespace Looper\Test\fake;

use Looper\Models\database\entities\AbstractEntity;

class FakeEntity extends AbstractEntity
{

    protected const TABLE_NAME = 'users_test';

    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $ip_address;
}
