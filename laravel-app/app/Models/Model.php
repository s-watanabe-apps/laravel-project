<?php
namespace App\Models;

use Illuminate\Database\Eloquent;

class Model extends Eloquent\Model
{
    public function bind($values)
    {
        foreach ($values as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }
}