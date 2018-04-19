[{block name="d3accountpoints_mail_option"}]
    <h3 class="d3points">[{oxmultilang ident="D3_ACCOUNT_POINTS_OPTIONS"}]</h3>
    [{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_TXT"}]
    <form action="[{$oViewConf->getSelfActionLink()}]" name="d3points" method="post">
        <div class="account d3points">
            [{$oViewConf->getHiddenSid()}]
            [{$oViewConf->getNavFormParams()}]
            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
            <input type="hidden" name="fnc" value="d3MailOptions">

            <table class="mail_options">
                <tr>
                    <td class="column first_row">&nbsp;</td>
                    <td class="column first_row">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_OUT"}]</td>
                </tr>

                <tr>
                    <td class="column second_row">
                        <label for="d3PointsMailStatus[0]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_FIRST_MAIL"}]</label>
                    </td>
                    <td class="column second_row">
                        <input type="hidden" value="1" name="d3PointsMailStatus[0]">
                        <input type="checkbox" value="0" name="d3PointsMailStatus[0]"
                               [{if !$oView->d3GetSelectedOption(0)}]checked[{/if}]>
                    </td>
                </tr>

                <tr>
                    <td class="column first_row">
                        <label for="d3PointsMailStatus[1]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_RATING_REVIEW"}]</label>
                    </td>
                    <td class="column first_row">
                        <input type="hidden" value="1" name="d3PointsMailStatus[1]">
                        <input type="checkbox" value="0" name="d3PointsMailStatus[1]"
                               [{if !$oView->d3GetSelectedOption(1)}]checked[{/if}]>
                    </td>
                </tr>

                <tr>
                    <td class="column second_row">
                        <label for="d3PointsMailStatus[2]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_REMINDER"}]</label>
                    </td>
                    <td class="column second_row">
                        <input type="hidden" value="1" name="d3PointsMailStatus[2]">
                        <input type="checkbox" value="0" name="d3PointsMailStatus[2]"
                               [{if !$oView->d3GetSelectedOption(2)}]checked[{/if}]>
                    </td>
                </tr>
                [{block name="d3accountpoints_mail_option_last_option"}]
                    <tr>
                        <td class="column first_row">
                            <label for="d3PointsMailStatus[3]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_VOUCHER"}]
                            </label>
                        </td>
                        <td class="column first_row">
                            <input type="hidden" value="1" name="d3PointsMailStatus[3]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[3]"
                                   [{if !$oView->d3GetSelectedOption(3)}]checked[{/if}]>
                        </td>
                    </tr>
                [{/block}]
                <tr>
                    <td class="column second_row">&nbsp;</td>
                    <td class="column second_row">
                        <ul>
                            <li class="formSubmit">
                                <button id="savePointsConfig" type="submit"
                                        value="[{oxmultilang ident="D3_ACCOUNT_OPTIONS_SAVE"}]" class="submitButton">
                                    [{oxmultilang ident="D3_ACCOUNT_OPTIONS_SAVE"}]
                                </button>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </form>
[{/block}]