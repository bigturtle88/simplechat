<?php
class Security {
    public $data;
    public function __construct() {
    }
    public function filter($data) {
        if (isset($data)) {
            $data = addslashes($data);
            $data = substr($data, 0, 40);
            return $data;
        }
        return NULL;
    }
    public function filter_session($data) {
        if (is_array($data)) {
            if (isset($data['id']) and isset($data['key'])) {
                $data['id'] = addslashes($data['id']);
                $data['key'] = addslashes($data['key']);
                return $data;
            }
            return NULL;
        }
        return NULL;
    }
}
?> 
