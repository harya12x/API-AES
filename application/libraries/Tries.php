<?php

namespace MyLibraries;

// application/libraries/Trie.php
class TrieNode {
	public $children = [];
    public $isEndOfWord = false;
}

class Trie {
	private $root;

    public function __construct() {
        $this->root = new TrieNode();
    }

    public function insert($word) {
        $node = $this->root;
        $len = strlen($word);

        for ($i = 0; $i < $len; $i++) {
            $char = $word[$i];

            if (!isset($node->children[$char])) {
                $node->children[$char] = new TrieNode();
            }

            $node = $node->children[$char];
        }

        $node->isEndOfWord = true;
    }

    public function search($word) {
        $node = $this->root;
        $len = strlen($word);

        for ($i = 0; $i < $len; $i++) {
            $char = $word[$i];

            if (!isset($node->children[$char])) {
                return false;
            }

            $node = $node->children[$char];
        }

        return $node->isEndOfWord;
    }
}
