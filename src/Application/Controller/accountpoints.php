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

namespace D3\Points\Application\Controller;

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\Points\Application\Model\d3points;
use OxidEsales\Eshop\Application\Controller\AccountController;
use OxidEsales\Eshop\Application\Model\User;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Application\Model\ArticleList;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\utils_points;
use OxidEsales\Eshop\Core\Exception\StandardException;

/**
 * Class accountpoints
 *
 * @package D3\Points\Application\Controller
 */
class accountpoints extends AccountController
{

    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = '';
    protected $_sTemplatePoints = 'd3_account_points.tpl';

    protected $_sModId = 'd3points';
    protected $_aOrderList = array();
    protected $_aArticlesList = NULL;
    protected $_oCreatedVoucher = NULL;

     /**
     * @return string
     */
    public function render()
    {
        parent::render();

        // is logged in ?
        $oUser = $this->getUser();
        if (!$oUser) {
            return $this->_sThisTemplate = $this->_sThisLoginTemplate;
        }

        return $this->_sTemplatePoints;
    }

    /**
     * @param string $sTheme
     *
     * @return null|object
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3GetAllPoints($sTheme = 'azure')
    {
        $oUser = $this->getUser();
        if (!$oUser) {
            return null;
        }

        $soxId = $oUser->getId();

        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);
        $oTmpPointsList =  $oD3UserPoints->d3GetAllPoints($soxId);
        $oTmpPointsList = $oTmpPointsList->aList;

        $aFiles = $this->getTemplatesForPointsList($sTheme);
        #dumpvar($aFiles);
        $oPointsList = array();
        #while($oTmpPointsList->EOF)
        foreach($oTmpPointsList as $sKey => $oPoints)
        {
            /** @var  d3points $oPoints */
            $sTmpType = "d3points_list_type_".$sTheme."_".$oPoints->d3points__oxtype->rawValue.".tpl";
            $sTmpTypeOther = "d3points_list_type_".$sTheme."_other.tpl";

            $sField = $sTmpTypeOther;

            if(array_key_exists($sTmpType,$aFiles))
            {
                $sField = $sTmpType;
            }
            $oPoints->assign(
                array('d3template' => $sField)
            );


            $oPointsList[$sKey] = $oPoints;
        }
        #dumpvar($oTmpPointsList);
        #echo "<hr>";
        //dumpvar($oPointsList);
        //die();
        return $oTmpPointsList;
    }

    /**
     * Gibt die Summe der aktuellen Bonuspunkte zurück
     *
     * @return int
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetPointsTotalSum()
    {
        $oUser = $this->getUser();
        if (!$oUser) {
            return 0;
        }

        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);
        return $oD3UserPoints->d3GetPointsTotalSum($oUser->getId());
    }

    /**
     * Gibt zurück, ob mit der aktuellen Zahl an Bonuspunkten eine Auszahlung möglich ist
     * Erst möglich wenn Punktezahl größer als 0 ist
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetAllowCreateVoucher()
    {
        $oUser = $this->getUser();
        if (!$oUser) {
            return false;
        }

        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);
        return $oD3UserPoints->d3GetAllowCreateManuelVoucher($oUser);

        #return ($this->d3getPointsTotalSum() >= $oD3UserPoints->d3getVoucherAvailable) && ($this->d3getPointsTotalSum() > 0);
    }

    /**
     * Gibt die Höhe des Gutschein zurück, der für den aktuellen Bonuspunktebetrag ausgezahlt werden kann.
     *
     * @return float
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3CollectVoucherAmount()
    {
        $oUser = $this->getUser();
        if (!$oUser) {
            return 0;
        }

        /* @var $od3Points d3points */
        $od3Points = oxnew(d3points::class);
        return $od3Points->d3GetVoucherAmount($oUser);
    }

    /**
     * Gibt die Höhe des Gutschein zurück, der für den aktuellen Bonuspunktebetrag ausgezahlt werden kann.
     * in der von Benutzer gewählten Währung
     * Eventuell nicht mehr gebraucht?
     * 2011_06_23
     *
     * @return float
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3getVoucherAmount()
    {
        $oCur = Registry::get(Config::class)->getActShopCurrencyObject();
        $dPrice = utils_points::d3_d3pointsUtils_GetUserPrice($this->d3CollectVoucherAmount());
        return Registry::getLang()->formatCurrency($dPrice, $oCur);
    }

    /**
     * Gibt den Mindestpunktestand zurück, ab dem ein Gutschein erstellt werden kann.
     * wird vom Template aufgerufen
     *
     * @return integer
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3getVoucherAvailable()
    {
        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);
        #return $oD3UserPoints->d3getVoucherAvailable();
        return $oD3UserPoints->d3GetManuelVoucherPayoutPoints();
    }

    /**
     * Template variable getter. Returns orders
     *
     * @return object
     */
    public function getOrderList()
    {
        if ($this->_aOrderList === null) {
            $this->_aOrderList = false;

            // Load user Orderlist
            $oUser = $this->getUser();
            if ($oUser) {
                $this->_aOrderList = $oUser->getOrders();
            }
        }
        return $this->_aOrderList;
    }

    /**
     * Template variable getter. Returns ordered articles
     *
     * @return Articlelist | false
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function getOrderArticleList()
    {
        if ($this->_aArticlesList === null) {

            // marking as set
            $this->_aArticlesList = false;
            $oOrdersList = $this->getOrderList();
            if ($oOrdersList && $oOrdersList->count()) {
                /* @var $oOrdersList Articlelist */
                $this->_aArticlesList = oxNew(ArticleList::class);
                $this->_aArticlesList->loadOrderArticles($oOrdersList);
            }
        }

        return $this->_aArticlesList;
    }

    /**
     * Prüft, ob gerade ein Gutschein erstellt wurde.
     *
     * @return bool
     */
    public function getCreatedVoucher()
    {
        return $this->_oCreatedVoucher;
    }

    /**
     * @param User $oUser
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3CanCreateVoucherFromPoints(User $oUser)
    {
        if (!$oUser) {
            //return false;
            $sMessage = 'No User given';
            throw oxNew(StandardException::class, $sMessage);
        }

        //Jetzt nochmal prüfen, ob wir wirklich einen Gutschein erstellen dürfen
        if (!$this->d3getAllowCreateVoucher()) {
            //return false;
            $sMessage = 'Not allowed to create a Voucher';
            throw oxNew(StandardException::class, $sMessage);
        }
        return true;
    }

    /**
     * Create Voucher, called from Template/Form
     * send Mail, write Remark
     *
     * @return void
     * @throws DatabaseConnectionException
     * @throws StandardException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     * @throws d3_cfg_mod_exception
     */
    public function d3CreateVoucherFromPoints()
    {
        $oUser = $this->getUser();
        if($this->d3CanCreateVoucherFromPoints($oUser))
        {
            /* @var $od3Points d3points */
            $od3Points              = oxnew(d3points::class);
            $this->_oCreatedVoucher = $od3Points->d3CreateVoucherFromPointsByUser($oUser->getId());
        }
    }

    /**
     * Write Options for reciving mails for users
     * save Option in oxuser in field d3pointsmailoption as decimal
     * convert values from bin to decimal
     * 0 = Bonuspunkte für Bestellungen
     * 1 = Bonuspunkte für Artikelbewertungen
     * 2 = Erinnerungsmail für vorhandene Bonuspunkte
     *
     * @return void
     * @throws DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3SetMailOptions()
    {
        $oUser = $this->getUser();
        if ($oUser) {
            /* @var $od3Points d3points */
            $od3Points = oxnew(d3points::class);
            $od3Points->setMailOptions($oUser->getId(), Registry::get(Request::class)->getRequestEscapedParameter("d3PointsMailStatus"));
        }
    }

    /**
     * Get value for given Position for rights management
     * Ckeck some Options
     * $iBit = 0, 1,2,3 , ..
     *
     * @param integer $iBit
     *
     * @return bool
     * @throws DatabaseConnectionException
     */
    public function d3GetSelectedOption(int $iBit)
    {
        $oUser = $this->getUser();
        if ($oUser->isLoaded()) {
            /* @var $od3Points d3points */
            $od3Points = oxnew(d3points::class);

            return $od3Points->d3GetSelectedOption($oUser->getId(), $iBit);
        }
        return false;
    }

    /**
     * Get Active for Modul
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3IsD3PointsActive()
    {
        return $this->getModCfg()->isActive();
        #return d3_d3points_utils::d3IsD3PointsActive();
    }

    /**
     * Returns Bread Crumb - you are here page1/page2/page3...
     *
     * @return array
     */
    public function getBreadCrumb()
    {
        $aPaths = array();
        $aPath = array();

        $iBaseLanguage = Registry::getLang()->getBaseLanguage();
        $sSelfLink = $this->getViewConfig()->getSelfLink();

        $aPath['title'] = Registry::getLang()->translateString('MY_ACCOUNT', $iBaseLanguage, false);
        $aPath['link'] = Registry::get("oxSeoEncoder")->getStaticUrl($sSelfLink . 'cl=account');
        $aPaths[] = $aPath;

        $aPath['title'] = Registry::getLang()->translateString('D3_INC_ACCOUNT_HEADER_POINT', Registry::getLang()->getBaseLanguage(), false);
        $aPath['link'] = $this->getLink();
        $aPaths[] = $aPath;

        return $aPaths;
    }

    /**
     * @return object
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getModCfg()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @param string $sTheme
     *
     * @return array
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function getTemplatesForPointsList(string $sTheme = 'azure')
    {
        /** @var  Module $oModul */
        $oModule = oxNew(Module::class);
        $oModule->load('d3points');
        $aTmpTemplates = $oModule->getInfo('templates');
        $aTemplates = array();

        foreach ($aTmpTemplates as $sTemplate => $sPathToFile)
        {
            if(substr_count($sTemplate,'d3points_list_type_'.$sTheme.'_'))
            {
                $aTemplates[$sTemplate] = $sPathToFile;
            }
        }
        return $aTemplates;
    }
}
