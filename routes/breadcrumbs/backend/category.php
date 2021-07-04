<?php
Breadcrumbs::for('admin.category.index', function ($trail) {
    $trail->push(__('labels.backend.categories.management'), route('admin.category.index'));
});

Breadcrumbs::for('admin.category.deactivated', function ($trail) {
    $trail->parent('admin.category.index');
    $trail->push(__('menus.backend.categories.deactivated'), route('admin.category.deactivated'));
});

Breadcrumbs::for('admin.category.deleted', function ($trail) {
    $trail->parent('admin.category.index');
    $trail->push(__('menus.backend.categories.deleted'), route('admin.category.deleted'));
});

Breadcrumbs::for('admin.category.create', function ($trail) {
    $trail->parent('admin.category.index');
    $trail->push(__('labels.backend.categories.create'), route('admin.category.create'));
});

Breadcrumbs::for('admin.category.show', function ($trail, $id) {
    $trail->parent('admin.category.index');
    $trail->push(__('menus.backend.categories.view'), route('admin.category.show', $id));
});

Breadcrumbs::for('admin.category.edit', function ($trail, $id) {
    $trail->parent('admin.category.index');
    $trail->push(__('menus.backend.categories.edit'), route('admin.category.edit', $id));
});

