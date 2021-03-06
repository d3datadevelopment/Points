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
use \OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Application\Model\User;
use D3\Points\Application\Model\d3points;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;

/**
 * Class d3_oxorder_d3points
 *
 * @package D3\Points\Modules\Application\Model
 */
class d3_oxorder_d3points extends d3_oxorder_d3points_parent
{
    private $_sModId = 'd3points';
    public  $iD3UpdatedOrders = 0;
    public  $iPointPayOutAmount = 0;
    public  $iUserPointSum = 0;
    public  $iNewPoints = 0;

    /**
     * Save Status d3issetpoints to oxorder
     * 0 = order is not processed by cronjob
     * 1 = order is processed by cronjob
     *
     * @param string  $sOrderId
     * @param integer $iSetPoints
     *
     * @return bool
     */
    public function d3UpdateOrderFieldD3isSetPoints($sOrderId, $iSetPoints)
    {
        if ($this->load($sOrderId))
        {
            $this->assign(
                array('d3issetpoints'   => $iSetPoints)
            );
            return $this->save();
        }
        return false;
    }

    /**
     * Reset field d3issetpoints for alle orders
     * limit by Date
     *
     * @param integer $iStatus  0 / 1
     * @param bool    $blStatus extrac checkbox in templates
     *
     * @return bool
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws DBALException
     * @throws StandardException
     * @throws d3_cfg_mod_exception
     */
    public function d3ResetOrders($iStatus, $blStatus)
    {
        if ($blStatus == true) {
            if (!$iStatus) {
                $iStatus = 0;
            }

            $oDb = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);

            /* @var $od3points d3points */
            $od3points          = oxnew(d3points::class);
            $sD3PointsDateLimit = $od3points->d3GetDateLimitForOrders();
            $sD3PointsTypeLimit = $od3points->d3GetDateLimitTypeForOrders();

            $sDateSqlAdd = '';
            if ($sD3PointsDateLimit > 0 && $sD3PointsTypeLimit != '--') {
                //todo: Umstellung auf Mysql Date_ADD
                $sDateSqlAdd = "WHERE oxorderdate >= {$oDb->quote(date("Y-m-d", strtotime('-' . $sD3PointsDateLimit . $sD3PointsTypeLimit)))}";
                #$sDateSqlAdd = " AND oxorderdate >=  DATE_ADD(NOW(), Interval - ". $iD3PointsDateLimit ." " .$sD3PointsTypeLimit. ")";
            }

            $sSelect =<<<MYSQL
SELECT count(oxid)
FROM {$this->_sCoreTable}
{$sDateSqlAdd}
AND OXSHOPID = {$oDb->quote($this->getConfig()->getShopId())}
MYSQL;

            $this->iD3UpdatedOrders = $oDb->getone($sSelect);

            $sUpdate = <<<MYSQL
UPDATE {$this->_sCoreTable}
SET d3issetpoints= {$oDb->quote($iStatus)}
{$sDateSqlAdd}
AND OXSHOPID ={$oDb->quote($this->getConfig()->getShopId())}
MYSQL;

            d3_cfg_mod::get($this->_sModId)->d3getLog()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "Reset Orders ",
            "Query: " . PHP_EOL . $sUpdate
            );

            #echo $sUpdate;
            $rs = $oDb->Execute($sUpdate);

            return $rs;
        }
        return false;
    }

    /**
     * @return User
     */
    public function d3getOrderUser()
    {
        /** @var User $oUser */
        $oUser = oxNew(User::class);
        $oUser->load($this->getFieldData('oxuserid'));
        return $oUser;
    }
}