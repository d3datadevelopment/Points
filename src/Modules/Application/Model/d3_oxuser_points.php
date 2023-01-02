<?PHP
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

namespace D3\Points\Modules\Application\Model;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Config;
use \OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\d3points;

/**
 * Class d3_oxuser_points
 */
class d3_oxuser_points extends d3_oxuser_points_parent
{
    private $_sModId = 'd3points';

    /**
     * check user for
     * - account(passwort)
     * - activ-flag
     * - oxshop-field
     *
     * @param bool $blIsMallMode
     *
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function d3CheckUserWithAccount($blIsMallMode)
    {
        $blReturn = $this->_d3blUserHasAccount();
        if(!$blReturn)
        {
            return $blReturn;
        }

        $blReturn = $this->_d3blUserIsActive();
        if(!$blReturn)
        {
            return $blReturn;
        }

        $blReturn = $this->_d3blUserHasShopId($blIsMallMode);
        if(!$blReturn)
        {
            return $blReturn;
        }

        return TRUE;
    }

    /**
     * check user for account(passwort)
     * if "Kunden ohne Kundenkonto erhalten Bonuspunkte" is set/true: --> no check for password, it return true in every case
     * if "Kunden ohne Kundenkonto erhalten Bonuspunkte" is not set/false --> check for password, it returns fals if not password is set
     *
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function _d3blUserHasAccount()
    {
        if((bool)$this->getModCfg()->getValue('d3points_DO_POINTS_FOR_USER_WITHOUT_ACCOUNT'))
        {
            return TRUE;
        }

        if (!$this->hasAccount()) {
            d3_cfg_mod::get($this->_sModId)->d3getLog()->Log(d3log::DEBUG, __CLASS__, __FUNCTION__, __LINE__,
                                                             "User:Check for account", "User has no account, oxpassword='' ");
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Check User for active-flag
     * if oxactive == 0/false --> return false
     *
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function _d3blUserIsActive()
    {
        if(!(bool)$this->oxuser__oxactive->value)
        {
            d3_cfg_mod::get($this->_sModId)->d3getLog()->Log(d3log::DEBUG, __CLASS__, __FUNCTION__, __LINE__,
                                                             "User:Check for active", "User is not active");
            return FALSE;
        }

        return TRUE;
    }

    /**
     * $blIsMallMode == true --> no checkt for ShipId
     * $blIsMallMode == false --> check for ShopId
     * return false if CurrentShopId is different by UserShopId
     *
     * @param bool $blIsMallMode
     *
     * @return bool
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    protected function _d3blUserHasShopId($blIsMallMode)
    {
        if($blIsMallMode)
        {
            return TRUE;
        }

        if($this->oxuser__oxshopid->value != Registry::get(Config::class)->getShopId())
        {
            $this->getD3Log()->Log(d3log::DEBUG, __CLASS__, __FUNCTION__, __LINE__,
                                                             "User:Check for shopid",
                                                             "User has differnt shopid,
            current ShopID: ". Registry::get(Config::class)->getShopId().', user ShopId:'.$this->oxuser__oxshopid->value);
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Update Field d3pointssendreminder on oxuser
     * set date with now()
     *
     * @param string $sUserId
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3UpdateReminderDate($sUserId)
    {
        $oDb = DatabaseProvider::getDb();
        $sUpdate ="UPDATE ".$this->getViewName()." set d3pointssendreminder = NOW()
                WHERE oxid =".$oDb->quote($sUserId);
        return DatabaseProvider::getDb()->Execute($sUpdate);
    }

    /**
     * @param string $sUserId
     * @param string $sRecEmail
     *
     * @return bool
     * @throws d3_cfg_mod_exception
     * @throws \Exception
     * @throws DatabaseConnectionException
     */
    public function setCreditPointsForRegistrant_( $sUserId,$sRecEmail )
    {
        $ret = parent::setCreditPointsForRegistrant($sUserId, $sRecEmail );
        if($ret)
        {
            /** @var $d3Points d3points */
            $d3Points = oxnew(d3points::class);
            $d3Points->d3SetPointsForRegistrant($this->getId());
        }
        return $ret;

    }

    /**
     * @return bool
     * @throws d3_cfg_mod_exception
     * @throws \Exception
     * @throws DatabaseConnectionException
     */
    public function setCreditPointsForInvite_()
    {
        $ret = parent::setCreditPointsForInviter();
        if($ret)
        {
            $sUserId = $this->getId();
            /** @var $d3Points d3points */
            $d3Points = oxnew(d3points::class);
            $d3Points->d3SetForPointsForInviter($this->getId(),$sUserId);
        }

        return $ret;
    }

    /**
     * @return null|object
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws SystemComponentException
     */
    public function d3GetAllPoints()
    {
        if(!$this->isLoaded())
        {
            return NULL;
        }
        /** @var d3points $oD3Points */
        $oD3Points = oxNew(d3points::class);
        return $oD3Points->d3GetAllPoints($this->getId());
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getModCfg()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return d3log
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getD3Log()
    {
        return $this->getModCfg()->d3getLog();
    }

}