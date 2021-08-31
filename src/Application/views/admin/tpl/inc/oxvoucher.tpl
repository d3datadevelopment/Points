[{* Gutschein *}]
[{block name="d3points_userpoints_left_content_points_table_oxvoucher"}]

[{assign var="oVoucher" value=$listitem->d3GetVoucher()}]
<tr>
    [{assign var="listclass" value=listitem$blWhite }]
    <td valign="top" class="[{ $listclass}]">[{ oxmultilang ident="D3_USER_POINTS_VOUCHERTYPE" }] [{ $oVoucher->oxvouchers__oxvouchernr->value }]</td>
    <td valign="top" class="[{ $listclass}]" height="15" align="center">[{if $listitem->d3points__d3points->value > 0}]+[{/if}][{ $listitem->d3points__d3points->value }]</td>
    <td valign="top" class="[{ $listclass}]"><label>&nbsp;&nbsp;[{$listitem->d3points__oxtime->value|date_format:"%d.%m.%Y %H:%M:%S"}]</label></td>
    <td valign="top" class="[{ $listclass}]"><label>&nbsp;&nbsp;
            [{$oPoint->d3points__oxtext->rawValue}][{if $oVoucher->discount }][{ oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_VALUE" }] [{ $oVoucher->discount }] [{ $currency->sign}][{/if}]
            [{if $oVoucher->oxvouchers__oxdateused->rawValue =='0000-00-00' && $oVoucher->oxvouchers__oxreserved->rawValue > 0}]
                <br>&nbsp;&nbsp;[{ oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_RESERVED" }] [{$oVoucher->oxvouchers__oxreserved->rawValue|date_format:"%d.%m.%Y %H:%M:%S"}][{/if}]
            [{if $oVoucher->oxvouchers__oxdateused->rawValue !='0000-00-00'}]
                <br>&nbsp;&nbsp;[{ oxmultilang ident="D3_ACCOUNT_POINTS_VOUCHER_USED" }] [{$oVoucher->oxvouchers__oxdateused->rawValue|date_format:"%d.%m.%Y %H:%M:%S"}][{/if}]
        </label></td>
</tr>
[{/block}]