<?php
namespace aanimation\bdate\behaviors;

use yii\base\Behavior;
use yii\base\Component;

class EntryQueryBehavior extends Behavior
{
    public mixed $bDate = null;

    public function bDate($bDate): Component
    {
        $this->bDate = $bDate;
        return $this->owner;
    }
}