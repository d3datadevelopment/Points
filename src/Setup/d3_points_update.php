<?php
/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

/**
 * Class d3points_update
 */

namespace D3\Points\Setup;

use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use D3\ModCfg\Application\Model\Installwizzard\d3installdbrecord;
use d3\modcfg\Application\Model\d3database;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Facts\Facts;

class d3_points_update extends d3install_updatebase
{
    public $sModKey = 'd3points';
    public $sModName = 'Bonuspunkte';
    public $sModVersion = '5.0.3.0';
    public $sModRevision = '5030';
    public $sBaseConf = '--------------------------------------------------------------------------------
FSRv2==UjlRUWJ2UnQvMVptaFNJMDBMSFp1OXRleFFwZURmT3ovelBJOWlNbE5jR3U3aDdRY2w2aHV5M
VhSQ29LbS81Qy8zMTRFSktXQkI2Qi9Ya0NNRUdkQVp2WUk0UnNxZjJNc0I1MGIxN2hieUQ5M3lVVGVBd
zlqRmlXeHlPa0FNc1ZHN016Q2E5OG9BcTFkeGVuZ2lVR0g1ditXRWlnM1N5RGtDeTlLNHA4bHcxVldMe
FZLa2xTaXoybEhDNDY3Nk9ITTVUblQwNGhtOFJPdWxvbmthdGZ0MXJYTUJtb2toOXllZURYN0p4cmNDc
GQvL0xzTVY0aWI5TzFpSEluUWpxZW1pNzY5VEFqYXJvY1VZazV4dGtKa3ovaFZtOHgxR29mWHdyQlNsY
zFDT1k5SWFCVEp5eVpiN1VCV0JGYW1STUk=
--------------------------------------------------------------------------------';

    public $sRequirements = '';
    public $sBaseValue = '';
    protected $_aRefreshMetaModuleIds = array('d3points');  // alle zu aktualisierenden Module, verwendet nicht onDeactivate-Handler

    // auszuführende Check- und Updateanweisungen in auszuführender Reihenfolge
    protected $_aUpdateMethods = array(
        // prüft auf DB-Eintrag (hier ModCfg) und fügt diese ggf. ein bzw. führt Update aus
        array(
            'check' => 'checkModCfgItemExist',
            'do'    => 'updateModCfgItemExist'
        ),
        array(
            'check' => 'checkMultiLangTables',
            'do'    => 'fixRegisterMultiLangTables'
        ),
        // prüft auf umzubenennende Tabellen und führt dies ggf. aus
        array(
            'check' => 'checkRenameTables',
            'do'    => 'fixRenameTables'
        ),
        // prüft Tabelle und legt sie ggf. an
        array(
            'check' => 'checkTableForPointsExist',
            'do'    => 'updateTableForPointsExist'
        ),
        // prüft auf umzubenennende Felder und führt dies ggf. aus
        array(
            'check' => 'checkRenameFields',
            'do'    => 'fixRenameFields'
        ),
        // prüft Felder in Tabelle und legt sie ggf. an bzw. modifiziert diese
        array(
            'check' => 'checkFields',
            'do'    => 'fixFields'
        ),
        // prüft Indizes in Tabelle und legt sie ggf. an
        array(
            'check' => 'checkIndizes',
            'do'    => 'fixIndizes'
        ),
        //oxbaseshop ersetzen
        array(
            'check' => 'CheckForOxBaseShopIdPointsTable',
            'do' => 'ReplaceOxBaseShopIdPointsTable'
        ),
        array(
            'check' => 'checkOxSeoItemsList',
            'do'    => 'executeOxSeoItemsList'
        ),
        array(
            'check' => 'checkForReminderDate',
            'do'    => 'updateForReminderDate'
        ),
        array(
            'check' => 'checkForReminderDate',
            'do'    => 'updateForReminderDate'
        ),
        // Insert new E-Mail-CMS-Contents - wenn diese bereits vorhanden sind wird nix gemacht
        array(
            'check' => 'checkOxcontentPointsItems',
            'do'    => 'updateOxcontentPointsItems'
        ),
        // prüft auf nachgezogene Revisionsnummer und überträgt diese ggf.
        array(
            'check' => 'checkModCfgSameRevision',
            'do'    => 'updateModCfgSameRevision'
        ),
    );

    // Standardwerte für checkFields(), _addTable() und fixFields()
    public $aFields = array(
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXID',
            'sType' => 'CHAR(32)',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => FALSE,
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXSHOPID',
            'sType' => 'VARCHAR(32)',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => '',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXUSERID',
            'sType' => 'CHAR(32)',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => '',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXOBJECTID',
            'sType' => 'CHAR(32)',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => '',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXTYPE',
            'sType' => 'CHAR(32)',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => 'oxorder, oxreview, oxrating, oxvoucher, manuell, oxvoucher_storno, oxorder_storno',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'D3POINTS',
            'sType' => 'INT(5)',
            'blNull' => FALSE,
            'sDefault' => '0',
            'sComment' => '',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXSORT',
            'sType' => 'INT(10)',
            'blNull' => FALSE,
            'sDefault' => '0',
            'sComment' => '',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXTIME',
            'sType' => 'datetime',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => 'Zeitpunkt der Erstellung der Punkte',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'OXTEXT',
            'sType' => 'TEXT',
            'blNull' => FALSE,
            'sDefault' => FALSE,
            'sComment' => '',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sFieldName' => 'D3ISSEND',
            'sType' => 'TINYINT(1)',
            'blNull' => FALSE,
            'sDefault' => '0',
            'sComment' => 'Mail schon versendet',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),

        ### OXUSER
        array(
            'sTableName' => 'oxuser',
            'sFieldName' => 'D3POINTSMAILOPTION',
            'sType' => 'INT(8)',
            'blNull' => FALSE,
            'sDefault' => '0',
            'sComment' => 'd3points: Optionen, dezimal',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'oxuser',
            'sFieldName' => 'D3POINTSSENDREMINDER',
            'sType' => 'datetime',
            'blNull' => FALSE,
            'sDefault' => '0000-00-00 00:00:00',
            'sComment' => 'd3points: letzter Versand der Reminder-e-mail',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),

        ### OXORDER
        array(
            'sTableName' => 'oxorder',
            'sFieldName' => 'D3ISSETPOINTS',
            'sType' => 'TINYINT(1)',
            'blNull' => FALSE,
            'sDefault' => '0',
            'sComment' => 'd3points: Bestellung schon bearbeitet',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
    );
    // Standardwerte für checkIndizes() und fixIndizes()
    public $aIndizes = array(
        array(
                'sTableName' => 'd3points',
                'sType'      => d3database::INDEX_TYPE_PRIMARY,
                'aFields'    => array(
                    'OXID' => 'OXID',
                ),
                'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'd3points',
            'sType' => '',
            'sName' => 'OXUSERID',
            'aFields' => array(
                'OXUSERID' => 'OXUSERID',
            ),
            'blMultilang' => FALSE,
        ),
    );
    // Standardwerte für checkRenameFields() und fixRenameFields()
    public $aRenameFields = array(
        array(
            'sTableName'     => 'd3points',
            'mOldFieldNames' => array('d3issend'), // is case sensitive
            'sFieldName'     => 'D3ISSEND',
            'sComment'       => 'd3points: Mail schon versendet',
            'blMultilang'    => false,
        ),
        array(
            'sTableName'     => 'oxuser',
            'mOldFieldNames' => array('d3pointsmailoption'), // is case sensitive
            'sFieldName'     => 'D3POINTSMAILOPTION',
            'sComment'       => 'd3points: Mail schon versendet',
            'blMultilang'    => false,
        ),
        array(
            'sTableName'     => 'oxuser',
            'mOldFieldNames' => array('d3pointssendreminder'), // is case sensitive
            'sFieldName'     => 'D3POINTSSENDREMINDER',
            'sComment'       => 'd3points: letzter Versand der Reminder-e-mail',
            'blMultilang'    => false,
        ),
        array(
            'sTableName'     => 'oxorder',
            'mOldFieldNames' => array('d3issetpoints'), // is case sensitive
            'sFieldName'     => 'D3ISSETPOINTS',
            'sComment'       => 'd3points: Bestellung schon bearbeitet',
            'blMultilang'    => false,
        ),
    );
    // Standardwerte für checkMultiLangTables() und fixRegisterMultiLangTables()
    public $aMultiLangTables = array();
    // Standardwerte für checkRenameTables() und fixRenameTables()
    public $aRenameTables = array(
        array(),
    );
    public $sModLicenceKey = '';

    /*******************************************************************************************/
    /***** Test- und Updatemethoden * MOD_CFG - Eintrag ****************************************/
    /*******************************************************************************************/

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkModCfgItemExist()
    {
        /** @var d3installdbrecord $oDbRecord */
        $oDbRecord = oxNew(d3installdbrecord::class, $this);

        $blRet = false;
        foreach (Registry::getConfig()->getShopIds() as $sShopId) {
            $aWhere = array(
            'oxmodid'       => $this->sModKey,
            'oxshopid'      => $sShopId,
            'oxnewrevision' => $this->sModRevision,
            );

            $blRet = $oDbRecord->checkTableRecordNotExist('d3_cfg_mod', $aWhere);

            if ($blRet) {
                return $blRet;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function updateModCfgItemExist()
    {
        $blRet = FALSE;

        if ($this->checkModCfgItemExist()) {
            /** @var d3installdbrecord $oDbRecord */
            $oDbRecord = oxNew(d3installdbrecord::class, $this);
            foreach (Registry::getConfig()->getShopIds() as $sShopId) {
                $aWhere = array(
                    'oxmodid'       => $this->sModKey,
                    'oxshopid'      => $sShopId,
                    'oxnewrevision' => $this->sModRevision,
                );

                if($oDbRecord->checkTableRecordNotExist('d3_cfg_mod',$aWhere))
                {
                    // update don't use this property
                    unset($aWhere['oxnewrevision']);

                    $aInsertFields = array(
                        'OXID' => array(
                            'fieldname' => 'OXID',
                            'content' => "md5('" . $this->sModKey . " " . $sShopId . " de')",
                            'force_update' => FALSE,
                            'use_quote' => FALSE,
                            'use_multilang' => FALSE,
                        ),
                        'OXSHOPID' => array(
                            'fieldname' => 'OXSHOPID',
                            'content' => $sShopId,
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        'OXMODID' => array(
                            'fieldname' => 'OXMODID',
                            'content' => $this->sModKey,
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        'OXNAME' => array(
                            'fieldname' => 'OXNAME',
                            'content' => $this->sModName,
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        'OXACTIVE' => array(
                            'fieldname' => 'OXACTIVE',
                            'content' => '0',
                            'force_update' => FALSE,
                            'use_quote' => FALSE,
                        ),
                        'OXBASECONFIG' => array(
                            'fieldname' => 'OXBASECONFIG',
                            'content' => $this->sBaseConf,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        'OXSERIAL' => array(
                            'fieldname' => 'OXSERIAL',
                            'content' => "",
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        'OXINSTALLDATE' => array(
                            'fieldname' => 'OXINSTALLDATE',
                            'content' => "NOW()",
                            'force_update' => FALSE,
                            'use_quote' => FALSE,
                        ),
                        'OXVERSION' => array(
                            'fieldname' => 'OXVERSION',
                            'content' => $this->sModVersion,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        'OXSHOPVERSION' => array(
                            'fieldname' => 'OXSHOPVERSION',
                            'content' => oxNew(Facts::class)->getEdition(),
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        'OXREQUIREMENTS' => array(
                            'fieldname' => 'OXREQUIREMENTS',
                            'content' => $this->sRequirements,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        'OXVALUE'        => array(
                            'content'       => $this->sBaseValue,
                            'force_update'  => FALSE,
                            'use_quote'     => TRUE,
                        ),
                        'OXNEWREVISION' => array(
                            'fieldname' => 'OXNEWREVISION',
                            'content' => $this->sModRevision,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        )
                    );

                    if (method_exists($this, '_updateTableItem2'))
                    {
                        $this->setInitialExecMethod(__METHOD__);
                        $blRet  = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhere);
                    } else {  // bc
                        $aRet  = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhere);
                        $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                        $blRet = $aRet['blRet'];
                        $this->setUpdateBreak(false);
                    }
                }
            }
        }
        return $blRet;
    }

    /**
     * @return bool TRUE, if table is missing
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function checkTableForPointsExist()
    {
        return $this->_checkTableNotExist('d3points');
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \oxSystemComponentException
     */
    public function updateTableForPointsExist()
    {
        $blRet = TRUE;

        if ($this->checkTableForPointsExist()) {

            if (method_exists($this, '_updateTableItem2'))
            {
                $this->setInitialExecMethod(__METHOD__);
                $blRet = $this->_addTable2('d3points', $this->aFields, $this->aIndizes, 'd3points Table', 'MyISAM');
            } else {
                // deprecatet _addTable
                $aRet = $this->_addTable('d3points', $this->aFields, $this->aIndizes, 'd3points Table', 'MyISAM');
                $blRet = $aRet['blRet'];
                $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
            }
        }

        return $blRet;
    }

    /**
     * @return bool TRUE, if update is required
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkOxSeoItemsList()
    {
        $blRet = FALSE;
        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            // change this to your inividual check criterias
            $sSql = "SELECT count(OXIDENT) FROM `oxseo` WHERE
                    (`OXIDENT` = 'bf34747dee451a87e0fdc173da6543e2' or
                    `OXIDENT` = 'ebe7e7e711bd53ace1d6056ec2b028e9')
                    AND oxshopid ='". $sShopId ."'
          LIMIT 1;";

            #echo "<hr>".$sSql;
            #echo "<br>Count: " . $this->_getDb()->getOne($sSql);

            if ($this->getDb()->getOne($sSql) <=1) {
                $blRet = TRUE;
            }
        }
        #dumpvar($blRet);
        return $blRet;
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function executeOxSeoItemsList()
    {
        $aSql = array();
        foreach (Registry::getConfig()->getShopIds() as $sShopId) {
            $aSql[] =
                "REPLACE INTO `oxseo` (`OXOBJECTID`, `OXIDENT`, `OXSHOPID`, `OXLANG`, `OXSTDURL`, `OXSEOURL`, `OXTYPE`, `OXFIXED`, `OXEXPIRED`, `OXPARAMS`) VALUES('59b5b21859b5ca849e5fe760cff43091', 'bf34747dee451a87e0fdc173da6543e2', '" . $sShopId . "', 1, 'index.php?cl=d3_d3points_accountpoints', 0x656e2f626f6e75732d706f696e74732f, 'static', 0, 0, '');";
            $aSql[] =
                "REPLACE INTO `oxseo` (`OXOBJECTID`, `OXIDENT`, `OXSHOPID`, `OXLANG`, `OXSTDURL`, `OXSEOURL`, `OXTYPE`, `OXFIXED`, `OXEXPIRED`, `OXPARAMS`) VALUES('59b5b21859b5ca849e5fe760cff43091', 'ebe7e7e711bd53ace1d6056ec2b028e9', '" . $sShopId . "', 0, 'index.php?cl=d3_d3points_accountpoints', 0x426f6e757370756e6b74652f, 'static', 0, 0, '');";
        }
        return $this->_executeMultipleQueries($aSql);
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkForReminderDate()
    {
        $blRet = FALSE;
        $sSql = "SELECT count( oxid ) FROM oxuser WHERE D3POINTSSENDREMINDER != '0000-00-00 00:00:00'";

        if ($this->getDb()->getOne($sSql) == 0 ) {
            $blRet = TRUE;
        }
        return $blRet;
    }

    /**
     * @return mixed
     */
    public function updateForReminderDate()
    {
        $sUpdate[] = "Update oxuser set D3POINTSSENDREMINDER = now() where 1";
        return $this->_executeMultipleQueries($sUpdate);
    }

    /*******************************************************************************************/
    /***** oxcontent - mails - cms-seiten ******************************************************/
    /*******************************************************************************************/

    /**
     * bei CE / PE müssen 20 neue Einträge vorhanden / angelegt sein
     * bei EE je Shop-Id 20 Einträge
     * SELECT * FROM `oxcontents`
     * WHERE `OXLOADID` = 'd3newpointsmail'
     * OR `OXLOADID` = 'd3newpointsplainmail'
     * OR `OXLOADID` = 'd3newpointssubjectmail'
     * OR `OXLOADID` = 'd3pointsvouchermail'
     * OR `OXLOADID` = 'd3pointsvoucherplainmail'
     * OR `OXLOADID` = 'd3pointsvouchersubjectmail'
     * OR `OXLOADID` = 'd3pointsautovouchersubjectmail'
     * OR `OXLOADID` = 'd3pointsautovoucherplainmail'
     * OR `OXLOADID` = 'd3pointsautovouchermail'
     * OR `OXLOADID` = 'd3reviewpointsmail'
     * OR `OXLOADID` = 'd3reviewpointsplainmail'
     * OR `OXLOADID` = 'd3reviewpointssubjectmail'
     * OR `OXLOADID` = 'd3remindpointsmail'
     * OR `OXLOADID` = 'd3remindpointsplainmail'
     * OR `OXLOADID` = 'd3remindpointssubjectmail'
     * OR `OXLOADID` = 'd3pointsdisablemail'
     * OR `OXLOADID` = 'd3pointsdisablemailplain'
     * OR `OXLOADID` = 'd3stornopointssubjectmail'
     * OR `OXLOADID` = 'd3stornopointsmail'
     * OR `OXLOADID` = 'd3stornopointsplainmail'
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkOxcontentPointsItems()
    {
        $blRet = FALSE;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {
            $aWhere = array(
                'oxloadid' => 'd3newpointsmail',
                'oxshopid' => $sShopId,
            );
            $blRet1 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3newpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet2 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3newpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet3 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3pointsvouchermail',
                'oxshopid' => $sShopId,
            );
            $blRet4 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3pointsvoucherplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet5 = $this->_checkTableItemNotExist('oxcontents', $aWhere);

            if ($blRet1 || $blRet2 || $blRet3 || $blRet4 || $blRet5) {
                $blRet = TRUE;
            }


            $aWhere = array(
                'oxloadid' => 'd3pointsvouchersubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet6 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3pointsautovouchersubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet7 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3pointsautovoucherplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet8 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3pointsautovouchermail',
                'oxshopid' => $sShopId,
            );
            $blRet9 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3reviewpointsmail',
                'oxshopid' => $sShopId,
            );
            $blRet10 = $this->_checkTableItemNotExist('oxcontents', $aWhere);

            if ($blRet || $blRet6 || $blRet7 || $blRet8 || $blRet9 || $blRet10) {
                $blRet = TRUE;
            }

            $aWhere = array(
                'oxloadid' => 'd3reviewpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet11 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3reviewpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet12 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3remindpointsmail',
                'oxshopid' => $sShopId,
            );
            $blRet13 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3remindpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet14 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3remindpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet15 = $this->_checkTableItemNotExist('oxcontents', $aWhere);

            if ($blRet || $blRet11 || $blRet12 || $blRet13 || $blRet14 || $blRet15) {
                $blRet = TRUE;
            }

            $aWhere = array(
                'oxloadid' => 'd3pointsdisablemail',
                'oxshopid' => $sShopId,
            );
            $blRet16 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3pointsdisablemailplain',
                'oxshopid' => $sShopId,
            );
            $blRet17 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3stornopointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet18 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3stornopointsmail',
                'oxshopid' => $sShopId,
            );
            $blRet19 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3stornopointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet20 = $this->_checkTableItemNotExist('oxcontents', $aWhere);

            if ($blRet || $blRet16 || $blRet17 || $blRet18 || $blRet19 || $blRet20) {
                $blRet = TRUE;
            }

            $aWhere = array(
                'oxloadid' => 'd3manuelpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blRet21 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3manuelpointsmail',
                'oxshopid' => $sShopId,
            );
            $blRet22 = $this->_checkTableItemNotExist('oxcontents', $aWhere);
            $aWhere = array(
                'oxloadid' => 'd3manuelpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blRet23 = $this->_checkTableItemNotExist('oxcontents', $aWhere);

            if ($blRet21 || $blRet22 || $blRet23) {
                $blRet = TRUE;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     */
    public function updateOxcontentPointsItems()
    {
        $blRet              = FALSE;
        $aExampleJobMethods = array(
            '_d3newpointsmail',
            '_d3newpointsplainmail',
            '_d3newpointssubjectmail',

            '_d3pointsvouchermail',
            '_d3pointsvoucherplainmail',
            '_d3pointsvouchersubjectmail',

            '_d3pointsautovouchersubjectmail',
            '_d3pointsautovoucherplainmail',
            '_d3pointsautovouchermail',

            '_d3reviewpointsmail',
            '_d3reviewpointsplainmail',
            '_d3reviewpointssubjectmail',

            '_d3remindpointsmail',
            '_d3remindpointsplainmail',
            '_d3remindpointssubjectmail',

            '_d3pointsdisablemail',
            '_d3pointsdisablemailplain',

            '_d3stornopointssubjectmail',
            '_d3stornopointsmail',
            '_d3stornopointsplainmail',

            '_d3manuelpointssubjectmail',
            '_d3manuelpointsmail',
            '_d3manuelpointsplainmail',
        );
        foreach ($aExampleJobMethods as $sJobMethod) {
            $blRet = $this->{$sJobMethod}();
        }

        return $blRet;
    }

    /**
     * @param $aWhere
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    protected function _checkInsertContents($aWhere)
    {
        $blRet = FALSE;
        $blRet = $this->_checkTableItemNotExist('oxcontents', $aWhere);

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3newpointsmail oxbaseshop de'), 'd3newpointsmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-EMail Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br><br>Für Ihre Bestellung Nr. [{$order->oxorder__oxordernr->value}] erhalten Sie als Dankeschön <br><p><b>[{$order->iNewPoints}] Punkt[{if $order->iNewPoints > 1 }]e[{/if}]</b></p>auf Ihr Bonuspunkte-Konto gutgeschrieben!<br><br>Sie haben damit aktuell einen <b>Punktestand von [{$order->iUserPointSum}] Punkten</b>.<br><br>Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].<br>Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!<br><br>Noch einmal vielen Dank für Ihren Einkauf.<br>Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3newpointsmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3newpointsmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3newpointsmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3newpointsmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-EMail Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],<br><br>Für Ihre Bestellung Nr. [{$order->oxorder__oxordernr->value}] erhalten Sie als Dankeschön <br> <p><b>[{$order->iNewPoints}] Punkt[{if $order->iNewPoints > 1}]e[{/if}]</b></p>auf Ihr Bonuspunkte-Konto gutgeschrieben!<br><br>Sie haben damit aktuell einen <b>Punktestand von [{$order->iUserPointSum}] Punkten</b>*.<br><br>Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].<br><br>*Ihren tagesaktuellen Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!<br><br>Noch einmal vielen Dank für Ihren Einkauf.<br><br>Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3newpointsplainmail oxbaseshop de'), 'd3newpointsplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-EMail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],Für Ihre Bestellung Nr. [{$order->oxorder__oxordernr->value}] erhalten Sie als Dankeschön[{$order->iNewPoints}] Punkt[{if $order->iNewPoints > 1 }]e[{/if}]auf Ihr Bonuspunkte-Konto gutgeschrieben!Sie haben  aktuell einen Punktestand von [{$order->iUserPointSum}] Punkten.Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!Noch einmal vielen Dank für Ihren Einkauf.Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3newpointsplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {
            $aWhere = array(
                'oxloadid' => 'd3newpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3newpointsplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3newpointsplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-EMail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],'.PHP_EOL.PHP_EOL.'für Ihre Bestellung Nr. [{$order->oxorder__oxordernr->value}] erhalten Sie als Dankeschön[{$order->iNewPoints}] Punkt[{if $order->iNewPoints > 1 }]e[{/if}]auf Ihr Bonuspunkte-Konto gutgeschrieben!'.PHP_EOL.'Sie haben aktuell einen Punktestand von [{$order->iUserPointSum}] Punkten.*'.PHP_EOL.'Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].'.PHP_EOL.PHP_EOL.'*Ihren tagesaktuellen Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!Noch einmal vielen Dank für Ihren Einkauf.'.PHP_EOL.PHP_EOL.'Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3newpointssubjectmail oxbaseshop de'), 'd3newpointssubjectmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-EMail Betreff-Text', 'Ihre Bonuspunkte!', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3newpointssubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3newpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3newpointssubjectmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3newpointssubjectmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-EMail Betreff-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Ihre Bonuspunkte!',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsvouchermail oxbaseshop de'), 'd3pointsvouchermail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Gutschein-EMail Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br><br>Sie haben Ihr Punktekonto erfolgreich in einen Gutschein in Höhe von <b>[{ $voucher->fVoucherdiscount }] [{ $currency->name }]</b> umgewandelt.<br><br><b>Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]</b><br><br>Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.<br>In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.<br>Geben Sie dort den oben genannten Gutscheincode ein.<br><br>Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.<br><br><p>Ihr  [{ $shop->oxshops__oxname->value }] Team </p>', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsvouchermail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsvouchermail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsvouchermail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsvouchermail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Gutschein-EMail Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],<br><br>Sie haben Ihr Punktekonto erfolgreich in einen Gutschein in Höhe von <b>[{$voucher->fVoucherdiscount}] [{$currency->name}]</b> umgewandelt.<br><br><b>Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]</b><br><br>Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.<br>In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.<br>Geben Sie dort den oben genannten Gutscheincode ein.<br><br>Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.<br><br><p>Ihr [{$shop->oxshops__oxname->value}] Team </p>',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsvoucherplainmail oxbaseshop de'), 'd3pointsvoucherplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Gutschein-EMail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],Sie haben Ihr Punktekonto erfolgreich in einen Gutschein in Höhe von [{ $voucher->fVoucherdiscount }] [{ $currency->name }] umgewandelt.Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.Geben Sie dort den oben genannten Gutscheincode ein.Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsvoucherplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsvoucherplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsvoucherplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsvoucherplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Gutschein-EMail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],'.PHP_EOL.PHP_EOL.'sie haben Ihr Punktekonto erfolgreich in einen Gutschein in Höhe von [{$voucher->fVoucherdiscount}] [{$currency->name}] umgewandelt.'.PHP_EOL.'Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.'.PHP_EOL.'Geben Sie dort den oben genannten Gutscheincode ein.Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.'.PHP_EOL.PHP_EOL.'Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsvouchersubjectmail oxbaseshop de'), 'd3pointsvouchersubjectmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Gutschein-EMail Betreff-Text', 'Ihr Bonuspunkte-Gutschein!', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsvouchersubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsvouchersubjectmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsvouchersubjectmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsvouchersubjectmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Gutschein-EMail Betreff-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Ihr Bonuspunkte-Gutschein!',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsautovouchersubjectmail oxbaseshop de'), 'd3pointsautovouchersubjectmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-AutoGutschein-EMail Betreff-Text', 'Ihr Bonuspunkte-Gutschein!', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsautovouchersubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsautovouchersubjectmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsautovouchersubjectmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsautovouchersubjectmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-AutoGutschein-EMail Betreff-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Ihr Bonuspunkte-Gutschein!',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsautovoucherplainmail oxbaseshop de'), 'd3pointsautovoucherplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-AutoGutschein-E-Mail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],Ihr Punktekonto wurde soeben automatisch in einen Gutschein in Höhe von [{ $voucher->fVoucherdiscount }] [{ $currency->name }] umgewandelt, da Sie den maximalen Punktestand erreicht haben.Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.Geben Sie dort den oben genannten Gutscheincode ein.Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsautovoucherplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsautovoucherplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsautovoucherplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsautovoucherplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-AutoGutschein-E-Mail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],'.PHP_EOL.PHP_EOL.'Ihr Punktekonto wurde soeben automatisch in einen Gutschein in Höhe von [{$voucher->fVoucherdiscount}] [{$currency->name}] umgewandelt, da Sie den maximalen Punktestand erreicht haben.'.PHP_EOL.'Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.Geben Sie dort den oben genannten Gutscheincode ein.Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.'.PHP_EOL.PHP_EOL.'Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsautovouchermail oxbaseshop de'), 'd3pointsautovouchermail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-AutoGutschein-E-Mail Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br><br>Ihr Punktekonto wurde soeben automatisch in einen Gutschein in Höhe von <b>[{ $voucher->fVoucherdiscount }] [{ $currency->name }]</b> umgewandelt, da Sie den maximalen Punktestand erreicht haben.<br><br><b>Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]</b><br><br>Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.<br>In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.<br>Geben Sie dort den oben genannten Gutscheincode ein.<br><br>Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.<br><br><p>Ihr  [{ $shop->oxshops__oxname->value }] Team </p>', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsautovouchermail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsautovouchermail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsautovouchermail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsautovouchermail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-AutoGutschein-E-Mail Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],<br><br>Ihr Punktekonto wurde soeben automatisch in einen Gutschein in Höhe von <b>[{$voucher->fVoucherdiscount}] [{$currency->name}]</b> umgewandelt, da Sie den maximalen Punktestand erreicht haben.<br><br><b>Ihr Gutscheincode lautet: [{$voucher->oxvouchers__oxvouchernr->value}]</b><br><br>Um Ihren Einkaufsgutschein einzulösen, legen Sie bitte wie gewohnt Ihre Artikel in unserem Shop in den Warenkorb.<br>In Schritt 1 des Bestellvorgangs finden Sie unterhalb der Artikelliste das Gutschein-Eingabefeld.<br>Geben Sie dort den oben genannten Gutscheincode ein.<br><br>Führen Sie wie gewohnt alle Bestellschritte durch. In Schritt 4 des Bestellvorgangs sehen Sie in der Zusammenfassung den abgezogenen Gutscheinwert.<br><br><p>Ihr [{$shop->oxshops__oxname->value}] Team </p>',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3reviewpointsmail oxbaseshop de'), 'd3reviewpointsmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-E-Mail-Bewertung Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br /><br />Für Ihre Bewertung des Artikels "[{$product->oxarticles__oxtitle->value}]" erhalten Sie als Dankeschön <br /><p><strong>[{$product->iNewPoints}] Punkte</strong></p>auf Ihr Bonuspunkte-Konto gutgeschrieben!<br /><br />Sie haben damit aktuell einen <strong>Punktestand von [{$product->iUserPointSum}] Punkten</strong>.<br /><br />Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].<br />Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!<br /><br />Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3reviewpointsmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3reviewpointsmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3reviewpointsmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3reviewpointsmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-E-Mail-Bewertung Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],<br /><br />Für Ihre Bewertung des Artikels "[{$product->oxarticles__oxtitle->value}]" erhalten Sie als Dankeschön <br /><p><strong>[{$product->iNewPoints}] Punkte</strong></p>auf Ihr Bonuspunkte-Konto gutgeschrieben!<br /><br />Sie haben damit aktuell einen <strong>Punktestand von [{$product->iUserPointSum}] Punkten</strong>.<br /><br />Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].<br />Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!<br /><br />Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3reviewpointsplainmail oxbaseshop de'), 'd3reviewpointsplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Bewertung-EMail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],Für Ihre Bewertung des Artikels &quot;[{$product->oxarticles__oxtitle->value}]&quot; erhalten Sie als Dankeschön [{$product->iNewPoints}] Punkte auf Ihr Bonuspunkte-Konto gutgeschrieben!Sie haben damit aktuell einen Punktestand von [{$product->iUserPointSum}] Punkten.Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].Ihren Punktestand können Sie jederzeit unter &quot;Mein Konto&quot; im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!Ihr [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3reviewpointsplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3reviewpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3reviewpointsplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3reviewpointsplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Bewertung-EMail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],'.PHP_EOL.PHP_EOL.'Für Ihre Bewertung des Artikels &quot;[{$product->oxarticles__oxtitle->value}]&quot; erhalten Sie als Dankeschön [{$product->iNewPoints}] Punkte auf Ihr Bonuspunkte-Konto gutgeschrieben!'.PHP_EOL.'Sie haben damit aktuell einen Punktestand von [{$product->iUserPointSum}] Punkten.'.PHP_EOL.'Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].Ihren Punktestand können Sie jederzeit unter &quot;Mein Konto&quot; im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!'.PHP_EOL.PHP_EOL.'Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3reviewpointssubjectmail oxbaseshop de'), 'd3reviewpointssubjectmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Bewertung-EMail Betreff-Text', 'Ihre Bonuspunkte!', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3reviewpointssubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3reviewpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3reviewpointssubjectmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3reviewpointssubjectmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Bewertung-EMail Betreff-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Ihre Bonuspunkte!',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3remindpointsmail oxbaseshop de'), 'd3remindpointsmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Erinnerungs-E-Mail Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br /><br />Sie haben aktuell einen <strong>Punktestand von [{$points}] Punkten</strong>.<br /><br />Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].<br />Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!<br /><br />Noch einmal vielen Dank für Ihren Einkauf.<br />Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3remindpointsmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3remindpointsmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3remindpointsmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3remindpointsmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Erinnerungs-E-Mail Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],<br /><br />Sie haben aktuell einen <strong>Punktestand von [{$points}] Punkten</strong>.<br /><br />Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].<br />Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!<br /><br />Noch einmal vielen Dank für Ihren Einkauf.<br />Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3remindpointsplainmail oxbaseshop de'), 'd3remindpointsplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Erinnerungs-E-Mail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],Sie haben aktuell einen Punktestand von [{$points}] Punkten.Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!Noch einmal vielen Dank für Ihren Einkauf.Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3remindpointsplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3remindpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3remindpointsplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3remindpointsplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Erinnerungs-E-Mail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],'.PHP_EOL.PHP_EOL.'Sie haben aktuell einen Punktestand von [{$points}] Punkten.Alle Details zu unserem Bonuspunkteprogramm finden Sie im Shop unter [{$shop->oxshops__oxurl->value}].'.PHP_EOL.'Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen. Dort ist auch die Auszahlung Ihrer Bonuspunkte als Bestellgutschein möglich!'.PHP_EOL.'Noch einmal vielen Dank für Ihren Einkauf.'.PHP_EOL.PHP_EOL.'Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3remindpointssubjectmail oxbaseshop de'), 'd3remindpointssubjectmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Erinnerungs-E-Mail Betreff-Text', 'Ihre Bonuspunkte!', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3remindpointssubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3remindpointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3remindpointssubjectmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3remindpointssubjectmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Erinnerungs-E-Mail Betreff-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Ihre Bonuspunkte!',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsdisablemail oxbaseshop de'), 'd3pointsdisablemail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Empfang-E-Mail abwählen', '<br><br>Möchten Sie diese Email nicht mehr erhalten, können Sie den Empfang im Kundenkonto unter <a href="[{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]">Bonuspunkte</a> abwählen.', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsdisablemail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsdisablemail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsdisablemail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsdisablemail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Empfang-E-Mail abwählen",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => '<br><br>Möchten Sie diese Email nicht mehr erhalten, können Sie den Empfang im Kundenkonto unter <a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints"}]">Bonuspunkte</a> abwählen.',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3pointsdisablemailplain oxbaseshop de'), 'd3pointsdisablemailplain', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Empfang-E-Mail abwählen Plain-Text', 'Möchten Sie diese Email nicht mehr erhalten, können Sie den Empfang im Kundenkonto unter Bonuspunkte abwählen.Link: [{ oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints" }]', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3pointsdisablemailplain()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3pointsdisablemailplain',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3pointsdisablemailplain " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3pointsdisablemailplain",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Empfang-E-Mail abwählen Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Möchten Sie diese Email nicht mehr erhalten, können Sie den Empfang im Kundenkonto unter Bonuspunkte abwählen.'.PHP_EOL.'Link: [{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=d3_d3points_accountpoints"}]',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3stornopointssubjectmail oxbaseshop de'), 'd3stornopointssubjectmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Storno-E-Mail Betreff-Text', 'Bonuspunkte wurden storniert / gelöscht', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3stornopointssubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3stornopointssubjectmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3stornopointssubjectmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3stornopointssubjectmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Storno-E-Mail Betreff-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Bonuspunkte wurden storniert / gelöscht',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3stornopointsmail oxbaseshop de'), 'd3stornopointsmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-E-Mail-Storno Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br /><br /><br>[{if $points->iOrderPoints > 0}]Die Punkte ([{$points->iOrderPoints}]) für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden storniert.[{else}]Die Punkte für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden gelöscht.[{/if}][{if $points->sOrderComment}]<br>Kommentar:    <span style="font-style:italic;">[{$points->sOrderComment}]</span>[{/if}]<br><br />Sie haben damit aktuell einen <strong>Punktestand von [{$points->iUserPointSum}] Punkten.</strong>.<br /><br>Eventuell hat dieser Vorgang weitere Auswirkungen auf Ihr Bonuspunktekonto. Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen.<br /><br />Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3stornopointsmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3stornopointsmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3stornopointsmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3stornopointsmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-E-Mail-Storno Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],<br /><br /><br>[{if $points->iOrderPoints > 0}]Die Punkte ([{$points->iOrderPoints}]) für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden storniert.[{else}]Die Punkte für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden gelöscht.[{/if}][{if $points->sOrderComment}]<br>Kommentar:<span style="font-style:italic;">[{$points->sOrderComment}]</span>[{/if}]<br><br />Sie haben damit aktuell einen <strong>Punktestand von [{$points->iUserPointSum}] Punkten.</strong>.<br /><br>Eventuell hat dieser Vorgang weitere Auswirkungen auf Ihr Bonuspunktekonto. Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen.<br /><br />Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3stornopointsplainmail oxbaseshop de'), 'd3stornopointsplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Storno-E-Mail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],[{if $points->iOrderPoints > 0}]Die Punkte ([{$points->iOrderPoints}]) für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden storniert.[{else}]Die Punkte für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden gelöscht.[{/if}][{if $points->sOrderComment}]Bemerkung: [{$points->sOrderComment}][{/if}]Sie haben damit aktuell einen Punktestand von [{$points->iUserPointSum}] Punkten. Eventuell hat dieser Vorgang weitere Auswirkungen für Ihr Bonuspunktekonto. Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen.Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3stornopointsplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3stornopointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {
//', '
                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3stornopointsplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3stornopointsplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Storno-E-Mail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],'.PHP_EOL.PHP_EOL.'[{if $points->iOrderPoints > 0}]Die Punkte ([{$points->iOrderPoints}]) für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden storniert.[{else}]Die Punkte für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden gelöscht.[{/if}]'.PHP_EOL.PHP_EOL.'[{if $points->sOrderComment}]Bemerkung: [{$points->sOrderComment}][{/if}]Sie haben damit aktuell einen Punktestand von [{$points->iUserPointSum}] Punkten. Eventuell hat dieser Vorgang weitere Auswirkungen für Ihr Bonuspunktekonto. Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen.'.PHP_EOL.PHP_EOL.'Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => false,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    ### Mails aus dem Admin heraus

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3manuelpointssubjectmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
            'oxloadid' => 'd3manuelpointssubjectmail',
            'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                'OXID'      => array(
                'content'      => "md5('d3manuelpointssubjectmail " . $sShopId . " de')",
                'force_update' => true,
                'use_quote'    => false,
                ),
                'OXLOADID'  => array(
                'content'      => "d3manuelpointssubjectmail",
                'force_update' => true,
                'use_quote'    => true,
                ),
                'OXSHOPID'  => array(
                'content'      => $sShopId,
                'force_update' => false,
                'use_quote'    => true,
                ),
                'OXSNIPPET' => array(
                'content'      => "1",
                'force_update' => false,
                'use_quote'    => false,
                ),
                'OXTYPE'    => array(
                'content'      => "0",
                'force_update' => false,
                'use_quote'    => false,
                ),
                'OXACTIVE'  => array(
                'content'       => "1",
                'force_update'  => true,
                'use_quote'     => false,
                'use_multilang' => true,
                ),
                'OXTITLE'   => array(
                'content'       => "Bonuspunkte-Manuelle-Punkte-E-Mail Betreff-Text",
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => true,
                ),
                'OXCONTENT' => array(
                'content'       => 'Neue Bonuspunkte',
                'force_update'  => false,
                'use_quote'     => true,
                'use_multilang' => false,
                ),
                'OXFOLDER'  => array(
                'content'      => "CMSFOLDER_EMAILS",
                'force_update' => true,
                'use_quote'    => true,
                )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3manuelpointsmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3manuelpointsmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {

                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3manuelpointsmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3manuelpointsmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Manuelle-Punkte-E-Mail Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}]
 [{$user->oxuser__oxlname->value}],<br>
<p>Sie haben soeben <strong>[{$points->iNewsPoints}] Bonus-Punkte</strong> erhalten.

[{if $points->sPointsComment}]<p><strong>
Kommentar: <span style="font-style: italic">[{$points->sPointsComment}]</span>
</font></p>
[{/if}]
<p>Sie haben damit aktuell einen <strong>Punktestand von [{$points->iUserPointSum}] Punkten.</strong>.
</p>

Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen.
<br /><br />Ihr [{$shop->oxshops__oxname->value}] Team',
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * REPLACE INTO `oxcontents` (`OXID`, `OXLOADID`, `OXSHOPID`, `OXSNIPPET`, `OXTYPE`, `OXACTIVE`, `OXPOSITION`, `OXTITLE`, `OXCONTENT`, `OXFOLDER`) VALUES(md5('d3stornopointsplainmail oxbaseshop de'), 'd3stornopointsplainmail', 'oxbaseshop', 1, 0, 1, '', 'Bonuspunkte-Storno-E-Mail Plain-Text', 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal  }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],[{if $points->iOrderPoints > 0}]Die Punkte ([{$points->iOrderPoints}]) für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden storniert.[{else}]Die Punkte für Ihrer Bestellung [{$order->oxorder__oxordernr->value}] wurden gelöscht.[{/if}][{if $points->sOrderComment}]Bemerkung: [{$points->sOrderComment}][{/if}]Sie haben damit aktuell einen Punktestand von [{$points->iUserPointSum}] Punkten. Eventuell hat dieser Vorgang weitere Auswirkungen für Ihr Bonuspunktekonto. Ihren Punktestand können Sie jederzeit unter "Mein Konto" im Shop einsehen.Ihr  [{ $shop->oxshops__oxname->value }] Team', 'CMSFOLDER_EMAILS');
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function _d3manuelpointsplainmail()
    {
        $blRet = false;

        foreach (Registry::getConfig()->getShopIds() as $sShopId) {

            $aWhere = array(
                'oxloadid' => 'd3manuelpointsplainmail',
                'oxshopid' => $sShopId,
            );
            $blNotExist = $this->_checkInsertContents($aWhere);

            if ($blNotExist) {
                $aInsertFields = array(
                    'OXID'      => array(
                        'content'      => "md5('d3manuelpointsplainmail " . $sShopId . " de')",
                        'force_update' => true,
                        'use_quote'    => false,
                    ),
                    'OXLOADID'  => array(
                        'content'      => "d3manuelpointsplainmail",
                        'force_update' => true,
                        'use_quote'    => true,
                    ),
                    'OXSHOPID'  => array(
                        'content'      => $sShopId,
                        'force_update' => false,
                        'use_quote'    => true,
                    ),
                    'OXSNIPPET' => array(
                        'content'      => "1",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXTYPE'    => array(
                        'content'      => "0",
                        'force_update' => false,
                        'use_quote'    => false,
                    ),
                    'OXACTIVE'  => array(
                        'content'       => "1",
                        'force_update'  => true,
                        'use_quote'     => false,
                        'use_multilang' => true,
                    ),
                    'OXTITLE'   => array(
                        'content'       => "Bonuspunkte-Manuelle-Punkte-E-Mail Plain-Text",
                        'force_update'  => false,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXCONTENT' => array(
                        'content'       => "Guten Tag [{\$user->oxuser__oxsal->value|oxmultilangsal}] [{\$user->oxuser__oxfname->value}]
 [{\$user->oxuser__oxlname->value}],

Sie haben soeben [{\$points->iNewsPoints}] Bonus-Punkte erhalten.".PHP_EOL."
[{if \$points->sPointsComment}]Kommentar:  [{\$points->sPointsComment}][{/if}]

Sie haben damit aktuell einen Punktestand von [{\$points->iUserPointSum}] Punkten.
".PHP_EOL.PHP_EOL."
Ihren Punktestand können Sie jederzeit unter 'Mein Konto' im Shop einsehen.
".PHP_EOL.PHP_EOL."
Ihr [{\$shop->oxshops__oxname->value}] Team
",
                        'force_update'  => true,
                        'use_quote'     => true,
                        'use_multilang' => true,
                    ),
                    'OXFOLDER'  => array(
                        'content'      => "CMSFOLDER_EMAILS",
                        'force_update' => true,
                        'use_quote'    => true,
                    )
                );

                if (method_exists($this, '_updateTableItem2'))
                {
                    $this->setInitialExecMethod(__METHOD__);
                    $blRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                } else {  // bc
                    $aRet  = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $blRet = $aRet['blRet'];
                    $this->setUpdateBreak(false);
                }
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function CheckForOxBaseShopIdPointsTable()
    {
        $blRet = FALSE;
        $sSql = "SELECT COUNT(*) FROM d3points where oxshopid = 'oxbaseshop'";

        if ($this->getDb()->getOne($sSql) > 0 ) {
            $blRet = TRUE;
        }
        return $blRet;
    }

    /**
     * @return int
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function ReplaceOxBaseShopIdPointsTable()
    {
        $sUpdate[] = "UPDATE d3points SET oxshopid ='1' WHERE 1";
        return $this->_executeMultipleQueries($sUpdate);


    }
}