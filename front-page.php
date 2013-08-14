<?php
/**
 * Backbone Todo MVC, using Roots Theme
 *
 * A simple app using Backbone and Roots.
 *
 * Backbone: {@link http://backbonejs.org}
 * Roots Theme: {@link https://github.com/retlehs/roots}
 *
 *          ``                  ``
 *        -+s+                  +s+-
 *      -osss+                  +ssso-
 *    .+sssss/     :`           +sssss+.
 *   -ossssss:     +`           +sssssso-
 *  .sssssss+     .s`           +ssssssss.
 * `ossssss/     `os`    `-     +sssssssso`
 * :sssss/`     `+so`    ./     +sssssssss:
 * +sss/`      -oss:     //     +sssssssss+
 * +s/`      -osso:     .s/     +sssssssss+
 * -`      -osss/`     .os+     /sssssssss+
 *       -osss/`      :ssso     .sssssssss-
 *     -osss/`      -osssss:     .ossssss+
 *   .osss/`      -ossssssss-     `/sssso`
 *   `+s/`      -osssssssssss/      `/s+`
 *     `      -osssssssssssssso-      `
 *          -osssssssssssssssssso-
 *         .+ssssssssssssssssssss+.
 *           `.:+osssssssssso+:.`
 *                 `......`
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
 * @category   JavaScript
 * @package    RootsThemeExamples
 * @author     Joel Kuzmarski <leoj3n+RootsThemeExamples@gmail.com>
 * @copyright  2013-2014 Joel Kuzmarski
 * @license    http://www.gnu.org/licenses/gpl-3.0.txt
 *             GNU General Public License, Version 3
 * @link       https://github.com/leoj3n/roots/tree/example.backbone
 */

get_template_part('templates/content', 'front-page');
?>

<!-- Backbone Example -->
<script type="text/template" id="item-template">
  <div class="panel">
    <div class="panel-heading">
      <%- title %>
    </div>
    <div class="panel-body">
      <div class="input-group">
        <span class="input-group-addon">
          <input class="toggle" type="checkbox" <%= completed ? 'checked' : '' %>>
        </span>
        <input type="text" class="edit form-control" value="<%- title %>">
        <span class="input-group-btn">
          <button class="btn btn-danger destroy" type="button">&times;</button>
        </span>
      </div><!-- /input-group -->
    </div>
  </div>
</script>
<script type="text/template" id="stats-template">
  <div class="panel">
    <div class="panel-heading"><span id="todo-count"><span class="badge"><%= remaining %></span> <%= remaining === 1 ? 'item' : 'items' %> left</span></div>
    <div class="panel-body">
      <ul id="filters" class="nav nav-pills">
        <li class="active"><a href="#/">All</a></li>
        <li><a href="#/active">Active</a></li>
        <li><a href="#/completed">Completed</a></li>
      </ul>
      </div>
    </div>
  </div>
  <% if (completed) { %>
  <button id="clear-completed" type="button" class="btn btn-xs btn-danger">
    Clear completed (<%= completed %>)
  </button>
  <% } %>
</script>
