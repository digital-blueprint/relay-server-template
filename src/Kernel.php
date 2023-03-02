<?php

declare(strict_types=1);

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

// XXX: some of our bundles depend on UTC being the timezone, so set it early
date_default_timezone_set('UTC');

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
