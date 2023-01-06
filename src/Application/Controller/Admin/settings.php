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
 *
 */

namespace D3\Points\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\utils_points;
use OxidEsales\Eshop\Core\Registry;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Filegenerator\d3filegeneratorcronsh;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\ViewConfig;
use D3\Points\Application\Model\d3points;


class settings extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3points_settings.tpl';
    protected $_sModId = 'd3points';
    protected $_sMenuItemTitle = 'd3mxd3points';
    protected $_sMenuSubItemTitle = 'd3mxd3points_SETTINGS';
    protected $_sHelpLinkMLAdd = 'D3POINTS_HELPLINK_CONFIG';
    protected $_blHasDebugSwitch = TRUE;
    protected $_blHasTestModeSwitch = TRUE;

    protected $_sDebugHelpTextIdent = 'D3_CFG_d3points_DEBUG_MODUS_HELP';
    protected $_sTestModeHelpTextIdent = 'D3_CFG_d3points_TEST_MODUS_HELP';

    /**
     * @return string
     * @throws DatabaseConnectionException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        $ret = parent::render();
        #echo __LINE__;
        #dumpvar($this->d3GetSet()->oValue);

        return $ret;
    }

    /**
     * Add some arrays to config
     * transform SELECTIONGROUPS[SELECTION_GROUPS_4_POINTS][] to "d3points_SELECTION_GROUPS_4_POINTS" and save it under "d3_cfg_mod__d3points_SELECTION_GROUPS_4_POINTS"
     *
     * @return void
     * @throws DatabaseConnectionException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function save()
    {
        parent::save();
        $ad3Points = Registry::get(Request::class)->getRequestEscapedParameter('SELECTIONGROUPS');
        #dumpvar($ad3Points);
        if ($ad3Points != 0 && count($ad3Points) > 0)
        {
            foreach (Registry::get(Request::class)->getRequestEscapedParameter('SELECTIONGROUPS') AS $key => $aGroup)
            {
                #echo $key;
                #dumpvar($aGroup);
                if ($aGroup === '0'){
                    continue;
                }
                $this->d3GetSet()->setValue('d3points_' . $key, array());
                $this->d3GetSet()->setValue('d3points_' . $key, serialize($aGroup));

                //neu
                #$this->getSet()->save();
            }
        }
        #parent::save();

        $this->d3GetSet()->prepareSaveData();
        $this->d3GetSet()->save();
    }

    /**
     * Kundengruppen freigeben
     *
     * @return array alist
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3_PrepareGroups4Points()
    {
        $oGroups = array();
        $aGroups = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_GROUPS_4_POINTS'));
        foreach ($this->d3_GetGroups() as $oGroup)
        {
            if (is_array($aGroups))
            {
                if (in_array($oGroup->oxgroups__oxid->getRawValue(), $aGroups))
                {
                    $oGroup->select = 1;
                    #$oGroup->save();
                }
            }
            $oGroups[] = $oGroup;
        }
        return $oGroups;
    }

    /**
     * Kundengruppen ausschließen
     *
     * @return array alist
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3_PrepareGroups4NoPoints()
    {
        $oGroups = array();
        $aGroups = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_GROUPS_4_NO_POINTS'));
        foreach ($this->d3_GetGroups() as $oGroup)
        {
            if (is_array($aGroups))
            {
                if (in_array($oGroup->oxgroups__oxid->getRawValue(), $aGroups))
                {
                    $oGroup->select = 1;
                    #$oGroup->save();
                }
            }
            $oGroups[] = $oGroup;
        }
        return $oGroups;
    }

    /**
     * Load Groups
     *
     * @return object alist
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    protected function d3_GetGroups()
    {
        return utils_points::d3_d3pointsUtils_LoadGroups();
    }

    /**
     * Gesetztes "bezahlt am"-Datum
     *
     * @return array alist
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3_PreparePaymentsPaid4Points()
    {
        $oPayments = array();
        $aPayments = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_PAYMENTS_PAID_4_POINTS'));

        foreach ($this->d3_GetPayments() as $oPayment)
        {
            if (is_array($aPayments))
            {
                if (in_array($oPayment->oxpayments__oxid->getRawValue(), $aPayments))
                {
                    $oPayment->select = 1;
                    #$oPayment->save();
                }
            }
            $oPayments[] = $oPayment;
        }
        return $oPayments;
    }

    /**
     * Bezahlarten für "Keine Punkte bei folgenden Zahlarten"
     *
     * @return array  $oPayment
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3_PreparePayments4NoPoints()
    {
        $oPayments = array();
        $aPayments = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_PAYMENTS_4_NO_POINTS'));

        foreach ($this->d3_GetPayments() as $oPayment)
        {
            if (is_array($aPayments))
            {
                if (in_array($oPayment->oxpayments__oxid->getRawValue(), $aPayments))
                {
                    $oPayment->select = 1;
                    #$oPayment->save();
                }
            }
            $oPayments[] = $oPayment;
        }
    	#dumpvar($oPayments);
        return $oPayments;
    }

    /**
     * Versandtdatum bei folgenden Bezahlarten prüfen
     *
     * @return array alist
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3_PrepareDeliveryDate4NoPoints()
    {
        $oPayments = array();
        $aPayments = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_DELIVERYDATE_4_NO_POINTS'));

        foreach ($this->d3_GetPayments() as $oPayment)
        {
            if (is_array($aPayments))
            {
                if (in_array($oPayment->oxpayments__oxid->getRawValue(), $aPayments))
                {
                    $oPayment->select = 1;
                    #$oPayment->save();
                }
            }
            $oPayments[] = $oPayment;
        }
        return $oPayments;
    }

    /**
     * Load Payment methods
     *
     * @return object alist
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    protected function d3_GetPayments()
    {
        /* @var $d3Utils utils_points */
        $d3Utils = oxnew(utils_points::class);
        return $d3Utils->d3_d3pointsUtils_LoadPayments();
    }

    /**
     * Return URL-Paramete with String
     * only if is in subshop
     *
     * @return string
     */
    public function d3GetShopId()
    {
        $sShopId = Registry::getConfig()->getShopId();
        if ($sShopId != '1') {
            return "&shp=" . $sShopId;
        }
        return "";
    }

    /**
     * @return string
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetRandomCode()
    {
        /* @var $d3Utils utils_points */
        $d3Utils = oxnew(utils_points::class);
        return $d3Utils->d3_d3pointsUtils_d3GetRandomVoucher();
    }

    /**
     * @return array
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetOxFolders4Points()
    {
        $oFolders = array();
        $aFolders = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_FOLDERS_4_POINTS'));
        foreach ($this->getFolderFromOxConfig() as $key => $sColor)
        {
            $oFolder = NULL;
            $oFolder->id = $key;
            $oFolder->color = $sColor;
            if (is_array($aFolders))
            {
                if (in_array($key, $aFolders))
                {
                    $oFolder->select = 1;
                    #$oPayment->save();
                }
            }
            $oFolders[] = $oFolder;
        }
        return $oFolders;
    }

    /**
     * @return array
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetOxFolders4NoPoints()
    {
        $oFolders = array();
        $aFolders = unserialize($this->d3GetSet()->getValue('d3points_SELECTION_FOLDERS_4_NO_POINTS'));
        #dumpvar($aFolders);
        foreach ($this->getFolderFromOxConfig() as $key => $sColor)
        {
            $oFolder = NULL;
            $oFolder->id = $key;
            $oFolder->color = $sColor;
            if (is_array($aFolders))
            {
                if (in_array($key, $aFolders))
                {
                    $oFolder->select = 1;
                    #$oPayment->save();
                }
            }
            $oFolders[] = $oFolder;
        }

        return $oFolders;
    }

    /**
     * @return mixed
     */
    public function getFolderFromOxConfig()
    {
        return Registry::get(Request::class)->getConfigParam('aOrderfolder');
    }

    /**
     * @param bool $blUsePw
     * @param bool|int $iCronJobId
     *
     * @return string
     * @throws DatabaseConnectionException
     * @throws \Exception
     */
    public function getCronLink(bool $blUsePw, int $iCronJobId = 0)
    {
        $sBaseUrl = $this->getViewConfig()->getModuleUrl('d3points').'public/d3_cron_points.php';

        $aParameters = array(
            'shp' => $this->getViewConfig()->getActiveShopId(),
        );

        if ($iCronJobId !== 0) {
            $aParameters['cjid'] = $iCronJobId;
        }

        if ($blUsePw) {
            $aParameters['key'] = $this->d3GetSet()->getValue('d3points_ACCESSKEY') ?
                $this->d3GetSet()->getValue('d3points_ACCESSKEY') :
                $this->d3GetRandomCode();
        }

        //$sURL   = $this->getD3Str()->generateParameterUrl($sBaseUrl, $aParameters);

        $oD3Str = oxNew(d3str::class);
        return $oD3Str->generateParameterUrl($sBaseUrl, $aParameters);
    }

    /**
     * @return array
     */
    public function getCronProviderList()
    {
        /** @var d3filegeneratorcronsh $oD3ShGenerator */
        $oD3ShGenerator = oxNew(d3filegeneratorcronsh::class);

        return $oD3ShGenerator->getContentList();
    }

    /**
     * @throws DatabaseErrorException
     * @throws DatabaseConnectionException
     * @throws DBALException
     * @throws d3_cfg_mod_exception
     * @throws d3ShopCompatibilityAdapterException
     * @throws StandardException
     */
    public function generateCronShFile()
    {
        $oModule = oxNew(Module::class);

        $oD3CompatibilityAdapterHandler = oxNew(d3ShopCompatibilityAdapterHandler::class);
        $sModulePath = $oD3CompatibilityAdapterHandler->call(
            'oxmodule__getModuleFullPath',
            array($oModule, d3_cfg_mod::get($this->_sModId)->getMetaModuleId())
        );

        $sScriptPath = $sModulePath . "/public/d3_cron_points.php";

        //$sCronId = Registry::get(Request::class)->getRequestEscapedParameter('cronid');

        $oShop = Registry::getConfig()->getActiveShop();
        $aParameters = array(
            //0 => $oShop->getId(),
            //1 => $sCronId,
        );

        $oD3ShGenerator = oxNew(d3filegeneratorcronsh::class);

        $oD3ShGenerator->setContentType(Registry::get(Request::class)->getRequestParameter('crontype'));
        $oD3ShGenerator->setScriptPath($sScriptPath);
        $oD3ShGenerator->setSortedParameterList($aParameters);
        $oD3ShGenerator->startDownload('d3_cron_points_'.$oShop->getId().".sh");
    }
}