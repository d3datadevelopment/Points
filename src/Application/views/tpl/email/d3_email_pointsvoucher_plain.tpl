[{ assign var="shop"     value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="user"     value=$oEmailView->getUser() }]
[{ assign var="currency" value=$oEmailView->getCurrency() }]

[{ oxcontent ident="d3pointsvoucherplainmail" }]

[{oxcontent ident="d3pointsdisablemailplain"}]	

[{ oxcontent ident="oxemailfooterplain" }]
