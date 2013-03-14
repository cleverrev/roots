<?php
/**
 * URL rewriting
 *
 * Rewrites currently do not happen for child themes (or network installs)
 * @todo https://github.com/retlehs/roots/issues/461
 *
 * Rewrite:
 *   /wp-content/themes/themename/css/ to /css/
 *   /wp-content/themes/themename/js/  to /js/
 *   /wp-content/themes/themename/img/ to /img/
 *   /wp-content/plugins/              to /plugins/
 *
 * If you aren't using Apache, alternate configuration settings can be found in the docs.
 *
 * @link https://github.com/retlehs/roots/blob/master/doc/rewrites.md
 */
function roots_add_rewrites($content) {
  global $wp_rewrite;
  $roots_new_non_wp_rules = array(
    // 'assets/css/(.*)'      => THEME_PATH . '/assets/css/$1',
    // 'assets/js/(.*)'       => THEME_PATH . '/assets/js/$1',
    // 'assets/img/(.*)'      => THEME_PATH . '/assets/img/$1',
    'plugins/(.*)'         => RELATIVE_PLUGIN_PATH . '/$1'
  );
  $wp_rewrite->non_wp_rules = array_merge($wp_rewrite->non_wp_rules, $roots_new_non_wp_rules);
  return $content;
}

function roots_add_conditions($content) {
  $home_root = parse_url(home_url());
  if ( isset( $home_root['path'] ) )
    $home_root = trailingslashit($home_root['path']);
  else
    $home_root = '/';

  $rules = array('RewriteRule ^index\.php$ - [L]');
  
  if (is_child_theme()) {
    $rules[] = 'RewriteCond %{DOCUMENT_ROOT}/' . $home_root . CHILD_THEME_PATH . '/$1 -f';
    $rules[] = 'RewriteRule ^(.*[^/])/?$ /' . $home_root . CHILD_THEME_PATH . '/$1 [QSA,L]';
  }
  
  $rules[] = 'RewriteCond %{DOCUMENT_ROOT}/' . $home_root . THEME_PATH  . '/$1 -f';
  $rules[] = 'RewriteRule ^(.*[^/])/?$ /' . $home_root . THEME_PATH . '/$1 [QSA,L]';
    
  return str_replace('RewriteRule ^index\.php$ - [L]', implode("\n", $rules), $content);
}

function roots_clean_urls($content) {
  if (strpos($content, FULL_RELATIVE_PLUGIN_PATH) === 0) {
    return str_replace(FULL_RELATIVE_PLUGIN_PATH, WP_BASE . '/plugins', $content);
  } else {
    if (is_child_theme())
        $content = str_replace(unleadingslashit(CHILD_THEME_PATH), '', $content);

    return untrailingslashit(str_replace(leadingslashit(THEME_PATH), '', $content));
  }
}

if (!is_multisite() && get_option('permalink_structure')) {
  if (current_theme_supports('rewrites')) {
    add_action('generate_rewrite_rules', 'roots_add_rewrites');
    add_filter('mod_rewrite_rules', 'roots_add_conditions');
  }

  if (!is_admin() && current_theme_supports('rewrites')) {
    $tags = array(
      'plugins_url',
      'bloginfo',
      'stylesheet_directory_uri',
      'template_directory_uri',
      'script_loader_src',
      'style_loader_src'
    );

    add_filters($tags, 'roots_clean_urls');
  }
}
