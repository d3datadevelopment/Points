<?php

/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package       "Bonuspunkte"
 * @author        Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2013, D3 Data Development
 * @see           http://www.shopmodule.com
 */

namespace D3\Points\Modules\Core;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Application\Model\Remark;
use OxidEsales\Eshop\Application\Model\Basket;
use OxidEsales\Eshop\Application\Model\Payment;
use OxidEsales\Eshop\Application\Model\Content;
use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Application\Model\VoucherSerie;
use OxidEsales\Eshop\Application\Model\Voucher;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Application\Model\Article;
use D3\Points\Application\Model\d3points;

/**
 * Class d3_oxemail_points
 *
 * @package D3\Points\Modules\Application\Core
 */
class d3_oxemail_points extends d3_oxemail_points_parent
{
    /**
     * Email-Templats for automatic Payout
     *
     * @var string
     */
    protected $_sd3_email_pointsautovoucher_html_tpl = 'd3_email_pointsautovoucher_html.tpl';

    protected $_sd3_email_pointsautovoucher_plain_tpl = 'd3_email_pointsautovoucher_plain.tpl';

    protected $_sd3_email_pointsautovoucher_subj_tpl = 'd3_email_pointsautovoucher_subj.tpl';

    /**
     * Email-Templates for mail with points from Order
     *
     * @var string
     */
    protected $_sd3_email_d3_email_orderpoints_html_tpl = 'd3_email_orderpoints_html.tpl';

    protected $_sd3_email_d3_email_orderpoints_plain_tpl = 'd3_email_orderpoints_plain.tpl';

    protected $_sd3_email_d3_email_orderpoints_subj_tpl = 'd3_email_orderpoints_subj.tpl';

    /**
     * Email-Templates for Reminder
     *
     * @var String
     */
    protected $_sd3_email_remindpoints_html_tpl = 'd3_email_remindpoints_html.tpl';

    protected $_sd3_email_remindpoints_plain_tpl = 'd3_email_remindpoints_plain.tpl';

    protected $_sd3_email_remindpoints_subj_tpl = 'd3_email_remindpoints_subj.tpl';

    /**
     * Email-Template for new Voucher, if is created
     *
     * @var String
     */
    protected $_sd3_email_pointsvoucher_html_tpl = 'd3_email_pointsvoucher_html.tpl';

    protected $_sd3_email_pointsvoucher_plain_tpl = 'd3_email_pointsvoucher_plain.tpl';

    protected $_sd3_email_pointsvoucher_subj_tpl = 'd3_email_pointsvoucher_subj.tpl';

    /**
     * Email Templates for new Points at Review or Rating
     *
     * @var String
     */
    protected $_sd3_email_reviewpoints_html_tpl = 'd3_email_reviewpoints_html.tpl';

    protected $_sd3_email_reviewpoints_plain_tpl = 'd3_email_reviewpoints_plain.tpl';

    protected $_sd3_email_reviewpoints_subj_tpl = 'd3_email_reviewpoints_subj.tpl';

    /**
     * Email Templates for storno points
     *
     * @var String
     */
    protected $_sd3_email_stornopoints_html_tpl = 'd3_email_stornopoints_html.tpl';

    protected $_sd3_email_stornopoints_plain_tpl = 'd3_email_stornopoints_plain.tpl';

    protected $_sd3_email_stornopoints_subj_tpl = 'd3_email_stornopoints_subj.tpl';

    /**
     * Email Templates for manuel points from admin
     *
     * @var string
     */
    protected $_sd3_email_manuelpoints_html_tpl = 'd3_email_manuelpoints_html.tpl';

    protected $_sd3_email_manuelpoints_plain_tpl = 'd3_email_manuelpoints_plain.tpl';

    protected $_sd3_email_manuelpoints_subj_tpl = 'd3_email_manuelpoints_subj.tpl';

    private $_sModId = 'd3points';

    /**
     * Mail with VoucherCode
     * after voucher is created by user
     * write Remark
     *
     * @param User      $oUser
     * @param Voucher   $oVoucher
     * @param           $iLang      integer
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\EshopCommunity\Application\Model\oxObjectException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    public function d3SendPointsVoucherMail(User $oUser, Voucher $oVoucher, $iLang = 0)
    {
        //sets language of shop
        $iCurrLang = $iLang;

        // shop info
        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);

        $this->setUser($oUser);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();
        $this->setViewData("user", $oUser);
        $this->setViewData("voucher", $oVoucher);
        $this->setViewData("voucherserie", $oVoucher->getSerie());

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $sTemplate = $this->_sd3_email_pointsvoucher_html_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_pointsvoucher_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_pointsvoucher_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        //TestModus
        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAddress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAddress = $oUser->getFieldData('oxusername');
        }

        $sFullName = $oUser->getFieldData('oxfname') . " " . $oUser->getFieldData('oxlname');

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();
        // add user history
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $blSend;
    }

    /**
     * Send ReminderMails
     * automatic by cronjob, write Remark
     *
     * @param User   $oUser
     * @param        $iLang  integer
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    public function d3SendRemindPointsMail(User $oUser, $iLang = 0)
    {
        $blSend = false;

        //sets language of shop
        $iCurrLang = $iLang;

        // shop info
        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);

        $this->setUser($oUser);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();
        $this->setViewData("user", $oUser);
        $this->setViewData("points", $oUser->iUserPointSum);

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $sTemplate = $this->_sd3_email_remindpoints_html_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_remindpoints_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_remindpoints_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        //TestModus
        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAddress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAddress = $oUser->getFieldData('oxusername');
        }

        $sFullName = $oUser->getFieldData('oxfname') . " " . $oUser->getFieldData('oxlname');

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();

        // add user history
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $blSend;
    }

    /**
     * Mail with points, first mail
     * write Remark
     *
     * @param $oOrder
     * @param                     $iLang integer
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    function d3SendPointsCreatedMail($oOrder, $iLang = 0)
    {
        //sets language of shop
        $iCurrLang = $iLang;

        // shop info
        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);

        #$oUser = $oOrder->getOrderUser();
        $oUser = $oOrder->d3getOrderUser();
        $this->setUser($oUser);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();
        $this->setViewData("order", $oOrder);
        #$this->setViewData( "point", $oPoint);
        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $sTemplate = $this->_sd3_email_d3_email_orderpoints_html_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_d3_email_orderpoints_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_d3_email_orderpoints_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        //TestModus
        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAddress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAddress = $oOrder->getFieldData('oxbillemail');
        }

        $sFullName = $oOrder->getFieldData('oxbillfname') . " " . $oOrder->getFieldData('oxbilllname');

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();
        // add user history
        $this->d3WriteRemark($this->getAltBody(), $oOrder->getOrderUser()->getId(), "r");

        return $blSend;
    }

    /**
     * Send Mail with Points for Rating or Review
     * write Remark
     *
     * @param Article $oProduct
     * @param User    $oUser user object
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    function d3SendPointsForReviewMail(Article $oProduct, User $oUser)
    {
        $blSend = false;

        //sets language of shop
        $iLang     = Registry::get(Config::class)->getActiveShop()->getLanguage();
        $iCurrLang = $iLang;

        // shop info
        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);

        $this->setUser($oUser);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();
        $this->setViewData("user", $oUser);
        $this->setViewData("product", $oProduct);

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $sTemplate = $this->_sd3_email_reviewpoints_html_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_reviewpoints_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_reviewpoints_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        //TestModus
        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAddress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAddress = $oUser->getFieldData('oxusername');
        }

        $sFullName = $oUser->getFieldData('oxfname') . " " . $oUser->getFieldData('oxlname');

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();

        // add to user history
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $blSend;
    }

    /**
     * Mail for automatic created Voucher
     * write Remark
     *
     * @param User    $oUser
     * @param Voucher $oVoucher
     * @param           integer
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\EshopCommunity\Application\Model\oxObjectException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    public function d3SendPointsAutoVoucherMail(User $oUser, Voucher $oVoucher, $iLang = 0)
    {
        //sets language of shop
        $iCurrLang = $iLang;
        //TODO Sprache testen
        // shop info
        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);

        $this->setUser($oUser);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();
        $this->setViewData("user", $oUser);
        $this->setViewData("voucher", $oVoucher);
        $this->setViewData("voucherserie", $oVoucher->getSerie());

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $sTemplate = $this->_sd3_email_pointsautovoucher_html_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_pointsautovoucher_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_pointsautovoucher_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        //TestModus
        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAddress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAddress = $oUser->getFieldData('oxusername');
        }

        $sFullName = $oUser->getFieldData('oxfname') . " " . $oUser->getFieldData('oxlname');

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();

        // add to user history
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $blSend;
    }

    /**
     * Send Mail to user after Points are canceled
     * write mail into history
     * $oPoint->sOrderComment
     * $oPoint->iOrderPoints
     * $oPoint->iUserPointSum
     *
     * @param d3_oxorder_d3points $oOrder
     * @param d3points            $oPoint
     * @param integer             $iLang
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    public function d3SendStornoMail(d3_oxorder_d3points $oOrder, d3points $oPoint, $iLang = 0)
    {
        //sets language of shop
        $iCurrLang = $iLang;

        // shop info
        $oShop = $this->_getShop($iCurrLang);
        //TODO Sprache testen

        #$oUser = $oOrder->getOrderUser();
        $oUser = $oOrder->d3getOrderUser();

        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();

        $this->setUser($oUser);
        $this->setViewData("order", $oOrder);
        $this->setViewData("points", $oPoint);

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        //create messages
        $oLang = Registry::getLang();

        // dodger #1469 - we need to patch security here as we do not use standard template dir, so smarty stops working
        $aStore['INCLUDE_ANY'] = $oSmarty->security_settings['INCLUDE_ANY'];
        //V send email in order language
        $iOldTplLang  = $oLang->getTplLanguage();
        $iOldBaseLang = $oLang->getTplLanguage();
        $oLang->setTplLanguage($iCurrLang);
        $oLang->setBaseLanguage($iCurrLang);

        $oSmarty->security_settings['INCLUDE_ANY'] = true;
        Registry::get(Config::class)->setAdminMode(false);

        $sTemplate = $this->_sd3_email_stornopoints_html_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_stornopoints_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $sTemplate = $this->_sd3_email_stornopoints_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        Registry::get(Config::class)->setAdminMode(true);
        $oLang->setTplLanguage($iOldTplLang);
        $oLang->setBaseLanguage($iOldBaseLang);
        // set it back
        $oSmarty->security_settings['INCLUDE_ANY'] = $aStore['INCLUDE_ANY'];

        //TestModus
        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAddress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAddress = $oUser->getFieldData('oxusername');
        }

        $sFullName = $oUser->getFieldData('oxfname') . " " . $oUser->getFieldData('oxlname');

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();

        // add to user history
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $blSend;
    }

    /**
     * @param User     $oUser
     * @param d3points $oPoint
     * @param int      $iLang
     *
     * @return bool
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Exception
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \d3\points\Application\Model\Exception
     * @throws d3_cfg_mod_exception
     */
    public function d3SendMailForManuelPoints(User $oUser, d3points $oPoint, $iLang = 0)
    {
        $myConfig = Registry::get(Config::class);
        //sets language of shop
        $iCurrLang = $iLang;

        $oShop = $this->_getShop();

        $this->_setMailParams($oShop);
        // create messages
        /** @var \smarty $oSmarty */
        $oSmarty = $this->_getSmarty();

        $this->setUser($oUser);
        $this->setViewData("points", $oPoint);

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        //create messages
        $oLang = Registry::getLang();

        // dodger #1469 - we need to patch security here as we do not use standard template dir, so smarty stops working
        $aStore['INCLUDE_ANY'] = $oSmarty->security_settings['INCLUDE_ANY'];
        //V send email in order language
        $iOldTplLang  = $oLang->getTplLanguage();
        $iOldBaseLang = $oLang->getTplLanguage();

        $oLang->setTplLanguage($iCurrLang);
        $oLang->setBaseLanguage($iCurrLang);

        $oSmarty->security_settings['INCLUDE_ANY'] = true;
        $myConfig->setAdminMode(false);

        // template paths are registered in metadata
        $sTemplate = $this->_sd3_email_manuelpoints_html_tpl;

        if ($oSmarty->template_exists($sTemplate)) {
            $this->setBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        // template paths are registered in metadata
        $sTemplate = $this->_sd3_email_manuelpoints_plain_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setAltBody($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        // template paths are registered in metadata
        $sTemplate = $this->_sd3_email_manuelpoints_subj_tpl;
        if ($oSmarty->template_exists($sTemplate)) {
            $this->setSubject($oSmarty->fetch($sTemplate));
        } else {
            $this->d3WriteMessageIfTemplateNotExist($sTemplate, __CLASS__, __FUNCTION__, __LINE__);
        }

        $myConfig->setAdminMode(true);
        $oLang->setTplLanguage($iOldTplLang);
        $oLang->setBaseLanguage($iOldBaseLang);
        // set it back
        $oSmarty->security_settings['INCLUDE_ANY'] = $aStore['INCLUDE_ANY'];

        if ($this->getModCfg()->hasTestMode()) {
            $sEMailAdress = $this->d3GetEMAILSTEST();
        } else {
            $sEMailAdress = $oUser->getFieldData('oxusername');
        }

        $sFullName = $oUser->getFieldData('oxfname') . " " . $oUser->getFieldData('oxlname');

        $this->setRecipient($sEMailAdress, $sFullName);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        if ($this->d3GetEMAILSBCC()) {
            $this->AddBCC($this->d3GetEMAILSBCC());
        }

        $blSend = $this->send();

        // add to user history
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");
        return $blSend;
    }

    /**
     * Write to d3log, display message if debug is set
     *
     * @param string $sTemplate
     * @param string $sClass
     * @param string $sFunction
     * @param string $sLine
     *
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function d3WriteMessageIfTemplateNotExist($sTemplate, $sClass, $sFunction, $sLine)
    {
        $this->getModCfg()->d3getLog()->Log(
        d3log::EMERGENCY,
        $sClass,
        $sFunction,
        $sLine,
        "Template: " . $sTemplate . " not found"
        );
        if ($this->getModCfg()->hasDebugMode()) {
            echo "Template: " . $sTemplate . " not found";
        }
    }

    /**
     * @deprecated since v4.1.1.1, remove in oxid v6
     *
     * @param $sTemplate
     * @param $sClass
     * @param $sFunction
     * @param $sLine
     *
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function d3WriteMesssageIfTemplateNotExist($sTemplate, $sClass, $sFunction, $sLine)
    {
        $this->d3WriteMessageIfTemplateNotExist($sTemplate, $sClass, $sFunction, $sLine);
    }

    /**
     * Create Remarkt
     *
     * @param String $sMessage
     * @param String $sUserId
     * @param String $sType
     *
     * @return bool
     * @throws \d3\points\Application\Model\Exception
     * @throws \Exception
     */
    public function d3WriteRemark($sMessage, $sUserId, $sType = 'r')
    {
        /* @var $od3points d3points */
        $od3points = oxnew(d3points::class);

        return $od3points->d3WriteRemark($sMessage, $sUserId, $sType);
    }

    /**
     * Get Mail for Test-Modus
     *
     * @return string
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function d3GetEMAILSTEST()
    {
        if ($this->getModCfg()->getValue('d3points_EMAILS_TEST') != '') {
            return $this->getModCfg()->getValue('d3points_EMAILS_TEST');
        }

        $sMessage = 'Testmodus is active, but no mailaddress ist set. Us instead Infomailaddress.';
        $this->getModCfg()->d3getLog()->Log(
        d3log::WARNING,
        __CLASS__,
        __FUNCTION__,
        __LINE__,
        'Testmodus, but not Mailaddress',
        $sMessage
        );

        if ($this->getModCfg()->hasDebugMode()) {
            echo $sMessage - PHP_EOL;
        }

        $oShop = $this->_getShop();

        return $oShop->oxshops__oxinfoemail->value;
    }

    /**
     * Return BCC-Mail
     *
     * @return string
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetEMAILSBCC()
    {
        return $this->getModCfg()->getValue('d3points_EMAILS_BCC');
    }

    /**
     * @return d3_cfg_mod
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getModCfg()
    {
        return d3_cfg_mod::get($this->_sModId);
    }
}
