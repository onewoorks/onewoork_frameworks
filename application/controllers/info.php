<?php

class info_controller {

    public function main(array $getVars) {
        switch ($_REQUEST['method']):
            case 'pelajar':
                include_once 'application/controllers/ajax/pelajar.php';
                break;
            case 'kaunseling':
                include_once 'application/controllers/ajax/kaunseling.php';
                break;
        endswitch;
    }

}

?>