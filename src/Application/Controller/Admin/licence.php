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
 */

namespace D3\Points\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_licence;

/**
 * Class licence
 *
 * @package D3\Points\Application\Controller\Admin
 */
class licence extends d3_cfg_mod_licence
{
    protected $_sModId = 'd3points';
    protected $_hasLicence = true;
    protected $_hasNewsletterForm = false;
    //protected $_hasUpdate = true;
    //protected $_modUseCurl = false;
    protected $_sMenuItemTitle = 'd3mxd3points';
    protected $_sMenuSubItemTitle = 'd3mxd3points_SUPPORT';
    protected $_sHelpLinkMLAdd = 'D3_CFG_MOD_d3points_HELPLINK_SUPPORT';
    protected $_sBlogFeed = "https://blog.oxidmodule.com/feeds/categories/6-Bonuspunkte.rss";
    protected $_sLogType = 2;
}
