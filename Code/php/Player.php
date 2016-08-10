<?php
class Player {
    public $id;
    public $name;
    public $attack;
    public $defense;
    public $stamina;

    public function __construct($pName, $pAttack, $pDefense, $pStamina, $pId)
    {
        $this->name = $pName;
        $this->attack = $pAttack;
        $this->defense = $pDefense;
        $this->stamina = $pStamina;
        $this->id = $pId;
    }
}
?>