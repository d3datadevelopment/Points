<?php
/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 *
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package "Bonuspunkte"
 * @author Thomas Dartsch <thomas.dartsch@shopmodule.com>
 * @copyright (C) 2012, D3 Data Development
 * @see http://www.shopmodule.com
 *
 * $Rev::                                               $:
 * $Author::                                            $:
 * $Date::                                              $:
 */

//ini_set('display_errors', 1);
//ini_set('error_reporting', 1);

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\Session;
use D3\Points\Application\Model\utils_points;
use D3\Points\Application\Model\d3points;
use OxidEsales\Eshop\Core\Controller\BaseController;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\EshopCommunity\Core\Email;

require_once dirname(__FILE__) . "/../../../../bootstrap.php";

/**
 * Class d3_Cron_Points
 */
class d3_Cron_Points extends BaseController
{
    /**
     * Secret Key für den Aufruf des Script per Browser
     *
     * @var string
     */
    protected $_sDefaultAccessKey = "H78hbk32Jofjeo";
    private $_sModId = 'd3points';
    protected $_sLogType = d3log::ERROR;

    /**
     * Prüft auf Konsolen-Zugriff und startet die nötigen weiteren Methoden
     *
     * @throws Exception
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function init()
    {
        //Shopid setzten
        $sShopId = utils_points::d3_d3pointsUtils_CheckShopId();
        Registry::getConfig()->setShopId($sShopId);

        /**
         * Wenn ModCfg nicht aktiv, dann wird log-Eintrag
         * beendet Skript!
         */
        if (!$this->getModCfg()->isActive())
        {
            $this->getD3Log()->Log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "Modul Bonuspunkte nicht aktiv", "nicht aktiv");
            //todo Uebesetzung
            echo "Modul Bonuspunkte nicht aktiv";
            Registry::get(Session::class)->freeze();
            exit();
        }

        $this->getModCfg()->setValue('d3points_CronJob_NEWPOINTS_LastStart', date('Y-m-d H:i:s'));
        $this->getModCfg()->saveNoLicenseRefresh();

        $this->getD3Log()->Log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "Starting CronJob-Bonuspunkte, Shop: " . $sShopId);

        $sGetAccessKey = Registry::get(Request::class)->getRequestEscapedParameter('key');
        $sValidAccessKey = $this->getModCfg()->getValue('d3points_ACCESSKEY');

        if (!$sValidAccessKey) {
            $sValidAccessKey = $this->_sDefaultAccessKey;
        }
        if (($_SERVER['REMOTE_ADDR'] || $_SERVER['HTTP_USER_AGENT']) && $sValidAccessKey != $sGetAccessKey)
        {
            $this->getD3Log()->Log(d3log::CRITICAL, __CLASS__, __FUNCTION__, __LINE__, "shutdown", "access with browser!.");
            die("security shutdown");
        }

        //CronJob aktiv
        if (0 === $this->getModCfg()->getValue('bld3points_CRONJOB_ACTIVE'))
        {
            $this->getD3Log()->Log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "CronJob nicht aktiv", "nicht aktiv");
            //todo Uebesetzung
            echo "CronJob Punktevergabe nicht aktiv";
            Registry::get(Session::class)->freeze();
            exit();
        }

        /**
         * Grab d3Points class
         * start cronjob + cronjob-actions
         *      checking if status shall be printed
         *      check if status shall be sent to remote address
         */
        /** @var d3points $d3PointsObject */
        $d3PointsObject = oxnew(d3points::class);
        $ret = 'Start CronJob';
        $sStatus       = $d3PointsObject->d3StartCronJobActions();

        // checking if status shall be printed
        if($this->getModCfg()->getValue('bld3points_FNC_CRONJOB_PRINT_STATUS'))
        {
            $ret.= $sStatus;
        }

        // check if status shall be sent to remote address
        if(trim($this->getModCfg()->getValue('sd3points_FNC_CRONJOB_SEND_STATUS_TO')) != '') {
            $oMail    = oxNew(Email::class);
            $sTextAdd = 'CronJob Bonuspunkte - ' . date('H:i:s d.m.Y') . PHP_EOL;
            $oMail->sendEmail($this->getModCfg()->getValue('sd3points_FNC_CRONJOB_SEND_STATUS_TO'), 'CronJob Bonuspunkte', nl2br($sTextAdd . $sStatus));
        }

        $this->getD3Log()->Log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "End CronJob-Bonuspunkte Report", $ret);

        $ret.='<br>End CronJob';

        Registry::getSession()->freeze();
        exit(nl2br($ret));
    }

    /**
     * @return object
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getModCfg()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return d3log
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getD3Log()
    {
        return $this->getModCfg()->d3getLog();
    }
}
$oBV = new d3_Cron_Points;
$oBV->init();