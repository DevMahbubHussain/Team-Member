<?php

namespace Orbit\TeamMember;


class Admin
{

    public function __construct()
    {
        new Admin\CPT\CPT();
        new Admin\Metabox\Meta();
        new Admin\Menu();
        // new Assets\Manager();
    }
}
