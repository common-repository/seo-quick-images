<div style="padding-right: 20px;">
    <h3>Images</h3>
    <form method="POST" action="options.php">
        <?php wp_nonce_field('update-options') ?>
        <?php $show_image_author = get_option( 'seo_images_show_author' ); ?>
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row">Show image author</th>
                <td>
                    <fieldset>
                        <legend class="screen-reader-text">
                            <span>checkbox</span>
                        </legend>
                        <label for="seo_images_show_author">
                            <input name="seo_images_show_author" type="checkbox" id="seo_images_show_author" value="1" <?php echo sanitize_text_field( $show_image_author ) ? 'checked' : '' ?>>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;">
                    <button type="submit" class="button button-primary">Save</button>
                    <input type="hidden" name="action" value="update" />
                    <input type="hidden" name="page_options" value="seo_images_show_author" />
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>