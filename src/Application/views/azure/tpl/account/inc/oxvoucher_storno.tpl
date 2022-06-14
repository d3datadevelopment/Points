[{* Gutschein storniert *}]
[{block name="d3accountpoints_list_with_points_oxvoucher_storno"}]

[{assign var="oVoucher" value=$oPoint->d3GetVoucher()}]
<tr>
    <td class="column first[{$RowStyle}]"><label>[{oxmultilang
            ident="D3_ACCOUNT_POINTS_VOUCHERTYPE"}] <span style="font-style:italic">[{$oVoucher->oxvouchers__oxvouchernr->value}]</span></label>
    </td>
    <td class="column second[{$RowStyle}]"><label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</label></td>
    <td class="column third[{$RowStyle}]"><label>&nbsp;&nbsp;
            [{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</label></td>
    <td class="column fourth[{$RowStyle}]"><label>&nbsp;&nbsp;[{
            oxmultilang ident="D3_ACCOUNT_POINTS_POINTS_STORNO2"}]
            [{* $oVoucher->oxvouchers__oxvouchernr->value *}]</label></td>
</tr>
[{/block}]