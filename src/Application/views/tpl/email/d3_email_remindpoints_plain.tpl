[{ assign var="shop"     value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="user"     value=$oEmailView->getUser() }]

[{oxcontent ident="d3remindpointsplainmail"}]

[{oxcontent ident="d3pointsdisablemailplain"}]

[{oxcontent ident="oxemailfooterplain"}]