<?php

/**
 * Define the taxonomy functionality
 *
 * @link       https://github.com/terciotales/glads
 * @since      1.0.0
 *
 * @package    Glads
 * @subpackage Glads/includes
 */

/**
 * Define the taxonomy functionality.
 *
 * @package    Glads
 * @subpackage Glads/includes
 * @author     Tércio Tales <terciotalesb@gmail.com>
 */
class Glads_Taxonomy {

    /**
     * Initialize hooks and actions for the custom taxonomy functionalities.
     *
     * This constructor sets up the necessary actions and filters for:
     * - Registering the taxonomy.
     * - Adding and editing custom fields for the taxonomy.
     * - Saving and validating custom field values.
     * - Modifying and populating custom columns in the taxonomy admin table.
     *
     * @return void
     */
    public function __construct() {
        add_action('init', array($this, 'register_taxonomy'));

        // Add custom fields to the "ad_area" taxonomy
        add_action('ad_area_add_form_fields', array($this, 'add_taxonomy_fields'), 10, 1);
        add_action('ad_area_edit_form_fields', array($this, 'edit_taxonomy_fields'), 10, 2);

        // Save the custom field values
        add_action('created_ad_area', array($this, 'save_taxonomy_meta'), 10, 1);
        add_action('edited_ad_area', array($this, 'save_taxonomy_meta'), 10, 1);
        add_filter('pre_insert_term', array($this, 'validate_taxonomy_meta'), 10, 2);

        // Modify and populate custom columns in the taxonomy admin table.
        add_filter('manage_edit-ad_area_columns', array($this, 'modify_taxonomy_columns'));
        add_filter('manage_ad_area_custom_column', array($this, 'populate_taxonomy_columns'), 10, 3);

    }

    /**
     * Register the custom taxonomy.
     *
     * @since    1.0.0
     */
    public function register_taxonomy() {
        $labels = array(
            'name'              => _x('Ad Areas', 'taxonomy general name', 'glads'),
            'singular_name'     => _x('Ad Area', 'taxonomy singular name', 'glads'),
            'search_items'      => __('Search Ad Areas', 'glads'),
            'all_items'         => __('All Ad Areas', 'glads'),
            'parent_item'       => __('Parent Ad Area', 'glads'),
            'parent_item_colon' => __('Parent Ad Area:', 'glads'),
            'edit_item'         => __('Edit Ad Area', 'glads'),
            'update_item'       => __('Update Ad Area', 'glads'),
            'add_new_item'      => __('Add New Ad Area', 'glads'),
            'new_item_name'     => __('New Ad Area Name', 'glads'),
            'menu_name'         => __('Ad Areas', 'glads'),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'ad-area'),
        );

        register_taxonomy('ad_area', array('post'), $args);
    }

    /**
     * Add custom fields when creating a new term.
     *
     * @param string $taxonomy The taxonomy slug.
     */
    public function add_taxonomy_fields($taxonomy) {
        ?>
        <div class="form-field">
            <label for="ad_area_size"><?php _e('Ad Area Size', 'glads'); ?></label>
            <input type="text" name="ad_area_size" id="ad_area_size" value="" placeholder="e.g., 300x250">
            <p class="description"><?php _e('Enter the dimensions for this ad area (e.g., 300x250).', 'glads'); ?></p>
        </div>
        <?php
    }

    /**
     * Add custom fields when editing an existing term.
     *
     * @param WP_Term $term The term object.
     * @param string  $taxonomy The taxonomy slug.
     */
    public function edit_taxonomy_fields($term, $taxonomy) {
        // Retrieve the meta value for this term
        $ad_area_size = get_term_meta($term->term_id, 'ad_area_size', true);
        ?>
        <tr class="form-field">
            <th scope="row" valign="top">
                <label for="ad_area_size"><?php _e('Ad Area Size', 'glads'); ?></label>
            </th>
            <td>
                <input type="text" name="ad_area_size" id="ad_area_size" value="<?php echo esc_attr($ad_area_size); ?>" placeholder="e.g., 300x250">
                <p class="description"><?php _e('Enter the dimensions for this ad area (e.g., 300x250).', 'glads'); ?></p>
            </td>
        </tr>
        <?php
    }

    /**
     * Intercepta o salvamento antes de criar ou editar uma taxonomia, e valida o campo personalizado.
     *
     * @param string $term O nome do termo.
     * @param string $taxonomy O slug da taxonomia.
     * @return WP_Error|string Retorna erro ou o nome do termo se válido.
     */
    public function validate_taxonomy_meta($term, $taxonomy) {
        // Verifica se é a taxonomia correta
        if ($taxonomy !== 'ad_area') {
            return $term; // Continua normalmente para outras taxonomias.
        }

        // Verifica se o campo está presente no $_POST
        if (!isset($_POST['ad_area_size']) || empty(trim($_POST['ad_area_size']))) {
            return new WP_Error(
                'missing_ad_area_size',
                __('The Ad Area Size field is required. Please provide a value (e.g., 300x250).', 'glads')
            );
        }

        $ad_area_size = sanitize_text_field($_POST['ad_area_size']);

        // Valida o formato (deve ser número x número, ex.: 300x250)
        if (!preg_match('/^\d+x\d+$/', $ad_area_size)) {
            return new WP_Error(
                'invalid_ad_area_size',
                __('Invalid Ad Area Size format. Please use "WidthxHeight" (e.g., 300x250).', 'glads')
            );
        }

        // Tudo está correto, segue normalmente
        return $term;
    }

    /**
     * Salva o campo personalizado ao criar ou editar a taxonomia.
     *
     * @param int $term_id O ID do termo sendo salvo.
     */
    public function save_taxonomy_meta($term_id) {
        if (isset($_POST['ad_area_size'])) {
            $ad_area_size = sanitize_text_field($_POST['ad_area_size']);
            update_term_meta($term_id, 'ad_area_size', $ad_area_size);
        }
    }

    /**
     * Modifica as colunas da listagem da taxonomia no admin, exibindo o tamanho após o nome.
     *
     * @param array $columns As colunas padrão.
     * @return array As colunas modificadas.
     */
    public function modify_taxonomy_columns($columns) {
        // Remove a coluna "Descrição"
        unset($columns['description']);

        // Cria um array vazio para reorganizar as colunas
        $new_columns = [];

        foreach ($columns as $key => $label) {
            // Adiciona a coluna "Nome"
            $new_columns[$key] = $label;

            // Insere a nova coluna "Size" logo após "Nome"
            if ($key === 'name') {
                $new_columns['ad_area_size'] = __('Size', 'glads');
            }
        }

        return $new_columns;
    }

    /**
     * Popula os valores das novas colunas na listagem da taxonomia.
     *
     * @param string $content O conteúdo da coluna atual.
     * @param string $column_name O nome da coluna atual.
     * @param int $term_id O ID do termo atual.
     * @return string O conteúdo modificado para exibição.
     */
    public function populate_taxonomy_columns($content, $column_name, $term_id) {
        if ($column_name === 'ad_area_size') {
            // Resgata o valor do metadado "ad_area_size" para o termo
            $ad_area_size = get_term_meta($term_id, 'ad_area_size', true);

            // Exibe o tamanho ou uma mensagem padrão caso esteja vazio
            $content = !empty($ad_area_size) ? esc_html($ad_area_size) : __('No size set', 'glads');
        }

        return $content;
    }
}
