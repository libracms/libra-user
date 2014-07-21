<?php

namespace LibraUser\Options;

use ZfcUser\Options\ModuleOptions as BaseModuleOptions;

class Module extends BaseModuleOptions
{
    /**
     * @var string
     */
    protected $userEntityClass = 'LibraUser\Entity\User';
}
