<?php

    if (Params::getParam('id') != '') {
        $id    = Params::getParam('id');
        $count = 0;

        if ( osc_is_web_user_logged_in() ) {
            //check if the item is not already in the watchlist
            $conn   = getConnection();
            $detail = $conn->osc_dbFetchResult("SELECT * FROM %st_item_watchlist WHERE fk_i_item_id = %d and fk_i_user_id = %d", DB_TABLE_PREFIX, $id, osc_logged_user_id());

            //If nothing returned then we can process
            if (!isset($detail['fk_i_item_id'])) {
                $conn = getConnection();
                $conn->osc_dbExec("INSERT INTO %st_item_watchlist (fk_i_item_id, fk_i_user_id) VALUES (%d, '%d')", DB_TABLE_PREFIX, $id, osc_logged_user_id());
                ?>
                <span align="left">
                    <a href="<?php echo osc_base_url(true); ?>?page=custom&file=watchlist/watchlist.php">
                        <svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.8974 3.81529C8.00985 -4.44555 -4.32093 7.29728 3.49729 15.5982L15.8956 26.9976V27L15.8974 26.9988L15.8986 27V26.9976L28.2962 15.5982C36.1145 7.29728 23.7849 -4.44555 15.8974 3.81529Z" fill="#ffc938" stroke-width="1.5" stroke-linejoin="round"/>
        </svg>
                    </a>
                </span>
                <?php
            } else {
                //Already in watchlist !
                echo '<span align="left"><a href="' . osc_base_url(true) . '?page=custom&file=watchlist/watchlist.php">' . '<svg width="32" height="28" viewBox="0 0 32 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.8974 3.81529C8.00985 -4.44555 -4.32093 7.29728 3.49729 15.5982L15.8956 26.9976V27L15.8974 26.9988L15.8986 27V26.9976L28.2962 15.5982C36.1145 7.29728 23.7849 -4.44555 15.8974 3.81529Z" fill="#ffc938" stroke-width="1.5" stroke-linejoin="round"/>
        </svg>' . '</a></span>';
            }
        } else {
            //error user is not login in
            echo '<a href="' . osc_user_login_url() . '">' . __('Please login', 'watchlist') . '</a>';
        }
    }

?>