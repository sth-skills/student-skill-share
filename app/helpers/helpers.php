<?php
// Helper functions

function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function formatDate($datetime) {
    return date('d/m/Y H:i', strtotime($datetime));
}
