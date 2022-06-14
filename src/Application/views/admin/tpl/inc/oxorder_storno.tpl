[{* Bestellung storniert *}]
[{block name="d3points_userpoints_left_content_points_table_oxorder_storno"}]

[{assign var="oOrder" value=$listitem->d3GetOrder()}]
<tr>
    [{assign var="listclass" value=listitem$blWhite }]
    <td valign="top" class="[{ $listclass}]"><a href="Javascript:EditThisOrder('[{ $oOrder->oxorder__oxid->value}]');" class="[{ $listclass}]">[{ oxmultilang ident="D3_USER_POINTS_ORDERTYPE" }] [{ $oOrder->oxorder__oxordernr->value }] [{ oxmultilang ident="D3_USER_POINTS_POINTS_STORNO" }]</a></td>
    <td valign="top" class="[{ $listclass}]" height="15" align="center">[{if $listitem->d3points__d3points->value > 0}]+[{/if}][{ $listitem->d3points__d3points->value }]</td>
    <td valign="top" class="[{ $listclass}]"><label>&nbsp;&nbsp;[{$listitem->d3points__oxtime->value|date_format:"%d.%m.%Y %H:%M:%S"}]</label></td>
    <td valign="top" class="[{ $listclass}]"><label>&nbsp;&nbsp;[{$listitem->d3points__oxtext->rawValue}]</label></td>
</tr>
[{/block}]