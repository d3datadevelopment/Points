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
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\d3points;

/**
 * Class d3_d3points_maintenance
 *
 * @package d3\points\Application\Controller\Admin
 */
class maintenance extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3points_maintenance.tpl';
    /**
     * @var string
     */
    protected $_sModId = 'd3points';
    protected $_hasLicence = false;
    protected $_hasNewsletterForm = false;
    protected $_modUseCurl = false;
    protected $_sMenuItemTitle = 'd3mxd3points';
    protected $_sMenuSubItemTitle = 'd3mxd3points_MAINTENANCE';
    protected $_sHelpLinkMLAdd = 'D3_CFG_MOD_d3points_HELPLINK_MAINTAINCE';

    /**
     *
     */
    /*
    public function __construct()
    {
        parent::__construct();

        $this->_oSet = d3_cfg_mod::get($this->_sModId);
    }
    */

    /**
     * Set Status on Order
     * set field d3issetpoints
     * can set to 0 or 1
     * 0 = order is not processed by cronjob
     * 1 = order is processed by cronjob
     *
     * @return void
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3SetOxorderd3IssetPoints()
    {
        $iStatus    = Registry::get(Request::class)->getRequestEscapedParameter('d3PointsOrderStatus');
        $blStatus   = Registry::get(Request::class)->getRequestEscapedParameter('d3PointsOrderConfirm');

        $myUtilsView = Registry::getUtilsView();
        $oLang = Registry::getLang();

        if ($blStatus == true) {
            if ($iStatus == '-')
                $myUtilsView->addErrorToDisplay(
                $oLang->translateString('D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_NOT_STATUS')
                );
            else {
                /** @var $oOrder d3_oxorder_d3points **/
                $oOrder = oxNew(Order::class);
                if ($oOrder->d3ResetOrders($iStatus, $blStatus))
                    $myUtilsView->addErrorToDisplay(
                        sprintf($oLang->translateString('D3_CFG_MOD_d3points_MAINTAINCE_RESET_SUCCESS'),
                            $oOrder->iD3UpdatedOrders)
                    );
            }
        } else {
            $myUtilsView->addErrorToDisplay(
                $oLang->translateString('D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_NOT'
                )
            );
        }
    }

    /**
     * Delete/Storno Points from Order
     * call d3DeleteOrder()
     *
     * @return void
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function d3DeleteOrderPoints()
    {
        $sOrderNr           = Registry::get(Request::class)->getRequestEscapedParameter('d3PointsOrderNr');
        $blOrderConfirm     = Registry::get(Request::class)->getRequestEscapedParameter('d3PointsOrderConfirm');
        $sOrderType         = Registry::get(Request::class)->getRequestEscapedParameter('d3PointsOrderType');
        $sOrderComment      = Registry::get(Request::class)->getRequestEscapedParameter('d3PointsOrderComment');
        $blSendMail         = Registry::get(Request::class)->getRequestEscapedParameter('d3SendMail');

        $myUtilsView = Registry::getUtilsView();
        $oLang = Registry::getLang();
        $ret = '';

        if ($sOrderType) {
            if ($blOrderConfirm == true) {
                /** @var $od3Points d3points **/
                $od3Points = oxNew(d3points::class);
                $ret = $od3Points->d3DeleteOrderPoints($sOrderNr, $blOrderConfirm, $sOrderType, $sOrderComment, $blSendMail);
                if ($ret) {
                    $sReturnMessage = sprintf($oLang->translateString($ret), $sOrderNr);
                    $myUtilsView->addErrorToDisplay($sReturnMessage);
                }
            } else
                $myUtilsView->addErrorToDisplay($oLang->translateString('D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_CONFIRM_NOT'));
        } else {
            $myUtilsView->addErrorToDisplay($oLang->translateString('D3_CFG_MOD_d3points_MAINTAINCE_RESET_ORDERS_TYP_ERROR'));
        }
    }

}
