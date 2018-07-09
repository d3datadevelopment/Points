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
 * @version 3.0.0_PE4
 * @author Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see http://www.shopmodule.com
 *
 * $Rev::                                               $:
 * $Author::                                            $:
 * $Date::                                              $:
 */

namespace D3\Points\Modules\Application\Controller\Admin;

use D3\Points\Application\Model\d3points;

/**
 * Class d3_ordermain_d3points
 *
 * @package D3\Points\Modules\Application\Controller\Admin
 */
class d3_ordermain_d3points extends d3_ordermain_d3points_parent
{
    /**
     * Return Points for Order by given Order-Id
     *
     * @return object
     * @throws \OxidEsales\Eshop\Core\Exception\SystemComponentException
     */
    public function d3GetPointsForOrder()
    {
        $sOrderId = $this->getEditObjectId();

        if (!$sOrderId) {
            return NULL;
        }

        //if (class_exists('d3points')) {
            /* @var $od3Points d3points */
            $od3Points = oxnew(d3points::class);
            return $od3Points->d3GetPointsForOrder($sOrderId);
        //}
        //return NULL;
    }
}