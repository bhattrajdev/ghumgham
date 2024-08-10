<?php
namespace App\View\Components;

use Illuminate\View\Component;

class GoogleMap extends Component
{
    public $isEditable;
    public $isUpdate;
    public $latitude;
    public $longitude;

    public function __construct($isEditable = false, $isUpdate = false, $latitude = null, $longitude = null)
    {
        $this->isEditable = $isEditable;
        $this->latitude = $latitude;
        $this->longitude = $longitude; 
    }

    public function render()
    {
        return view('components.google-map');
    }
}
