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
 * @version       3.0.1_PE4
 * @author        Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2012, D3 Data Development
 * @see           http://www.shopmodule.com
 *                $Rev::                                               $:
 *                $Author::                                            $:
 *                $Date::                                              $:
 */

namespace D3\Points\Modules\Application\Controller;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Core\Theme;
use OxidEsales\Eshop\Application\Controller\AccountController;
use D3\Points\Application\Model\d3points;

/**
 * Class d3_account_points
 *
 * @package D3\Points\Modules\Application\Controller
 */
class d3_account_points extends d3_account_points_parent
{
    private $_sModId = 'd3points';

    /**
     * @return string
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function render()
    {
        $ret = parent::render();

        //$this->_aViewData['blIsD3PointsActive'] = $this->d3IsD3PointsActive();
        $this->addTplParam('blIsD3PointsActive', $this->d3IsD3PointsActive());
        $this->_aViewData['d3PointsSum']        = $this->getPointsTotalSum();
        $this->addTplParam('d3PointsSum', $this->getPointsTotalSum());

        return $ret;
    }

    /**
     * Ob Modul aktiv ist
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function d3IsD3PointsActive()
    {
        return d3_cfg_mod::get($this->_sModId)->isActive();
    }

    /**
     * Gibt die Summe der aktuellen Bonuspunkte zurück
     *
     * @return integer
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getPointsTotalSum()
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