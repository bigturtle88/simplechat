<?php
class Validation {
    public $data = array();
    public function __construct() {
    }
    public function validate($login, $userpass, $repeatPass) {
        try {
            if ($this->notisset($login, $userpass, $repeatPass) == true) {
                $this->validLogin($login);
                $this->validPass($userpass);
                $this->validTwoPass($userpass, $repeatPass);
            } else {
                $data['result'] = false;
                return $data;
            }
        }
        catch(Exception $error) {
            $data['error'] = $error->getMessage();
            $data['result'] = false;
            return $data;
        }
        $data['result'] = true;
        return $data;
    }
    public function validateEditPass($userpass, $newPass, $repeatNewPass, $ispass) {
        try {
            if ($this->notisset($userpass, $newPass, $repeatNewPass) == true and isset($ispass)) {
                $this->ispass($ispass);
                $this->validTwoPass($newPass, $repeatNewPass);
                $this->validPass($newPass);
            } else {
                $data['result'] = false;
                return $data;
            }
        }
        catch(Exception $error) {
            $data['error'] = $error->getMessage();
            $data['result'] = false;
            return $data;
        }
        $data['result'] = true;
        return $data;
    }
    private function notisset($login, $userpass, $repeatPass) {
        if (isset($login) or isset($userpass) or isset($repeatPass)) {
            return true;
        }
        return false;
    }
    private function ispass($ispass) {
        if ($ispass == false) {
            $error = NOT_THE_CORRECT_PASSWORD;
            throw new Exception($error);
        }
    }
    private function validLogin($login) {
        if (2 > strlen($login) or strlen($login) > 22) {
            $error = ERROR_LOGIN;
            throw new Exception($error);
        }
    }
    private function validPass($userpass) {
        if (7 > strlen($userpass) or strlen($userpass) > 19) {
            $error = NOT_CORRECT_NEW_PASSWORD;
            throw new Exception($error);
        }
    }
    private function validTwoPass($userpass, $repeatPass) {
        if ($userpass != $repeatPass) {
            $error = THE_PASSWORDS_DO_NOT_MATCH;
            throw new Exception($error);
        }
    }
}
?> 
