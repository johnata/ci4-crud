<?php
if ( ! function_exists("getBadge")) {
    function getBadge( $type, $value ) {
        switch ($type) {
            case 1:
            case "primary":
                return "<span class='badge rounded-pill bg-primary'>$value</span>";
            break;

            case 2:
            case "secondary":
                return "<span class='badge rounded-pill bg-secondary'>$value</span>"; 
            break;

            case 3:
            case "success":
                return "<span class='badge rounded-pill bg-success'>$value</span>";
            break;

            case 4:
            case "danger":
                return "<span class='badge rounded-pill bg-danger'>$value</span>";
            break;

            case 5:
            case "warning":
                return "<span class='badge rounded-pill bg-warning text-dark'>$value</span>";
            break;

            case 6:
            case "info":
                return "<span class='badge rounded-pill bg-info text-dark'>$value</span>";
            break;

            case 7:
            case "light":
                return "<span class='badge rounded-pill bg-light text-dark'>$value</span>";
            break;

            case 8:
            case "dark":
                return "<span class='badge rounded-pill bg-dark'>$value</span>";
            break;
            
            default:
                return "<span class='badge rounded-pill bg-primary'>$value</span>";
            break;
        }
    }
}
?>