<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
<<<<<<< HEAD

// ── Public Routes (No Filter) ───────────────────────────────────────────────
$routes->get('/',             'Auth::index');
$routes->get('login',         'Auth::index');
$routes->post('login',        'Auth::index');
$routes->get('logout',        'Auth::logout');
$routes->get('register',      'Auth::register');
$routes->post('register',     'Auth::registration');
$routes->get('unauthorized',  'Auth::unauthorized'); // STEP 6: Uncontrolled Route

// ── Student Routes (filter: ['auth', 'student']) ────────────────────────────
$routes->group('', ['filter' => ['auth', 'student']], function ($routes) {
    $routes->get('student/dashboard', 'StudentController::dashboard');
});

// ── Profile Routes (filter: auth|student) — student only per access matrix ─
$routes->group('', ['filter' => ['auth', 'student']], function ($routes) {
    $routes->get('profile',         'ProfileController::show');
    $routes->get('profile/edit',    'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');
});

// ── Teacher Routes (filter: ['auth', 'teacher']) ────────────────────────────
$routes->group('', ['filter' => ['auth', 'teacher']], function ($routes) {
    $routes->get('dashboard',                 'Home::index');
    $routes->get('students',                  'StudentManagementController::index');
    $routes->get('students/show/(:num)',      'StudentManagementController::show/$1');
    
    // Items CRUD (Assuming they map to existing endpoints or standard routes)
    $routes->post('student/store',            'Student::store');
    $routes->get('student/edit/(:num)',       'Student::edit/$1');
    $routes->post('student/update/(:num)',    'Student::update/$1');
    $routes->post('student/delete/(:num)',    'Student::delete/$1');
});

// ── Admin Routes (filter: ['auth', 'admin']) ────────────────────────────────
$routes->group('admin', ['filter' => ['auth', 'admin']], function ($routes) {
    // Role CRUD
    $routes->get('roles',                     'Admin\RoleController::index');
    $routes->get('roles/create',              'Admin\RoleController::create');
    $routes->post('roles/store',              'Admin\RoleController::store');
    $routes->get('roles/edit/(:num)',         'Admin\RoleController::edit/$1');
    $routes->post('roles/update/(:num)',      'Admin\RoleController::update/$1');
    $routes->get('roles/delete/(:num)',       'Admin\RoleController::delete/$1');

    // User Role Assignment
    $routes->get('users',                     'Admin\UserAdminController::index');
    $routes->post('users/assign-role/(:num)', 'Admin\UserAdminController::assignRole/$1');
});
=======
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('blocked', 'Auth::forbiddenPage');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registration');

$routes->get('dashboard', 'Home::index');
$routes->get('dashboard-v2', 'Home::dashboardV2');
$routes->get('dashboard-v3', 'Home::dashboardV3');

// Profile Routes
$routes->get('profile', 'ProfileController::show');
$routes->get('profile/edit', 'ProfileController::edit');
$routes->post('profile/update', 'ProfileController::update');

// Setting Routes
$routes->group('users', static function ($routes) {
    $routes->get('/', 'Settings::users');
    $routes->post('create-role', 'Settings::createRole');
    $routes->post('update-role', 'Settings::updateRole');
    $routes->delete('delete-role/(:num)', 'Settings::deleteRole/$1');

    $routes->get('role-access', 'Settings::roleAccess');
    $routes->post('create-user', 'Settings::createUser');
    $routes->post('update-user', 'Settings::updateUser');
    $routes->delete('delete-user/(:num)', 'Settings::deleteUser/$1');

    $routes->post('change-menu-permission', 'Settings::changeMenuPermission');
    $routes->post('change-menu-category-permission', 'Settings::changeMenuCategoryPermission');
    $routes->post('change-submenu-permission', 'Settings::changeSubMenuPermission');
});

$routes->group('menu-management', static function ($routes) {
    $routes->get('/', 'Settings::menuManagement');
    $routes->post('create-menu-category', 'Settings::createMenuCategory');
    $routes->post('create-menu', 'Settings::createMenu');
    $routes->post('create-submenu', 'Settings::createSubMenu');
});
$routes->get('menu','Menu::index');

// Student Routes
$routes->get('students', 'Student::index');
$routes->get('student/view/(:num)', 'Student::view/$1');
$routes->get('student/edit/(:num)', 'Student::edit/$1');
$routes->post('student/store', 'Student::store');
$routes->post('student/update/(:num)', 'Student::update/$1');
$routes->delete('student/delete/(:num)', 'Student::delete/$1');

// Exam module routes
$routes->get('exam', 'Exam::index');
$routes->get('exam/create', 'Exam::create');
$routes->post('exam/store', 'Exam::store');
$routes->get('exam/show/(:num)', 'Exam::show/$1');
$routes->get('exam/edit/(:num)', 'Exam::edit/$1');
$routes->post('exam/update/(:num)', 'Exam::update/$1');
$routes->get('exam/delete/(:num)', 'Exam::delete/$1');
>>>>>>> 9ba83627075c63629f030a4305e2abafb941156b
