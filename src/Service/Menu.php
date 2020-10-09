<?php
namespace App\Service;

class Menu {
    
    public function getItems() {
	return array(
            array('path' =>'home_page', 'label' =>'Home Page'),
            array('path' =>'main_page', 'label' =>'Main Page'),
            array('path' =>'search_location', 'label' =>'Location Search Page')    
        );
    }
}
