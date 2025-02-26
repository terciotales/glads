<?php

class Glads_Blocks {

    /**
     * Construtor: Adiciona ações para registrar blocos e categorias
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_blocks' ) );
        add_filter( 'block_categories_all', array( $this, 'register_block_category' ), 10, 2 );
    }

    /**
     * Registra os blocos do plugin.
     *
     * @since 1.0.0
     */
    public function register_blocks() {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }

        $blocks = array(
            'ad',
        );



        foreach ( $blocks as $block ) {
            register_block_type(
                GLADS_PLUGIN_DIR . 'dist/blocks/' . $block
            );
        }
    }

    /**
     * Registra a categoria de bloco "Glads".
     *
     * @param array $categories Categorias existentes do editor.
     * @param WP_Post $post Objeto do post.
     * @return array Categorias modificadas com a nova categoria "Glads".
     *
     * @since 1.0.0
     */
    public function register_block_category( $categories, $post ) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug'  => 'glads',
                    'title' => __( 'Glads', 'glads' ),
                    'icon'  => 'megaphone',
                ),
            )
        );
    }
}
