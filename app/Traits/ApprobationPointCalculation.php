<?php

namespace App\Traits;

trait ApprobationPointCalculation
{
    /**
     * Check point condition.
     *
     * @return bool
     */
    public function checkPointCondition()
    {
        return false;
    }

    /**
     * Processed point.
     */
    public function processPoint()
    {
        $this->beforeProcessPoint();

        $status = $this->checkPointCondition();

        $data = $this->handleLogicPoint($status);

        $this->afterProcessPoint($status, $data);
    }

    /**
     * Main process point belongs to a logic.
     */
    protected function handleLogicPoint($checkPointConditionStatus)
    {
        // logic action
    }

    /**
     * Action before processed point.
     */
    protected function beforeProcessPoint()
    {
        // action before process point
    }

    /**
     * Action after processed point.
     */
    protected function afterProcessPoint($status, $data)
    {
        // action after processed point
    }
}
