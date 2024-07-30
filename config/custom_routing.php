<?php
$routes = [
    'tg-admin' => 'trongate_administrators/login',
    'tg-admin/submit_login' => 'trongate_administrators/submit_login',
    'trongate-pages' => 'trongate_pages/index',
    '/'=> 'livestock247',
    '/meat247'=> 'livestock247/meat247',
    '/hoina'=> 'livestock247/hoina',
    '/aims'=> 'livestock247/aims',
    '/contact'=> 'livestock247/contact',
    '/about'=> 'livestock247/about',
    '/blog'=> 'livestock247/blog',
    '/login'=> 'livestock247/login',
    '/dashboard'=> 'livestock247/dashboard',
    '/profile'=> 'livestock247/profile',
    '/create_post'=> 'livestock247/create_post',
    '/blog_post'=> 'livestock247/blog_post',
    '/all_post'=> 'livestock247/all_post',
    '/create_user'=> 'livestock247/create_user',
    '/users'=> 'livestock247/users',
    '/logout'=> 'livestock247/dashboard/logout_blogger',
];
define('CUSTOM_ROUTES', $routes);
