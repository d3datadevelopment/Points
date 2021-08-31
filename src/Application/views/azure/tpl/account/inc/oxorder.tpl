[{* Bestellung *}]
[{block name="d3accountpoints_list_with_points_oxorder"}]

[{assign var="oOrder" value=$oPoint->d3GetOrder()}]
<tr>
    <td class="column first[{$RowStyle}]"><label>
            [{oxmultilang ident="D3_ACCOUNT_POINTS_ORDERTYPE"}] [{$oOrder->oxorder__oxordernr->value}]
            [{if $oPoint->d3points__d3points->value < 0}][{oxmultilang ident="D3_ACCOUNT_POINTS_POINTS_STORNO"}][{/if}]
        </label></td>
    <td class="column second[{$RowStyle}]">
        <label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</label></td>
    <td class="column third[{$RowStyle}]"><label>&nbsp;&nbsp;
            [{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</label></td>
    <td class="column fourth[{$RowStyle}]"><label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtext->value}]</label></td>
</tr>
[{/block}]