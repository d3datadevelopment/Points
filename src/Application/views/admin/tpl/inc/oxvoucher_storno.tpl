[{* Gutschein storniert *}]
[{block name="d3points_userpoints_left_content_points_table_oxvoucher_storno"}]

[{assign var="oVoucher" value=$listitem->d3GetVoucher()}]
<tr>
    [{assign var="listclass" value=listitem$blWhite }]
    <td valign="top" class="[{ $listclass}]">[{ oxmultilang ident="D3_USER_POINTS_VOUCHERTYPE" }] [{ $oVoucher->oxvouchers__oxvouchernr->value }]</td>
    <td valign="top" class="[{ $listclass}]" height="15" align="center">[{if $listitem->d3points__d3points->value > 0}]+[{/if}][{ $listitem->d3points__d3points->value }]</td>
    <td valign="top" class="[{ $listclass}]"><label>&nbsp;&nbsp;[{$listitem->d3points__oxtime->value|date_format:"%d.%m.%Y %H:%M:%S"}]</label></td>
    <td valign="top" class="[{ $listclass}]"><label>&nbsp;&nbsp;[{ oxmultilang ident="D3_USER_POINTS_POINTS_STORNO2" }][{* $oVoucher->oxvouchers__oxvouchernr->value *}]
        </label>
    </td>
</tr>
[{/block}]