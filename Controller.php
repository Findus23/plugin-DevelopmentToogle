<?php
/**
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevelopmentToogle;

use Piwik\Common;
use Piwik\Config;
use Piwik\Piwik;

class Controller extends \Piwik\Plugin\Controller
{
    public function index() {
        Piwik::checkUserHasSuperUserAccess();
        $devmode = Common::getRequestVar("devmode") == "true";
        Config::getInstance()->Development['enabled'] = $devmode;
        Config::getInstance()->Development['disable_merged_assets'] = $devmode;
        Config::getInstance()->forceSave();
        $returnModule = Common::getRequestVar("returnModule");
        $returnAction = Common::getRequestVar("returnAction");
        $this->redirectToIndex($returnModule, $returnAction);
    }
}
