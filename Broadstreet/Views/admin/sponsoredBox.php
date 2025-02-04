<?php if(true): ?>
    <div class="misc-publishing-actions">
        <div class="misc-pub-section">
            <div style="float:left; padding-top: 5px;">
                <strong>Performance Tracking</strong>
            </div>
            <div class="checkbox-switch" style="float:right;">
                <input type="checkbox" <?php if ($meta['bs_sponsor_is_sponsored']) echo 'checked' ?> onchange="bsaSponsorToggle(event)" value="1" name="bs_sponsor_is_sponsored" class="input-checkbox" id="bsa_is_sponsored">
                <div class="checkbox-animate">
                    <span class="checkbox-off">Off</span>
                    <span class="checkbox-on">On</span>
                </div>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="misc-pub-section" id="bsa_sponsor_advertiser_selection">
            <div><strong>Advertiser</strong></div>
            <?php if (isset($meta['bs_sponsor_advertiser_id'])): ?>
                <input type="hidden" id="bs_sponsor_old_advertiser_id" name="bs_sponsor_old_advertiser_id" value="<?php echo $meta['bs_sponsor_advertiser_id'] ?>">
            <?php endif; ?>
            <select id="bs_sponsor_advertiser_id" name="bs_sponsor_advertiser_id" onchange="sponsorSelect()">
                <?php $linked = false; ?>
                <?php $has_match = false ?>
                <?php foreach($advertisers as $advertiser): ?>
                    <?php if($advertiser->name == $GLOBALS['post']->post_title) $has_match = true; ?>
                    <?php if($meta['bs_sponsor_advertiser_id'] == $advertiser->id) $linked = true; ?>
                    <option value="<?php echo $advertiser->id ?>" <?php if($meta['bs_sponsor_advertiser_id'] == $advertiser->id) echo ' selected="selected"' ?>><?php echo esc_html($advertiser->name) ?> (ID: <?php echo esc_html($advertiser->id) ?>)</option>
                <?php endforeach; ?>
                <option value="new_advertiser">-- Create a New Advertiser --</option>
            </select>
            <input type="text" name="bs_sponsor_advertiser_name" id="bs_sponsor_advertiser_name" placeholder="Untitled Advertiser" minlength="3" value="" style="display:none;" />
            <?php if (isset($meta['bs_sponsor_advertisement_id'])): ?>
                <input type="hidden" id="bs_sponsor_advertisement_id" name="bs_sponsor_advertisement_id" value="<?php echo $meta['bs_sponsor_advertisement_id'] ?>">
            <?php endif; ?>
        </div>
        <?php if (@$meta['bs_sponsor_advertiser_id'] && @$meta['bs_sponsor_advertisement_id']): ?>
            <div class="misc-pub-section">
                <p>You can view this post's performance in
                    <a href="<?php echo Broadstreet_Utility::getBroadstreetDashboardURL() ?>networks/<?php echo $network_id ?>/advertisers/<?php echo $meta['bs_sponsor_advertiser_id'] ?>/advertisements/<?php echo $meta['bs_sponsor_advertisement_id'] ?>" target="_blank">Broadstreet's dashboard</a>.
                </p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        window.bsaSponsorToggle = function (e) {
            var sel = jQuery('#bsa_sponsor_advertiser_selection');
            if (jQuery('#bsa_is_sponsored').is(':checked')) {
                sel.fadeIn();
            } else {
                sel.fadeOut();
            }
        }

        window.sponsorSelect = function() {
            var val = jQuery('#bs_sponsor_advertiser_id').val();
            if (val == 'new_advertiser') {
                jQuery('#bs_sponsor_advertiser_name').hide();
                jQuery('#bs_sponsor_advertiser_name').show();
            } else {
                jQuery('#bs_sponsor_advertiser_name').hide();
            }
        }

        window.bsaSponsorToggle();
        window.sponsorSelect();
    </script>
<?php else: ?>
        <p style="color: green; font-weight: bold;">You either have no zones or
            Broadstreet isn't configured correctly. Go to 'Settings', then 'Broadstreet',
        and make sure your access token is correct, and make sure you have zones set up.</p>
<?php endif; ?>
<input type="hidden" name="bs_sponsor_submit" value="1" />
<script>window.bs_post_id = '<?php echo $GLOBALS['post']->ID ?>';</script>