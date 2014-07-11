<?php

namespace My;

use BCC\ResqueBundle\Job;

class Build extends Job
{
    public function run($args)
    {
        \file_put_contents($args['file'], $args['content']);
    }
}
