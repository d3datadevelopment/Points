<?php
/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package       "Bonuspunkte"
 * @version       3.0.1_XE4
 * @author        Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see           http://www.shopmodule.com
 *                $Rev::                                               $:
 *                $Author::                                            $:
 *                $Date::                                              $:
 */

namespace D3\Points\Modules\Core;

use OxidEsales\Eshop\Core\Theme;
use D3\Points\Application\Model\d3points;

/**
 * Class d3_oxviewconfig_points
 *
 * @package D3\Points\Modules\Application\Core
 */
class d3_oxviewconfig_points extends d3_oxviewconfig_points_parent
{
    /**
     * Gibt die Summe der aktuellen Bonuspunkte zurück
     *
     * @return int
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3getPointsTotalSum()
    {
        $oUser = $this->getUser();
        if (!$oUser) {
            return 0;
        }

        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);

        return $oD3UserPoints->d3GetTotalSumPoints($oUser->getId());
    }

    /**
     * @return mixed
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3GetParentThemeId()
    {
        /** @var d3_oxtheme_modcfg $oTheme */
        $oTheme = oxNew(Theme::class);
        return $oTheme->d3GetParentThemeId();
    }

}