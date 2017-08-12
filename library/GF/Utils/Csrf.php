<?php
/**
 * Created by PhpStorm.
 * User: Igor Klekotnev
 * Date: 06.08.17
 * Time: 15:18
 */

namespace GF\Utils;


class Csrf
{
    public function get_token_id()
    {
        if(isset($_SESSION['token_id'])) {
            return $_SESSION['token_id'];
        } else {
            $token_id = $this->random(10);
            $_SESSION['token_id'] = $token_id;
            return $token_id;
        }
    }

    public function get_token() {
        if(isset($_SESSION['token_value'])) {
            return $_SESSION['token_value'];
        } else {
            $token = hash('sha256', $this->random(500));
            $_SESSION['token_value'] = $token;
            return $token;
        }

    }

    public function check_valid($method) {
        if($method == 'post' || $method == 'get') {
            $post = $_POST;
            $get = $_GET;
            if(isset(${$method}[$this->get_token_id()]) && (${$method}[$this->get_token_id()] == $this->get_token())) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function form_names($names, $regenerate) {

        $values = array();
        foreach ($names as $n) {
            if($regenerate == true) {
                unset($_SESSION[$n]);
            }
            $s = isset($_SESSION[$n]) ? $_SESSION[$n] : $this->random(10);
            $_SESSION[$n] = $s;
            $values[$n] = $s;
        }
        return $values;
    }

    private function random($len) {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $byteLen = intval(($len / 2) + 1);
            $return = substr(bin2hex(openssl_random_pseudo_bytes($byteLen)), 0, $len);
        } elseif (@is_readable('/dev/urandom')) {
            $f=fopen('/dev/urandom', 'r');
            $urandom=fread($f, $len);
            fclose($f);
            $return = '';
        }

        if (empty($return)) {
            for ($i=0;$i<$len;++$i) {
                if (!isset($urandom)) {
                    if ($i%2==0) {
                        mt_srand(time()%2147 * 1000000 + (double)microtime() * 1000000);
                    }
                    $rand=48+mt_rand()%64;
                } else {
                    $rand=48+ord($urandom[$i])%64;
                }

                if ($rand>57)
                    $rand+=7;
                if ($rand>90)
                    $rand+=6;

                if ($rand==123) $rand=52;
                if ($rand==124) $rand=53;
                $return.=chr($rand);
            }
        }

        return $return;
    }
}