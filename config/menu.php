<?php

return [

    [
        'title' => 'Dashboard',
        'icon' => 'fa-tachometer-alt',
        'link' => 'admin.index',
        'router' => 'admin.index',
        'subject' => 'dashboard'
    ],
    [
        'title' => 'Category Manager',
        'icon' => 'fa-shopping-cart',
        'link' => 'admin.category.index',
        'router' => 'admin.category.*',
        'subject' => 'category'
    ],
    [
        'title' => 'Product Manager',
        'icon' => 'fa-shopping-basket',
        'link' => 'admin.product.index',
        'router' => 'admin.product.*',
        'subject' => 'product'
    ],
    [
        'title' => 'Blog Manager',
        'icon' => 'fa-newspaper',
        'link' => 'admin.blog.index',
        'router' => 'admin.blog.*',
        'subject' => 'blog'

    ],
    [
        'title' => 'Slider Manager',
        'icon' => 'fa-images',
        'link' => 'admin.slider.index',
        'router' => 'admin.slider.*',
        'subject' => 'slider'

    ],
    [
        'title' => 'Order Manager',
        'icon' => 'fa-tasks',
        'link' => 'admin.order.index',
        'router' => 'admin.order.*',
        'subject' => 'order'
    ],
    [
        'title' => 'User Manager',
        'icon' => 'fa-user',
        'link' => 'admin.user.index',
        'router' => 'admin.user.*',
        'subject' => 'user'
    ],
    [
        'title' => 'File Manager',
        'icon' => 'fa-folder-open',
        'link' => 'admin.filemanager',
        'router' => 'admin.filemanager',
        'subject' => 'file'
    ]

];
