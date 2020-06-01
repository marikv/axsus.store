<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    private static $data = [];
    /**
     * @param $name
     * @return string
     */
    public static function getValue($name) :string
    {
        if (isset(self::$data[$name])) {
            return self::$data[$name];
        }
        $v = self::where('name', $name)->first();
        $value = '';
        if ($v) {
            $value = htmlspecialchars_decode((string)$v->value);
        }

        self::$data[$name] = $value;
        return self::$data[$name];
    }
}
