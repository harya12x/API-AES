<?php
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\Stemmer\StemmerInterface;

// Fungsi untuk membuat stemmer
function create_stemmer(): StemmerInterface {
    $stemmerFactory = new StemmerFactory();
    return $stemmerFactory->createStemmer();
}

if (!function_exists('stem_text')) {
    function stem_text($text) {
        $stemmer = create_stemmer();
        return $stemmer->stem($text);
    }
}
