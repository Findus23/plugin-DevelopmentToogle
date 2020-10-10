<?php
/**
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\DevelopmentToogle;

use Piwik\Config;
use Piwik\Menu\MenuTop;
use Piwik\Piwik;


class Menu extends \Piwik\Plugin\Menu
{
    public function configureTopMenu(MenuTop $menu) {
        if (Piwik::hasUserSuperUserAccess()) {
            $enabled = (bool)Config::getInstance()->Development['enabled'];
            if ($enabled) {
                $iconName = "icon-lab";
                $tooltip = "Disable development mode";
            } else {
                $iconName = "icon-user";
                $tooltip = "Enable development mode";
            }
            $additionalParams = ["returnModule" => Piwik::getModule(), "returnAction" => Piwik::getAction(), "devmode" => var_export(!$enabled, true)];
            $menu->registerMenuIcon("Toogle development mode", $iconName);

            $menu->addItem("Toogle development mode", null, $this->urlForDefaultAction($additionalParams), $orderId = 45, $tooltip);
        }
    }

}
