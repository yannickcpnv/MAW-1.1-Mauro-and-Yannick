<?php

namespace Looper\Models\traits;

trait Arrayable
{

    final public function toArray(): array
    {
        return get_object_vars($this);
    }
}
