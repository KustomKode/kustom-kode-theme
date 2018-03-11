<?php
function client_settings(){ 
    echo '<div class="wrap"><h1>Site Settings</h1>';
    if(isset($_POST["update_settings"])){
        update_option('company_name', esc_attr($_POST['company_name']));
        update_option('company_add', esc_attr($_POST['company_add']));
        update_option('company_add_line_two', esc_attr($_POST['company_add_line_two']));
        update_option('company_city', esc_attr($_POST['company_city']));
        update_option('company_state', esc_attr($_POST['company_state']));
        update_option('company_zip', esc_attr($_POST['company_zip']));
        update_option('company_phone', chop(esc_attr($_POST['company_phone'])));
        update_option('company_phone_two', chop(esc_attr($_POST['company_phone_two'])));
        update_option('company_fax', chop(esc_attr($_POST['company_fax'])));
        update_option('company_email', esc_attr($_POST['company_email']));
        update_option('company_facebook', esc_attr($_POST['company_facebook']));
        update_option('company_twitter', esc_attr($_POST['company_twitter']));
        update_option('company_linkedin', esc_attr($_POST['company_linkedin']));
        update_option('company_google_plus', esc_attr($_POST['company_google_plus']));
        echo '<div id="message" class="updated">Settings Successfully Updated</div>';
    }
    ?>
    <form method="POST" action="">
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label>Company Name:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_name'); ?>" type="text" name="company_name" />
                    <?php if(get_option('company_name')) echo '<span style="font-size:12px;">[company-name]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Street Address:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_add'); ?>" type="text" name="company_add" />
                    <?php if(get_option('company_add')) echo '<span style="font-size:12px;">[company-add]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Address Line 2:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_add_line_two'); ?>" type="text" name="company_add_line_two" />
                    <?php if(get_option('company_add_line_two')) echo '<span style="font-size:12px;">[company-add-line-two]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>City:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_city'); ?>" type="text" name="company_city" />
                    <?php if(get_option('company_city')) echo '<span style="font-size:12px;">[company-city]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>State:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_state'); ?>" type="text" name="company_state" />
                    <?php if(get_option('company_state')) echo '<span style="font-size:12px;">[company-state]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Zip Code:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_zip'); ?>" type="text" name="company_zip" />
                    <?php if(get_option('company_zip')) echo '<span style="font-size:12px;">[company-zip]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Phone Number:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_phone'); ?>" type="tel" name="company_phone" />
                    <?php if(get_option('company_phone')) echo '<span style="font-size:12px;">[company-phone] &amp; [company-phone-link]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Second Phone Number:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_phone_two'); ?>" type="tel" name="company_phone_two" />
                    <?php if(get_option('company_phone_two')) echo '<span style="font-size:12px;">[company-phone-two] &amp; [company-phone-two-link]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Fax Number:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_fax'); ?>" type="text" name="company_fax" />
                    <?php if(get_option('company_fax')) echo '<span style="font-size:12px;">[company-fax] &amp; [company-fax-link]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Email Address:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_email'); ?>" type="email" name="company_email" />
                    <?php if(get_option('company_email')) echo '<span style="font-size:12px;">[company-email]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Facebook URL:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_facebook'); ?>" type="url" name="company_facebook" />
                    <?php if(get_option('company_facebook')) echo '<span style="font-size:12px;">[company-facebook]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Twitter URL:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_twitter'); ?>" type="url" name="company_twitter" />
                    <?php if(get_option('company_twitter')) echo '<span style="font-size:12px;">[company-twitter]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>LinkedIn URL:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_linkedin'); ?>" type="url" name="company_linkedin" />
                    <?php if(get_option('company_linkedin')) echo '<span style="font-size:12px;">[company-linkedin]</span>'; ?>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label>Google Plus URL:</label>
                </th>
                <td>
                    <input size="25" value="<?php echo get_option('company_google_plus'); ?>" type="url" name="company_google_plus" />
                    <?php if(get_option('company_google_plus')) echo '<span style="font-size:12px;">[company-google-plus]</span>'; ?>
                </td>
            </tr>
        </table>
        <p>
            <input type="hidden" name="update_settings" value="Y" />
            <input type="submit" value="Save Settings" class="button-primary"/>
        </p>
    </form>
    </div><?php
}
?>