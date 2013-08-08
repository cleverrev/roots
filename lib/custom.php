<?php
/**
 * Superfish Walker, for Roots Theme
 *
 * A custom navigation walker for Roots Theme.
 *
 * Superfish: {@link https://github.com/joeldbirch/superfish}
 * Roots Theme: {@link https://github.com/retlehs/roots}
 *
 *            /(_
 *           /_  (_
 *          / O    \
 *         |_.      |
 *         \        |
 *          |       |\
 *         /        | \
 *         |     \  (-.\
 *       _)\      \ (
 *       )_/\      \_(
 *           \    /
 *            )  (
 *           /  _ \
 *          / _// /
 *      \\_/_/  \_\/
 *
 * Copyright (C) 2013  Joel Kuzmarski
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   Navigation
 * @package    RootsThemeExamples
 * @author     Joel Kuzmarski <leoj3n+RootsThemeExamples@gmail.com>
 * @copyright  2013-2014 Joel Kuzmarski
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 *             GNU General Public License, Version 3
 */
/**
 * Superfish walker for wp_nav_menu()
 *
 * Superfish_Nav_Walker example output:
 *
 * {@link https://github.com/joeldbirch/superfish/blob/master/examples/basic.html#L46-L146}
 *
 * Example usage in, for example, {@link header-top-navbar.php}:
 *
 * <code>
 * <?php
 *   if (has_nav_menu('primary_navigation')) :
 *     wp_nav_menu(array(
 *       'theme_location' => 'primary_navigation',
 *       'menu_class'     => 'sf-menu',
 *       'walker'         => new Superfish_Nav_Walker()
 *       )
 *     );
 *   endif;
 * ?>
 * </code>
 *
 * @package    RootsThemeExamples
 * @author     Joel Kuzmarski <leoj3n+RootsThemeExamples@gmail.com>
 * @copyright  2013-2014 Joel Kuzmarski
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 *             GNU General Public License, Version 3
 * @uses       Roots_Nav_Walker extends from
 * @uses       Walker_Nav_Menu::start_el() bypasses parent
 */
class Superfish_Nav_Walker extends Roots_Nav_Walker {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul>\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    Walker_Nav_Menu::start_el($item_html, $item, $depth, $args);

    $item_html = apply_filters('superfish_wp_nav_menu_item', $item_html);
    $output .= $item_html;
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));
    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

/**
 * Overrides nav menu CSS classes
 *
 * Converts "active" -> "current"
 * Removes "menu-sub"
 *
 * @return array filtered css classes
 */
function superfish_nav_menu_css_class($classes) {
  $classes = preg_replace('/(active)/', 'current', $classes);
  $classes = preg_replace('/(menu-sub)/', '', $classes);
  return array_filter(array_unique($classes), 'is_element_empty');
}
add_filter('nav_menu_css_class', 'superfish_nav_menu_css_class', 11, 1);
