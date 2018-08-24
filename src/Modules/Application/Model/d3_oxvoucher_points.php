<?php
/**
 * This Software is the property of D� Data Development
 * and is protected by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package       "Bonuspunkte"
 * @author        Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus G�rtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see           http://www.shopmodule.com
 */

namespace D3\Points\Modules\Application\Model;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Application\Model\Voucher;
use OxidEsales\Eshop\Application\Model\VoucherSerie;
use OxidEsales\Eshop\Core\Exception\VoucherException;
use OxidEsales\Eshop\Core\Exception\oxObjectException;
use OxidEsales\Eshop\Core\Exception\oxVoucherException;
use D3\Points\Application\Model\d3points;

/**
 * Class d3_oxvoucher_points
 */
class d3_oxvoucher_points extends d3_oxvoucher_points_parent
{

    /**
     * @var string Name of current class
     */
    protected $_sClassName = 'oxvoucher';

    /**
     * Returns the discount value used.
     *
     * @param double $dPrice price to calculate discount on it
     *
     * @return double
     * @throws VoucherException
     * @throws \oxObjectException
     * @throws \oxVoucherException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function getDiscountValue($dPrice)
    {
        /** @var Voucher $oSeries */
        $oSeries = $this->getSerie();

        if ($oSeries->getId() != $this->d3GetVoucherSeriesId()) {
            return parent::getDiscountValue($dPrice);
        }

        if ($oSeries->getFieldData('oxdiscounttype') == 'absolute') {
            $oCur      = $this->getConfig()->getActShopCurrencyObject();
            $dDiscount = $this->getFieldData('oxdiscount') * $oCur->rate;
        } else {
            $dDiscount = $this->getFieldData('oxdiscount') / 100 * $dPrice;
        }

        if ($dDiscount > $dPrice) {
            /* @var $oEx VoucherException */
            $oEx = oxNew(VoucherException::class, 'ERROR_MESSAGE_VOUCHER_INCORRECTPRICE');
            $oEx->setVoucherNr($this->getFieldData('oxvoucherNr'));
            throw $oEx;
        }

        return $dDiscount;
    }

    /**
     * Gibt die oxid der Gutscheinserien zurueck
     *
     * @return string
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3GetVoucherSeriesId()
    {
        /* @var $od3_d3points_d3points d3points */
        $od3_d3points_d3points = oxnew(d3points::class);
        return $od3_d3points_d3points->d3GetVoucherSeriesId();
    }

}
