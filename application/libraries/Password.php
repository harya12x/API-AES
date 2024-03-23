<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/password_compat/password.php';

class Password {
    public function __construct() {}

    public function hash($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verify($password, $hash) {
        return password_verify($password, $hash);
    }
}
