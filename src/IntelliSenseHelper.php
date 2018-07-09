<?php

namespace  D3\Points\Modules\Application\Controller\Admin
{

    use OxidEsales\Eshop\Application\Controller\Admin\OrderMain;

    class d3_ordermain_d3points_parent extends OrderMain {}
}

namespace  D3\Points\Modules\Application\Controller
{

    use OxidEsales\Eshop\Application\Controller\AccountController;
    use OxidEsales\Eshop\Application\Controller\ArticleDetailsController;
    use OxidEsales\Eshop\Application\Controller\ReviewController;

    class d3_account_points_parent extends AccountController {}
    class d3_review_points_parent extends ReviewController {}
    class d3_details_points_parent extends ArticleDetailsController {}
}



namespace D3\Points\Modules\Core
{

    use OxidEsales\Eshop\Core\Email;
    use OxidEsales\Eshop\Core\ViewConfig;

    class d3_oxemail_points_parent extends Email{}
    class d3_oxviewconfig_points_parent extends ViewConfig{}
}


namespace D3\Points\Modules\Application\Model
{

    use OxidEsales\Eshop\Application\Model\Order;
    use OxidEsales\Eshop\Application\Model\User;
    use OxidEsales\Eshop\Application\Model\Voucher;

    class d3_oxuser_points_parent extends User{}
    class d3_oxorder_d3points_parent extends Order{}
    class d3_oxvoucher_points_parent extends Voucher{}
}

