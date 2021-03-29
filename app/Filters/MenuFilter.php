<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        
        if (isset($item['role']) && !auth()->user()->hasRole($item['role'])) {
            $item['restricted'] = true;
        }
        return $item;
    }
}
