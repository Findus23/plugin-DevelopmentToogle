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
                $tooltip = Piwik::translate("DevelopmentToogle_Disable");
            } else {
                $iconName = "icon-user";
                $tooltip = Piwik::translate("DevelopmentToogle_Enable");
            }
            $additionalParams = ["returnModule" => Piwik::getModule(), "returnAction" => Piwik::getAction(), "devmode" => var_export(!$enabled, true)];
            $menu->registerMenuIcon(Piwik::translate("DevelopmentToogle_Toggle"), $iconName);

            $menu->addItem(Piwik::translate("DevelopmentToogle_Toggle"), null, $this->urlForDefaultAction($additionalParams), $orderId = 45, $tooltip);
        }
    }

}
