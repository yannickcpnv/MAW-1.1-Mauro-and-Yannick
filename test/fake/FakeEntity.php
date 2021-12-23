<?php

namespace Looper\Test\fake;

use Looper\Models\database\entities\AbstractEntity;

class FakeEntity extends AbstractEntity
{

    protected const TABLE_NAME = 'users_test';

    public string $first_name;
    public string $last_name;
    public string $email;
    public string $ip_address;
}
