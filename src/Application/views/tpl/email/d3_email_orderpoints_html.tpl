[{ assign var="shop"     value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="user"     value=$oEmailView->getUser() }]
[{ assign var="currency" value=$oEmailView->getCurrency() }]

[{oxcontent ident="d3newpointssubjectmail" assign="header_sub"}]
[{include file="email/html/header.tpl" title=$shop->oxshops__oxname->value|cat:" - "|cat:$header_sub}] 
    <br><br>
	[{oxcontent ident="d3newpointsmail"}]
	<br>
	<br>
	[{oxcontent ident="d3pointsdisablemail"}]
	<br>
	<br>	
[{include file="email/html/footer.tpl"}]
