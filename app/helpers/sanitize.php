<?php
    function sanitize($text){
        return trim(filter_var($text, FILTER_SANITIZE_STRING));
    }
?>