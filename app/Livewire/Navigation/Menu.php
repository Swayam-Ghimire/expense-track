<?php

namespace App\Livewire\Navigation;

use Livewire\Component;

class Menu extends Component
{
    public $showMobileMenu = false;

    public function toggleMenu()
    {
        $this->showMobileMenu = !$this->showMobileMenu;
    }
    
    public function render()
    {
        return view('livewire.navigation.menu');
    }
}
