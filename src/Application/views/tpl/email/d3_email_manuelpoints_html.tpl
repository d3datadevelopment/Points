[{ assign var="shop"      value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="user"      value=$oEmailView->getUser() }]

[{oxcontent ident="d3manuelpointssubjectmail" assign="header_sub"}]
[{include file="email/html/header.tpl" title=$shop->oxshops__oxname->value|cat:" - "|cat:$header_sub}]
    <br><br>
    [{oxcontent ident="d3manuelpointsmail"}]
    <br>
    <br>
[{include file="email/html/footer.tpl"}]