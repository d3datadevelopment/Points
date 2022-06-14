[{ assign var="shop"      value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="user"      value=$oEmailView->getUser() }]

[{oxcontent ident="d3reviewpointssubjectmail" assign="header_sub"}]
[{include file="email/html/header.tpl" title=$shop->oxshops__oxname->value|cat:" - "|cat:$header_sub}] 
    [{oxcontent ident="d3stornopointsmail"}]
    <br>
    <br>    
    [{oxcontent ident="oxemailfooterplain"}]
  </body>
</html>
