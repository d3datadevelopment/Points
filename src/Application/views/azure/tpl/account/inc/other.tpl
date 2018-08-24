[{block name="d3accountpoints_list_with_points_other"}]
<tr>
    <td class="column first[{$RowStyle}]">
        <label>[{assign var="_pointstype" value=$oPoint->d3points__oxtype->value}]
            [{oxmultilang ident="D3_ACCOUNT_POINTS_OTHERTYPE_$_pointstype" noerror="yes" alternative=$_pointstype }]
        </label></td>
    <td class="column second[{$RowStyle}]"><label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</label></td>
    <td class="column third[{$RowStyle}]"><label>&nbsp;&nbsp;
            [{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</label></td>
    <td class="column fourth[{$RowStyle}]"><label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtext->rawValue}]</label></td>
</tr>

[{/block}]