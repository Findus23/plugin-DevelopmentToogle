<?php
/**
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevelopmentToogle;

use Piwik\Config;
use Piwik\Piwik;

class Controller extends \Piwik\Plugin\Controller
{
    public function index() {
        $request = \Piwik\Request::fromRequest();
        Piwik::checkUserHasSuperUserAccess();
        $devmode = $request->getStringParameter("devmode") == "true";
        Config::getInstance()->Development['enabled'] = $devmode;
        Config::getInstance()->Development['disable_merged_assets'] = $devmode;
        Config::getInstance()->forceSave();
        $returnModule = $request->getStringParameter("returnModule");
        $returnAction = $request->getStringParameter("returnAction");
        $this->redirectToIndex($returnModule, $returnAction);
    }
}
