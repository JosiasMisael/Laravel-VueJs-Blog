<?php

function setActiveRoute($name){
return request()->routeIs($name)? 'active' : '';
}

function setActiveMenu($name){
    return request()->routeIs($name)? 'menu-open' : '';
    }
