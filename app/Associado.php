<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Associado extends Model
{
    protected $guarded = [];

    public function desligar()
    {
        $this->update(['desligado' => true]);
    }

    public function religar()
    {
        $this->update(['desligado' => false]);
    }

    public function bloquear()
    {
        $this->update(['bloqueado' => true]);
    }

    public function desbloquear()
    {
        $this->update(['bloqueado' => false]);
    }
}
