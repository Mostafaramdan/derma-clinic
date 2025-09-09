<?php

if (! function_exists('is_active_menu')) {
    function is_active_menu(array $patterns): bool {
        foreach ($patterns as $p) {
            if (request()->routeIs($p)) return true;
        }
        return false;
    }
}
