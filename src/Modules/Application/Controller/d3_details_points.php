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
 * @version       3.0.1_XE4
 * @author        Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see           http://www.shopmodule.com
 *                $Rev::                                               $:
 *                $Author::                                            $:
 *                $Date::                                              $:
 */

namespace D3\Points\Modules\Application\Controller;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Application\Model\Rating;
use OxidEsales\Eshop\Application\Controller\ArticleDetailsController;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Exception\SystemComponentException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Points\Application\Model\d3points;
use D3\Points\Application\Model\d3rating;

/**
 * Class d3_details_Points
 *
 * @package D3\Points\Modules\Application\Controller
 */
class d3_details_Points extends d3_details_points_parent
{
    private $_sModId = 'd3points';

    /**
     * Extends save-methode
     * Bewertung einzeln für Rating und Text
     * Option: if user can get points for more reviews for on article
     *
     * @return null|void
     * @throws d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws SystemComponentException
     * @throws d3_cfg_mod_exception
     */
    public function saveReview()
    {
        //Modul ist aktiv
        if ($this->getModCfg()->isActive()) {
            $this->getD3Log()->Log(
            d3log::DEBUG,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "start check review points",
            "cl=details"
            );

            /* @var $oD3Rating d3rating */
            $oD3Rating = oxnew(d3rating::class);
            $this->getD3Log()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "start check review points",
            "cl=details"
            );

            if ($this->canAcceptFormData() && ($oUser = $this->getUser()) && ($oProduct = $this->getProduct())
            ) {
                $dRating = Registry::get(Request::class)->getRequestEscapedParameter('artrating');
                if ($dRating !== null) {
                    $dRating = (int)$dRating;
                }
                $oD3Rating->d3SetUser($oUser->getId());
                $oD3Rating->d3SetArticleId($oProduct->getId());

                if ($dRating !== null && $dRating >= 0 && $dRating <= 5) {
                    /** @var $oRating Rating */
                    $oRating = oxNew(Rating::class);
                    if ($oRating->allowRating($oUser->getId(), 'oxarticle', $oProduct->getId())) {
                        $oD3Rating->d3SetPointsForRating();
                    }
                }
                if ($sReviewText = trim((string)Registry::get(Request::class)->getRequestEscapedParameter('rvw_txt', true))) {
                    $oD3Rating->d3SetPointsForReview();
                }
                $oD3Rating->d3SendReviewMail();
            }
            $this->getD3Log()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "end check review points",
            "cl=details"
            );
        }

        parent::saveReview();
    }

    /**
     * @return object
     * @throws \Doctrine\DBAL\DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getModCfg()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return d3log
     * @throws \Doctrine\DBAL\DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getD3Log()
    {
        return $this->getModCfg()->d3getLog();
    }
}