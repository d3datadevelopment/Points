[{* Stern-Bewertung *}]
[{block name="d3accountpoints_list_with_points_oxrating"}]

[{assign var="oArticle" value=$oPoint->d3GetRatingArticle()}]
<tr>
    <td class="column first[{$RowStyle}]"><label>[{oxmultilang
            ident="D3_ACCOUNT_POINTS_REVIEWTYPE_STERN"}] ([{$oArticle->oxarticles__oxartnum->value}])</label></td>
    <td class="column second[{$RowStyle}]"><label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtime->rawValue|date_format:"%d.%m.%Y"}]</label></td>
    <td class="column third[{$RowStyle}]"><label>&nbsp;&nbsp;
            [{if $oPoint->d3points__d3points->value > 0}]+[{/if}][{$oPoint->d3points__d3points->value}]</label></td>
    <td class="column fourth[{$RowStyle}]"><label>
            &nbsp;&nbsp;[{$oPoint->d3points__oxtext->rawValue}]</label></td>
</tr>
[{/block}]