<?php
// add custom menu fields to menu
add_filter('wp_setup_nav_menu_item', 'rentit_scm_add_custom_nav_fields');
function rentit_scm_add_custom_nav_fields($menu_item)
{
    $menu_item->subtitle = "";
  
    return $menu_item;
}

add_filter('wp_setup_nav_menu_item', 'my_item_setup');
function my_item_setup($item)
{
    //Use the following to conduct logic;
    $object_id = (int)$item->object_id; //object ID.
    $object_type = $item->type; //E.g. 'post_type'
    $object_type_label = $item->type_label; //E.g. 'post' or 'page';
    //You could, optionally add classes to the menu item.
    $item_class = $item->classes;
    //Make sure $item_class is an array.
    //Alter the class:
    $item->classes = $item_class;
    //Alter the title:
    $pack_meta_value = get_post_meta($object_id, 'test', true);
    if ($pack_meta_value) {
        $item->title = $item->title . '<span>' . $pack_meta_value . '</span>';
    }
    return $item;
}

function rentit_Walker_Nav_Menu_Edit(){
    return 'rentit_Walker_Nav_Menu_Edit';
}
/**
 * Proof of concept for how to add new fields to nav_menu_item posts in the WordPress menu editor.
 * @author Weston Ruter (@westonruter), X-Team
 */
add_action('init', array('rentit_Nav_Menu_Item_Custom_Fields', 'setup'));

class rentit_Nav_Menu_Item_Custom_Fields
{
    static $options = array(
        'item_tpl' => '
			<p class="additional-menu-field-{name} description description-thin">
				<label for="edit-menu-item-{name}-{id}">
					{label}<br>
					<input
						type="{input_type}"
						id="edit-menu-item-{name}-{id}"
						class="widefat code edit-menu-item-{name}"
						name="menu-item-{name}[{id}]"
						value="{value}">
				</label>
			</p>
		',
        'item_tpl2' => '<p class="field-link-target description">
					<label for="edit-menu-item-{name}-{id}">
						<input type="checkbox" id="edit-menu-item-{name}-{id}" value="_blank" name="menu-item-{name}[{id}]">
						</label>
				</p>'
    );

    static function setup()
    {
        // @todo we can do some merging of provided options from WP options for from config
        self::$options['fields'] = array(
            'color' => array(
                'name' => 'color1',
                'label' => esc_html__('Color', 'rentit'),
                'container_class' => 'link-color',
                'input_type' => 'color',
            ),
            'color2' => array(
                'name' => 'color2',
                'label' => esc_html__('Color', 'rentit'),
                'container_class' => 'link-color',
                'input_type' => 'color',
            ),
            'chekbox1' => array(
                'name' => 'checkbox',
                'label' => esc_html__('checkbox', 'rentit'),
                'container_class' => 'link-color',
                'input_type' => 'checkbox',
            ),
        );
        add_filter('wp_edit_nav_menu_walker', 'rentit_Walker_Nav_Menu_Edit');

        add_filter('rentit_nav_menu_item_additional_fields', array(__CLASS__, '_add_fields'), 10, 5);
        add_action('save_post', array(__CLASS__, '_save_post'));
    }

    static function get_fields_schema()
    {
        $schema = array();
        foreach (self::$options['fields'] as $name => $field) {
            if (empty($field['name'])) {
                $field['name'] = $name;
            }
            $schema[] = $field;
        }
        return $schema;
    }

    static function get_menu_item_postmeta_key($name)
    {
        return '_menu_item_' . $name;
    }

    /**
     * Inject the
     * @hook {action} save_post
     */
    static function _add_fields($new_fields, $item_output, $item, $depth, $args)
    {
        $schema = self::get_fields_schema($item->ID);
        foreach ($schema as $field) {
            $field['value'] = get_post_meta($item->ID, self::get_menu_item_postmeta_key($field['name']), true);
            $field['id'] = $item->ID;
            
            if ($field["input_type"] != 'checkbox') {
                $new_fields .= str_replace(
                    array_map( '{' . $key . '}'
                    , array_keys($field)),
                    array_values(array_map('esc_attr', $field)),
                    self::$options['item_tpl']
                );
            } else {
            }
       }
        return $new_fields;
    }

    /**
     * Save the newly submitted fields
     * @hook {action} save_post
     */
    static function _save_post($post_id)
    {
        if (get_post_type($post_id) !== 'nav_menu_item') {
            return;
        }
        $fields_schema = self::get_fields_schema($post_id);
        foreach ($fields_schema as $field_schema) {
            $form_field_name = 'menu-item-' . $field_schema['name'];
            if (isset($_POST[$form_field_name][$post_id])) {
                $key = self::get_menu_item_postmeta_key($field_schema['name']);
                $value = stripslashes($_POST[$form_field_name][$post_id]);
                update_post_meta($post_id, $key, $value);
            }
            $form_field_name = 'menu-item-megamenu';
            if (isset($_POST[$form_field_name][$post_id])) {
                $key = 'menu-item-megamenu';
                $value = stripslashes($_POST[$form_field_name][$post_id]);
                update_post_meta($post_id, $key, $value);
            } else {
                delete_post_meta($post_id, 'menu-item-megamenu');
            }
        }
        
    }
}

require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

class rentit_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_output = '';
        $item_id = esc_attr($item->ID);
        parent::start_el($item_output, $item, $depth, $args);
        ob_start();
        ?>
        <p class="">
            <label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">
                <input type="checkbox" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>"
                       name="menu-item-megamenu[<?php echo esc_attr($item_id); ?>]"
                    <?php checked(get_post_meta($item_id, 'menu-item-megamenu', true), 'on'); ?> />
                <?php  esc_html_e('Enable megamenu?', 'rentit'); ?>
            </label>
        </p>
        <?php
        $new_fields = ob_get_clean();
        if ($new_fields) {
            $item_output = preg_replace('/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output);
        }
        $output .= $item_output;
    }
}

/*
* custom Walker to menu WP
*
*/
function wpse_remove_empty_links($menu)
{
    return $menu;
}

add_filter('wp_nav_menu_items', 'wpse_remove_empty_links');

class rentit_top_menu_walker extends Walker_Nav_Menu
{
    public $title, $count, $menu_id;
    private $mega_menu_flag = false;
    private $curItem;
    private $megamenu = 0;

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $id_field = $this->db_fields['id'];
        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * add classes to ul sub-menus
     *
     * @param $output
     * @param int $depth
     * @param array $args
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
       
        //start mega menu ul
        if ($this->mega_menu_flag == true && $depth == 0) {
            $output .= "\n$indent<ul data-menuflaglvl1='{$this->mega_menu_flag}' data-depth='{$depth}'
            class=\"bbbb sub-menu\"><li class='row'>\n";
        } else {
            //  standard menu
            $output .= "\n$indent<ul data-menuflaglvl1='{$this->mega_menu_flag}' data-depth='{$depth}' class=\"bbbb sub-menu\">\n";
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        //end mega menu li
        if ($this->mega_menu_flag == true && $depth == 0) {
           $output .= "$indent</li></ul>\n";
        } else {
           $output .= "$indent</ul>\n";
        }
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $item_id = esc_attr($item->ID);
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        /**
         * Filter the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' detph' . $depth . '"' : '';
        /**
         * Filter the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        if (get_post_meta($item_id, 'menu-item-megamenu', true) != 'on' && $depth == 0) {
            $this->mega_menu_flag = false;
        }
        if (get_post_meta($item_id, 'menu-item-megamenu', true) == 'on') {
            $output .= $indent . '<li' . $id . "class='megamenu sale'" . '>';
            $this->mega_menu_flag = true;
            
        } else {
            if ($this->mega_menu_flag == true && get_post_meta($item->menu_item_parent, 'menu-item-megamenu', true) == 'on') {
                $output .= $indent . '<div  data-menuflag="' . $this->mega_menu_flag . '" data-parent="' . @$item->menu_item_parent . '"' . $id . ' class="col-md-3"' . '>';
            } else {
                $output .= $indent . '<li data-menuflag="' . $this->mega_menu_flag . '" data-parent="' . @$item->menu_item_parent . '"' . $id . $class_names . '>';
            }
        }
        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';
        /**
         * Filter the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * }
         * @param object $item The current menu item.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         * @param int $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        //  $item_output = $args->before;
        $item_output = '';
        if ($this->mega_menu_flag == true && get_post_meta($item->menu_item_parent, 'menu-item-megamenu', true) == 'on') {
            $item_output .= "<h4 class='block-title'><span>" . apply_filters('the_title', $item->title, $item->ID) . "</span></h4>";
            $item_output .= $item->description;
        } else {
            $item_output .= '<a' . $attributes . '>';
            /** This filter is documented in wp-includes/post-template.php */
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            // $item_output .= $args->after;
        }
        /**
         * Filter a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item Menu item data object.
         * @param int $depth Depth of menu item. Used for padding.
         * @param array $args An array of {@see wp_nav_menu()} arguments.
         */
      
        $output .= $item_output;
    }

    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Page data object. Not used.
     * @param int $depth Depth of page. Not Used.
     * @param array $args An array of arguments. @see wp_nav_menu()
     */
    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        //colum mega menu
        if ($this->mega_menu_flag == true && get_post_meta($item->menu_item_parent, 'menu-item-megamenu', true) == 'on') {
            $output .= "</div>\n";
        } else {
            $output .= "</li>\n";
        }
    }
}
