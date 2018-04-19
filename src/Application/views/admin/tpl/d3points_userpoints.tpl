[{include file="headitem.tpl" title="GENERAL_ADMIN_POINTS_USER"|oxmultilangassign}]

<style type="text/css">
    <!--
    .box td.listitem2{
        background-color: #F0F0F0;
    }
    -->
</style>

[{ if $readonly }]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
</form>

[{block name="d3points_userpoints"}]
<table cellspacing="0" cellpadding="0" border="0" width="98%">
[{assign var="sSaveError" value=$oView->d3SaveError()}]
[{if $sSaveError}]
    <tr>
        <td colspan="2" class="errorbox">[{oxmultilang ident=$sSaveError}]</td>
    </tr>
[{/if}]
<tr>
<td valign="top" class="edittext" style="padding-left:10px;width:50%">
    [{block name="d3points_userpoints_left_content"}]
    <FIELDSET>
        <legend><b>[{ oxmultilang ident="D3_USER_POINTS_OVERVIEW"}]</b></legend>
        [{block name="d3points_userpoints_left_content_points_table"}]
        <table cellspacing="0" cellpadding="0" border="0" width="300px">
            <tr>
                <td class="listheader first" align="center">[{ oxmultilang ident="D3_USER_POINTS_HEAD_TYPE" }]</td>
                <td class="listheader" height="15" align="center">&nbsp;&nbsp;&nbsp;[{ oxmultilang ident="D3_USER_POINTS_HEAD_POINTS" }]</td>
                <td class="listheader"><label>&nbsp;&nbsp;[{ oxmultilang ident="D3_USER_POINTS_HEAD_DATE" }]</label></td>
                <td class="listheader"><label>&nbsp;&nbsp;[{ oxmultilang ident="D3_USER_POINTS_HEAD_COMMENT" }]</label></td>
            </tr>
            [{assign var="blWhite" value=""}]

            [{assign var=oPointList value=$oView->d3GetAllPoints($oxid)}]
            [{foreach from=$oPointList item=listitem}]
                [{include file=$listitem->d3points__d3template->value listitem=$listitem listclass=$listclass blWhite=$blWhite}]

                [{if $blWhite == "2"}]
                    [{assign var="blWhite" value=""}]
                [{else}]
                    [{assign var="blWhite" value="2"}]
                [{/if}]
            [{/foreach}]

            [{block name="d3points_userpoints_left_content_points_table_sum"}]
            <tr>
                [{assign var="listclass" value=listitem$blWhite }]
                [{assign var="dTotalSum" value=$oView->getPointsTotalSum($oxid)}]
                <td valign="top" class="[{ $listclass}]" style="border-top: 1px solid #000"><b>[{ oxmultilang ident="D3_USER_POINTS_TOTALSUM" }]</b></td>
                <td valign="top" class="[{ $listclass}]" style="border-top: 1px solid #000" height="15" align="center"><b>[{if $dTotalSum > 0}]+[{/if}][{$dTotalSum}]</b></td>
                <td valign="top" class="[{ $listclass}]" style="border-top: 1px solid #000"><label>&nbsp;</label></td>
                <td valign="top" class="[{ $listclass}]" style="border-top: 1px solid #000"><label>&nbsp;</label></td>
            </tr>
            [{/block}]
        </table>
        [{/block}]
    </FIELDSET>

        [{* Übersicht E-Mailoptionen*}]
        [{block name="d3points_userpoints_left_content_mail_options"}]
        <FIELDSET>
            <LEGEND><b>[{ oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_TXT_ADMIN" }] </b></LEGEND>
            <form name="mailOptionsForm" id="mailOptionsForm" action="[{ $oViewConf->getSelfLink() }]" method="post">
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="d3MailOptions">
                <input type="hidden" name="oxid" value="[{ $oxid }]">
                <table>
                    <tr>
                        <td>[{ oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_FIRST_MAIL" }]</td>
                        <td>
                            <input type="hidden" value="1" name="d3PointsMailStatus[0]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[0]" [{if !$oView->d3GetSelectedOption(0)}]checked[{/if}]>
                        </td>
                    </tr>

                    <tr>
                        <td style="background-color: #F0F0F0;">[{ oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_RATING_REVIEW" }]</td>
                        <td style="background-color: #F0F0F0;">
                            <input type="hidden" value="1" name="d3PointsMailStatus[1]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[1]" [{if !$oView->d3GetSelectedOption(1)}]checked[{/if}]>
                        </td>
                    </tr>

                    <tr>
                        <td>[{ oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_REMINDER" }]</td>
                        <td>
                            <input type="hidden" value="1" name="d3PointsMailStatus[2]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[2]" [{if !$oView->d3GetSelectedOption(2)}]checked[{/if}]>
                        </td>
                    </tr>
                    [{block name="d3points_userpoints_left_content_mail_options_last_option"}]
                    <tr>
                        <td style="background-color: #F0F0F0;">[{ oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_VOUCHER" }]</td>
                        <td style="background-color: #F0F0F0;">
                            <input type="hidden" value="1" name="d3PointsMailStatus[3]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[3]" [{if !$oView->d3GetSelectedOption(3)}]checked[{/if}]>
                        </td>
                    </tr>
                    [{/block}]

                    <tr>
                        <td class="edittext" nowrap>
                            &nbsp;
                        </td>
                        <td class="edittext">
                            <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" [{ $readonly }]>
                        </td>
                    </tr>
                </table>
            </form>
        </FIELDSET>
        [{/block}]
    [{/block}]
</td>
<!-- Anfang rechte Seite -->
<td valign="top" class="edittext" style="padding-top:0;padding-left:10px;width:50%">
    [{block name="d3points_userpoints_right_content_new_points"}]
    <FIELDSET>
        <legend><b>[{ oxmultilang ident="D3_USER_POINTS_NEWPOINTS" }]</b></legend>
        <form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
            [{ $oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="fnc" value="createnewpoints">
            <input type="hidden" name="oxid" value="[{ $oxid }]">
            [{block name="d3points_userpoints_right_content_new_points_table"}]
            <table cellspacing="0" cellpadding="0" border="0">
                <tr>
                    <td class="edittext" width="160" nowrap>
                        [{ oxmultilang ident="D3_USER_POINTS_SETPOINTS" }]
                    </td>
                    <td class="edittext">
                        <input type="text" class="editinput" size="5" maxlength="10" name="dNewPoints" value="" [{ $readonly }]>&nbsp;
                        [{ oxinputhelp ident="D3_USER_POINTS_SETPOINTS_HELP" }]
                    </td>
                </tr>
                <tr>
                    <td class="edittext" width="160" nowrap>
                        [{ oxmultilang ident="D3_USER_POINTS_SETPOINTS_SEND_EMAIL" }]
                    </td>
                    <td class="edittext">
                        <input type="checkbox" value="1" name="blSendmail">
                        [{ oxinputhelp ident="D3_USER_POINTS_SETPOINTS_SEND_EMAIL_HELP" }]
                    </td>
                </tr>
                [{block name="d3points_userpoints_right_content_new_points_table_last_option"}]
                <tr>
                    <td class="edittext" width="160" nowrap style="vertical-align:top">
                        [{ oxmultilang ident="D3_USER_POINTS_DESCTEXT" }]
                    </td>
                    <td class="edittext">
                        <textarea class="editinput" name="sText" cols="60" rows="4"></textarea>
                    </td>
                </tr>
                [{/block}]
                <tr>
                    <td class="edittext" width="160" nowrap>
                        &nbsp;
                    </td>
                    <td class="edittext">
                        <input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" [{ $readonly }]>
                    </td>
                </tr>
            </table>
            [{/block}]
        </form>
    </FIELDSET>
    [{/block}]
</td>
</tr>
</table>
[{/block}]

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]