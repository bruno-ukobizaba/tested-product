<?php

namespace App\Twig;

use App\Entity\User;
use App\Entity\Langue;
use App\Entity\Solution;
use App\Entity\ProduitTeste;

class EasyAdminExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('filter_admin_actions', [
                $this, 'filterActions'
            ])
        ];

    }

    public function filterActions(array $itemActions, $item)
    {
        if($item instanceof ProduitTeste && $item->getIsActive()== true){
            unset($itemActions['delete']);
        }

        return $itemActions;
    }

}