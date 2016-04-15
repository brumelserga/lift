<?php
require_once 'autoload.php';


$options = getopt('', array('your_floor::', 'lifts_count::', 'strategy:'));

$yourFloor = new FloorNumber($options['your_floor']);
$liftsQty = new LiftsQty($options['lifts_count']);
$strategyName = new StrategyName($options['strategy']);

$app = new App($liftsQty, $strategyName);
$app->callLift($yourFloor);

/**
 * App
 */
class App {
    
    /**
     *
     * @var Manager
     */
    protected $_manager;


    /**
     *
     * @param LiftsQty $liftsQty
     * @param StrategyName $strategyName
     */
    public function __construct($liftsQty, $strategyName)
    {
        try {
            $strategy = $this->_getStrategy($strategyName);

            $this->_manager = new Manager($strategy);
            for ($i = 1; $i <= $liftsQty->getQty(); $i++) {
                $lift = new Lift(
                    $i,
                    LiftStatus::random(),
                    FloorNumber::random()
                );
                $this->_manager->appendLift($lift);

                echo $this->_getLiftDescription($lift);
            }

        } catch (Exception $e) {
            echo PHP_EOL . $e->getMessage() . PHP_EOL;
            exit;
        }
    }
    
    /**
     * 
     * @param FloorNumber $floor
     */
    public function callLift($floor)
    {
        while (!($lift = $this->_manager->getLift($floor))) {
            $random_lift = $this->_manager->getRandomLift();
            $random_lift->setStatus(LiftStatus::random());
            sleep(1);
            echo '------------------' . PHP_EOL;
            echo 'All lifts are busy' . PHP_EOL;
            echo 'Emulate changing status for random lift' . PHP_EOL;
            echo $this->_getLiftDescription($random_lift);
        }

        /** Lift start moving to floor from which it was called */
        $lift->moveTo($floor);
    }
    
    /**
     * 
     * @param ILift $lift
     * @return string
     * @throws Exception
     */
    private function _getLiftDescription(ILift $lift)
    {
        $status = $lift->getStatus()->getCaption();

        return sprintf('Lift #%s: status - %s, current floor - %s%s',
            $lift->getId(), $status, $lift->getCurrentFloor()->getNumber(), PHP_EOL
        );
    }
    
    /**
     * 
     * @param StrategyName $strategyName
     *
     * @return Strategy_Abstract
     * @throws Exception
     */
    private function _getStrategy($strategyName)
    {
        switch ($strategyName->getName()) {
            case StrategyName::NEAREST:
                $strategy = new Strategy_Nearest();
                break;
            case StrategyName::FREE:
                $strategy = new Strategy_Free();
                break;
            case StrategyName::COMING_OR_FREE_NEAREST:
            default:
                $strategy = new Strategy_ComingOrFreeNearest();
                break;
        }
        return $strategy;
    }
}





