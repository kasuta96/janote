<?php
namespace App\Classes;

class Hashtag {
    // public function __construct()
    // {
    //     return true;
    // }

    public function getTagArray($str)
    {
      return 'Output OK!';
      if ($str) {
        $output = [];
        $arr = explode(',',$str);
        foreach ($arr as $val) {
          $name = config('hashtag.'.$val);
          $output[$val] = $name;
        }
        return $output;
      }
      else {
        return false;
      }
    }
}