<?php
namespace agoalofalife\postman;

use agoalofalife\postman\Contract\Mode;
use agoalofalife\postman\Modes\Each;
use agoalofalife\postman\Modes\OneToAll;
use Dompdf\Exception;

class FactoryMode
{
    /**
     * @param $mode
     * @return Mode
     * @throws Exception
     * r
     */
    public static function get($mode)
    {
        switch ($mode) {
            case '1':
                return new OneToAll();
            case '2':
                return new Each();
            default:
                throw new Exception("Mode not defined");
        }
    }
}
