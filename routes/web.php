<?php

declare(strict_types=1);

use App\Router;
use Controller\AdController;
use Controller\BranchController;
use Controller\AuthController;
use Controller\UserController;

Router::get('/', fn() => (new AdController())->home());

Router::get('/ads/{id}', fn(int $id) => (new AdController())->show($id));
Router::get('/ads/create', fn() => (new AdController())->create());
Router::post('/ads/create', fn() => (new AdController())->store());
Router::get('/ads/update/{id}', fn(int $id) => (new AdController())->update($id));
Router::patch('/ads/update/{id}', fn(int $id) => (new AdController())->edit($id));
Router::delete('/ads/delete/{id}', fn(int $id) => (new AdController())->delete($id));

// Statuses
Router::get('/status/create', fn() => loadView('dashboard/create-status'));
Router::post('/status/create', fn() => loadController('createStatus'));

Router::get('/login', fn() => loadView('auth/login'), 'guest');
Router::post('/login', fn() => (new AuthController())->login());

Router::get('/branch/create', fn() => loadView('dashboard/create-branch'), 'auth');
Router::post('/branch/create', fn() => (new BranchController())->create());
Router::get('/branches', fn() => (new BranchController())->branches(), 'auth');

Router::get('/admin', fn() => loadView('dashboard/admin'), 'auth');
Router::get('/admin/ads', fn() => (new BranchController())->homeAds(), 'auth');
Router::get('/admin/users', fn() => (new UserController())->index(), 'auth');
Router::get('/admin/users/{id}', fn(int $id) => (new UserController())->show($id), 'auth');
Router::get('/admin/users/update/{id}', fn(int $id) => (new UserController())->update($id), 'auth');

Router::get('/logout', fn() => (new AuthController())->logout());

Router::get('/profile', fn() => (new UserController())->loadProfile(), 'auth');

Router::get('/search', fn() => (new AdController())->search(), 'auth' );

Router::errorResponse(404, 'Not Found');