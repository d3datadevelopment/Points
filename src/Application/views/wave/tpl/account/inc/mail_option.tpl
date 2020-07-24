[{block name="d3accountpoints_mail_option"}]
    <form action="[{$oViewConf->getSelfActionLink()}]" name="d3points" method="post">
        <div class="account d3points options change">
            <div class="hidden">
                [{$oViewConf->getHiddenSid()}]
                [{$oViewConf->getNavFormParams()}]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="d3SetMailOptions">
            </div>

            <div class="card">
                <div class="card-header">[{oxmultilang ident="D3_ACCOUNT_POINTS_OPTIONS"}]
                </div>
                <div class="card-body">
                    [{*<h3 class="d3points">[{oxmultilang ident="D3_ACCOUNT_POINTS_OPTIONS"}]</h3>*}]
                    <div class="form-group">
                            [{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_TXT"}]
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label class="control-label col-8" for="d3PointsMailStatus[0]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_FIRST_MAIL"}]</label>
                        <div class="col-4">
                            <input type="hidden" value="1" name="d3PointsMailStatus[0]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[0]"
                                   [{if !$oView->d3GetSelectedOption(0)}]checked[{/if}]>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-8" for="d3PointsMailStatus[1]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_RATING_REVIEW"}]</label>
                        <div class="col-4">
                            <input type="hidden" value="1" name="d3PointsMailStatus[1]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[1]"
                                   [{if !$oView->d3GetSelectedOption(1)}]checked[{/if}]>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-8" for="d3PointsMailStatus[2]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_REMINDER"}]</label>
                        <div class="col-4">
                            <input type="hidden" value="1" name="d3PointsMailStatus[2]">
                            <input type="checkbox" value="0" name="d3PointsMailStatus[2]"
                                   [{if !$oView->d3GetSelectedOption(2)}]checked[{/if}]>
                        </div>
                    </div>
                    [{block name="d3accountpoints_mail_option_last_option"}]
                        <div class="form-group row">
                            <label class="control-label col-8" for="d3PointsMailStatus[3]">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_MAIL_VOUCHER"}]</label>
                            <div class="col-4">
                                <input type="hidden" value="1" name="d3PointsMailStatus[3]">
                                <input type="checkbox" value="0" name="d3PointsMailStatus[3]"
                                       [{if !$oView->d3GetSelectedOption(3)}]checked[{/if}]>
                            </div>
                        </div>
                    [{/block}]
                    <div class="form-group row">
                        <div class="offset-lg-8 col-12">
                            <button id="savePointsConfig" type="submit" name="save" class="btn btn-primary">[{oxmultilang ident="D3_ACCOUNT_OPTIONS_SAVE"}]</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
[{/block}]