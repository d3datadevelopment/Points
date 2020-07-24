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
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\d3points;

/**
 * Class userpoints
 *
 * @package D3\Points\Application\Controller\Admin
 */
class userpoints extends AdminDetailsController
{
    /**
     * Current class default template name.
     *
     * @var string
     */
    protected $_sThisTemplate = 'd3points_userpoints.tpl';
    #private $_sModId = 'd3points';
    #private $_oSet = null;
    private $_sSaveError = null;

    /**
     * Executes parent method parent::render(), creates oxlist object,
     * passes it's data to Smarty engine and retutns name of template
     * file "d3_user_points.tpl".
     *
     * @return string
     * @throws SystemComponentException
     */
    public function render()
    {
        parent::render();
        $soxId = $this->getEditObjectId();

        /*
        if ($this->_sSaveError) {
            $this->_aViewData["sSaveError"] = $this->_sSaveError;
        }*/

        if ($soxId != "-1" && isset($soxId)) { // load object
            /* @var $oUser User */
            $oUser = oxNew(User::class);
            $oUser->Load($soxId);
            $this->_aViewData["edit"] = $oUser;
        }

        return $this->_sThisTemplate;
    }

    /**
     * Create new points for user
     *
     * write errors to $this->_sSaveError
     *
     * @throws DatabaseConnectionException
     * @throws SystemComponentException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws d3_cfg_mod_exception
     */
    public function CreateNewPoints()
    {
        $soxId      = Registry::get(Request::class)->getRequestEscapedParameter('oxid');
        $iNewPoints = (int)Registry::get(Request::class)->getRequestEscapedParameter("dNewPoints");
        $sText      = Registry::get(Request::class)->getRequestEscapedParameter("sText");

        if ($soxId != "-1" && isset($soxId)) { // load object
            /* @var $oUser User */
            $oUser = oxNew(User::class);
            $oUser->Load($soxId);

            /* @var $oD3UserPoints d3points */
            $oD3UserPoints = oxNew(d3points::class);
            $oD3UserPoints->d3CreateManualNewPoints($oUser, $iNewPoints, $sText);
            $this->_sSaveError = $oD3UserPoints->d3GetReturnMessage();
        }
    }

    /**
     * Return total points as Sum for User
     *
     * @param String $soxId
     *
     * @return String
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getPointsTotalSum($soxId)
    {
        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);
        return $oD3UserPoints->d3GetTotalSumPoints($soxId);
    }

    /**
     * Return all points from user
     *
     * @param String $soxId
     *
     * @return object
     * @throws DatabaseConnectionException
     * @throws SystemComponentException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetAllPoints($soxId)
    {
        /* @var $oD3UserPoints d3points */
        $oD3UserPoints = oxNew(d3points::class);
        #return $oD3UserPoints->d3GetAllPoints($soxId);
        $oTmpPoints =  $oD3UserPoints->d3GetAllPoints($soxId);
        $oTmpPointsList = $oTmpPoints->aList;

        $aFiles = $this->getAdminTemplatesForList();
        $oPointsList = array();
        #while($oTmpPointsList->EOF)
        foreach($oTmpPointsList as $sKey => $oPoints)
        {
            $sTmpType = "d3points_userpoints_".$oPoints->d3points__oxtype->rawValue.".tpl";
            $sTmpTypeOther = "d3points_userpoints_other.tpl";

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
        #dumpvar($oPointsList);
        return $oTmpPointsList;
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
    public function d3GetSelectedOption($iBit)
    {
        $soxId = $this->getEditObjectId();

        /* @var $oUser User */
        $oUser = oxNew(User::class);
        $oUser->load($soxId);

        if ($oUser) {
            /* @var $od3Points d3points */
            $od3Points = oxnew(d3points::class);
            return $od3Points->d3GetSelectedOption($oUser->getId(), $iBit);
        }
        return false;
    }

    /**
     * @param string $sDate
     *
     * @return string
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetNextReminderDate($sDate)
    {
        /* @var $od3Points d3points */
        $od3Points = oxnew(d3points::class);
        $sD3PointsRemindDays = $od3Points->d3GetDelayForReminderMail();

        return date("Y-m-d H:i:s", strtotime($sDate) + (60 * 60 * 24 * $sD3PointsRemindDays));
    }


    /**
     * Write Options for reciving mails for users
     * save Option in oxuser in field d3pointsmailoption as decimal
     * convert values from bin to decimal
     *
     * 0 = Bonuspunkte für Bestellungen
     * 1 = Bonuspunkte für Artikelbewertungen
     * 2 = Erinnerungsmail für vorhandene Bonuspunkte
     *
     * @throws DatabaseConnectionException
     * @throws SystemComponentException
     */
    public function d3SetMailOptions()
    {
        $soxId = $this->getEditObjectId();

        /* @var $oUser User */
        $oUser = oxNew(User::class);
        $oUser->load($soxId);

        if($oUser) {
            /** @var d3points $od3Points */
            $od3Points = oxnew(d3points::class);
            $od3Points->setMailOptions($oUser->getId(), Registry::get(Request::class)->getRequestEscapedParameter( "d3PointsMailStatus"));
        }
    }

    /**
     * @return array
     * @throws SystemComponentException
     */
    public function getAdminTemplatesForList()
    {
        /** @var  $oModul Module*/
        //$oModule = oxNew('oxModule');
        $oModule = oxNew(Module::class);
        $oModule->load('d3points');
        $aTmpTemplates = $oModule->getInfo('templates');
        $aTemplates = array();

        foreach ($aTmpTemplates as $sTemplate => $sPathToFile)
        {
            if(substr_count($sTemplate,'d3points_userpoints_'))
            {
                $aTemplates[$sTemplate] = $sPathToFile;
            }
        }
        return $aTemplates;
    }

    /**
     * @return null
     */
    public function d3SaveError()
    {
        return $this->_sSaveError;
    }
}
