<?php
$manager = new Manager();

$manager->setLift(new Lift(Lift::STATUS_FREE, 1));
$manager->setLift(new Lift(Lift::STATUS_MOVING_UP, 3));

$floor = 3;

/** get lift by floor */ 
$lift = $manager->getOptimalLift($floor);

/** Lift start moving to floor from whitch it was called */
$lift->moveTo($floor);