<?php

/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 *
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package "Bonuspunkte"
 * @author Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see http://www.shopmodule.com
 */

namespace D3\Points\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\d3points;

/**
 * Class demo
 *
 * @package D3\Points\Application\Controller\Admin
 */
class demo extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3points_demo.tpl';
    protected $_sModId = 'd3points';
    protected $_hasLicence = false;
    protected $_modUseCurl = false;
    protected $_sMenuItemTitle = 'd3mxd3points';
    protected $_sMenuSubItemTitle = 'd3mxd3points_DEMO';
    protected $_sHelpLinkMLAdd = 'D3_CFG_MOD_d3points_HELPLINK_DEMO';

    /**
     * @return string
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        $ret = parent::render();
        #echo __LINE__;
        #dumpvar($this->oSet->oValue);

        $this->addTplParam("sRate4Points",$this->d3GetRate4Points());
        $this->addTplParam("aRate4Points", $this->d3GetRateArray4Points());
        $this->addTplParam("sRate4Voucher", $this->d3GetRate4Voucher());

        return $ret;
    }

    /**
     * Return Rate to calculate points by price
     *
     * @return integer
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetRate4Points()
    {
        /* @var $od3points d3points */
        $od3points = oxnew(d3points::class);
        return $od3points->d3GetRateLinear2CalculatePoints();
    }

    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetRateArray4Points()
    {
        /* @var $od3points d3points */
        $od3points = oxnew(d3points::class);
        return $od3points->d3GetRateScalar2CalculatePoints();
        #return $od3points->d3GetRateScalar2CalculatePoints();
    }

    /**
     * Calculate Points and asign value to smarty
     *
     * assign results ti templates
     * -CALCULATEDPOINTS
     * -PRICE2POINTS
     *
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function calculatePoints()
    {
        $aPoints = Registry::get(Request::class)->getRequestEscapedParameter('DEMOSYSTEM');
        $dPoints = (float)$aPoints['PRICE2POINTS'];

        /* @var d3points d3points */
        $od3points = oxnew(d3points::class);

        /** @var d3_oxorder_d3points $oOrder */
        $oOrder = oxNew(Order::class);

        $this->addTplParam("CALCULATEDPOINTS", $od3points->d3CalculatePoints($oOrder, $dPoints, false));
        $this->addTplParam("PRICE2POINTS", $dPoints);
    }

    /**
     * Rerurn Rate for Voucher
     * to calculate points to voucher
     *
     * @return double
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetRate4Voucher()
    {
        /* @var $od3points d3points */
        $od3points = oxnew(d3points::class);
        return $od3points->d3GetRate4Voucher();
    }

    /**
     * Calculate Voucher
     * assign resdults to template
     * -CALCULATEDVOUCHER
     * -POINTS2VOUCHER
     *
     * @return void
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function calculateVoucher()
    {
        $aPoints = Registry::get(Request::class)->getRequestEscapedParameter('DEMOSYSTEM');
        $dPoints = $aPoints['POINTS2VOUCHER'];

        /* @var $od3points d3points */
        $od3points = oxnew(d3points::class);

        $this->addTplParam("CALCULATEDVOUCHER", $od3points->d3CalculateVoucherAmount($dPoints));
        $this->addTplParam("POINTS2VOUCHER", $dPoints);
    }

}