[{$smarty.block.parent}]

[{*** D3 Bonuspunkte ADD START   **}]
[{d3modcfgcheck modid="d3points"}][{/d3modcfgcheck}]
[{if $mod_d3points}]
<tr>
    <td class="edittext" colspan="2">
        <table style="border : 1px #A9A9A9; border-style : solid solid solid solid; padding-top: 5px; padding-bottom: 5px; padding-right: 5px; padding-left: 5px; width: 600px;">
            [{assign var="o3point" value=$oView->d3GetPointsForOrder() }]
            <tr>
                <td class="edittext" style="vertical-align:top;">
                    <img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php">
                    [{ oxmultilang ident="ORDER_MAIN_D3POINTS_4_ORDER" }]</td>
                <td class="edittext" style="vertical-align:top;">
                    [{foreach from=$o3point item=oPoints }]
                    <b>[{ $oPoints->d3points__d3points->value }] [{ oxmultilang ident="D3_USER_POINTS_SETPOINTS" }]</b>
                    [{if $oPoints->d3points__d3points->value < 0 }] [{ oxmultilang ident="ORDER_MAIN_D3POINTS_4_ORDER_STORNO" }] [{/if}]
                    ( [{ $oPoints->d3points__oxtime->value }] )<br>
                    [{foreachelse}]
                    [{ oxmultilang ident="ORDER_MAIN_D3POINTS_4_ORDER_NOT_SET" }]
                    [{/foreach}]
                </td>
            </tr>
            <tr>
                <td class="edittext">&nbsp;</td>
                <td class="edittext">&nbsp;</td>
            </tr>
        </table>
    </td>
</tr>
[{/if}]
[{*** D3 Bonuspunkte ADD END ***}]