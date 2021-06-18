<?php
namespace App\Helpers;

use Route;
use Request;
 
class Menu {
    public static function active($type, $uri) {
        if($type == 'route') {
            if(is_array($uri)) {
                foreach ($uri as $u) {
                    if (Route::is($u)) {
                        return 'active';
                    }
                }
            }
            if (Route::is($uri)){
                return 'active';
            }
        }
        
        if($type == 'url') {
            if(Request::is($uri)) return 'active';   
        }
    }
}