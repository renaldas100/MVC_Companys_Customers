<?php

namespace helper;

class SuperAdmin extends Admin
{
    public function getNav()
    {
        $nav= parent::getNav();
        $nav['Vartotojai(SuperAdmin meniu)']='index.php';
        return $nav;
    }


}