<?php
/**
 * URL rewriting
 *
 * Rewrites currently do not happen for network installs
 * @todo https://github.com/retlehs/roots/issues/461
 *
 * Rewrite:
 *   /*       to /wp-content/themes/[parent]/*
 *   /*       to /wp-content/themes/[child]/* (if not found above)
 *   /plugins to /wp-content/plugins
 *
 * If you aren't using Apache, alternate configuration settings can be found in the docs.
 *
 * @link https://github.com/retlehs/roots/blob/master/doc/rewrites.md
 */
function roots_add_rewrites($content) {
  global $wp_rewrite;
  $roots_new_non_wp_rules = array(
    'plugins/(.*)'         => RELATIVE_PLUGIN_PATH . '/$1'
  );
  $wp_rewrite->non_wp_rules = array_merge($wp_rewrite->non_wp_rules, $roots_new_non_wp_rules);
  return $content;
}

/**
* These rewrite conditions cascade all theme file requests from parent -> child
*/
function roots_add_conditions($content) {
  $home_root = parse_url(home_url());
  if (isset($home_root['path']))
    $home_root = trailingslashit($home_root['path']);
  else
    $home_root = '/';

  $rules = array('RewriteRule ^index\.php$ - [L]');
  
  if (is_child_theme()) {
    $rules[] = 'RewriteCond %{DOCUMENT_ROOT}' . $home_root . CHILD_PATH . '/$1 -f';
    $rules[] = 'RewriteRule ^(.*[^/])/?$ ' . $home_root . CHILD_PATH . '/$1 [QSA,L]';
  }
  
  $rules[] = 'RewriteCond %{DOCUMENT_ROOT}' . $home_root . THEME_PATH  . '/$1 -f';
  $rules[] = 'RewriteRule ^(.*[^/])/?$ ' . $home_root . THEME_PATH . '/$1 [QSA,L]';
    
  return str_replace('RewriteRule ^index\.php$ - [L]', implode("\n", $rules), $content);
}

function roots_clean_urls($content) {
  if (strpos($content, RELATIVE_PLUGIN_PATH) > 0) {
    return str_replace('/' . RELATIVE_PLUGIN_PATH,  '/plugins', $content);
  } else {
    if (is_child_theme())
        $content = str_replace(CHILD_PATH, '', $content);

    return untrailingslashit(str_replace('/' . THEME_PATH, '', $content));
  }
}

if (!is_multisite()) {
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
