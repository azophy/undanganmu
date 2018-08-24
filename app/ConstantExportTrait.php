<?php
namespace App;

Trait ConstantExportTrait
{
    static $constant_list_=null;
    /**
     * @return [const_name => 'value', ...]
     */
    static function listConstants($prefix = ''){
        if (self::$constant_list_ == null) {
            $refl = new \ReflectionClass(__CLASS__);
            $constants = $refl->getConstants();
            $res = [];
            $len = strlen($prefix);
            foreach ($constants as $key => $val)
                if (substr($key, 0, $len) == $prefix)
                    $res[$val] = substr($key, $len);
            static::$constant_list_ = $res;
        }
        return static::$constant_list_;
    }

    /**
     * @return [const_name => 'value', ...]
     */
    static function listConstantRev($prefix = ''){
        return array_flip(static::listConstants($prefix));
    }
}
