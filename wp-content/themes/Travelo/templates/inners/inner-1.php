<?php
/**
 * Inner style1
 */
?>
<div class="page-title-container" style="width: 1200px;margin-left: 112px;">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">
                <?php
                    if ( is_category() ) {
                        single_cat_title();
                    } elseif ( is_tag() ) {
                        single_tag_title();
                    } elseif ( is_author() ) {
                        the_author_meta( 'display_name' );
                    } elseif ( is_date() ) {
                        single_month_title( ' ' );
                    } elseif ( is_search() ) {
                        if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'accommodation' ) ) {
                            printf( __( 'HASIL PENCARIAN PROPERTI : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
						} elseif ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'tour' ) ) {
							printf( __( 'HASIL PENCARIAN TOUR : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
						} elseif ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'car' ) ) {
							printf( __( 'HASIL PENCARIAN KENDARAAN : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
                        } else {
                            printf( __( 'HASIL PENCARIAN UNTUK : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
                        }
                    } elseif ( is_tax() ){
                        if ( get_query_var( 'taxonomy' ) == 'location' ) {
                            printf( __( 'AKTIFITAS DI %s', 'trav' ), single_term_title( '', false ) );
                        } else {
                            single_term_title();
                        }
                    } elseif ( is_post_type_archive( 'accommodation' ) ){
                        printf( __( 'HASIL PENCARIAN PROPERTI : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
                    } elseif ( is_post_type_archive( 'tour' ) ){
                        printf( __( 'HASIL PENCARIAN TOUR : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
                    } elseif ( is_post_type_archive( 'car' ) ){
                        printf( __( 'HASIL PENCARIAN KENDARAAN : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
                    } elseif ( is_post_type_archive( 'cruise' ) ){
                        printf( __( 'HASIL PENCARIAN KAPAL PESIAR : %s', 'trav' ), '<span>' . get_search_query() . '</span>' );
                    } elseif ( is_post_type_archive( 'product' ) ){
                        woocommerce_page_title();
                    } else {
                        the_title();
                    }
                ?>
            </h2>
        </div>
        <?php trav_breadcrumbs();?>
    </div>
</div>