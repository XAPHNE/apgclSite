<?php

if (!function_exists('customWordWrap')) {
    function customWordWrap($text, $width = 30, $break = '<wbr>') {
        $output = '';
        while (strlen($text) > $width) {
            $chunk = substr($text, 0, $width);
            $breakPos = max(strrpos($chunk, '/'), strrpos($chunk, ')'));

            if ($breakPos !== false) {
                $output .= substr($text, 0, $breakPos + 1) . $break;
                $text = substr($text, $breakPos + 1);
            } else {
                $output .= substr($text, 0, $width) . $break;
                $text = substr($text, $width);
            }
        }
        $output .= $text;
        return $output;
    }
}