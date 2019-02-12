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
#ini_set('display_errors', 1);
#ini_set('error_reporting', 1);

namespace D3\Points\Modules\Application\Controller;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Application\Controller\ReviewController;
use D3\Points\Application\Model\d3points;
use D3\Points\Application\Model\d3rating;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

/**
 * Class d3_review_points
 *
 * @package D3\Points\Modules\Application\Controller
 */
class d3_review_points extends d3_review_points_parent
{
    private $_sModId = 'd3points';

    /**
     * Extends save-methode
     * Bewertung einzeln für Rating und Text
     * Option if user can get points for more reviews for on article
     *
     * @return void
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
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
            "cl=review"
            );

            /* @var $oD3Rating d3rating */
            $oD3Rating = oxnew(d3rating::class);

            $this->getD3Log()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "start check review points",
            "cl=review"
            );

            if (($oRevUser = $this->getReviewUser()) && $this->canAcceptFormData()) {
                if (($oActObject = $this->_getActiveObject()) && ($sType = $this->_getActiveType())) {
                    if (($dRating = Registry::get(Request::class)->getRequestEscapedParameter('rating')) === null) {
                        $dRating = Registry::get(Request::class)->getRequestEscapedParameter('artrating');
                    }

                    if ($dRating !== null) {
                        $dRating = (int)$dRating;
                    }

                    $oD3Rating->d3SetUser($oRevUser->getId());
                    $oD3Rating->d3SetArticleId($oActObject->getId());

                    // Pruefung auf Sternebewertung
                    if ($dRating !== null && $dRating >= 0 && $dRating <= 5) {

                        $oD3Rating->d3SetPointsForRating();
                    }
                    // Pruefung auf Textbewertung

                    if ($sReviewText = trim((string)Registry::get(Request::class)->getRequestEscapedParameter('rvw_txt', true))) {

                        $oD3Rating->d3SetPointsForReview();
                    }
                }
            }
            $oD3Rating->d3SendReviewMail();
            $this->getD3Log()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "end check review points",
            "cl=review"
            );
        }

        parent::saveReview();
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
