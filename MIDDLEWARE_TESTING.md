# Middleware Testing Guide

## EnsureUserIsActiveAdmin Middleware

This middleware ensures that only **active** users with **admin-level access** can access the Filament admin panel.

### What It Checks

1. **User Authentication**: Users must be logged in (handled by `Authenticate` middleware)
2. **Active Status**: User's `is_active` field must be `true`
3. **User Type**: User's `user_type` must be one of:
   - `ADMIN`
   - `MANAGER`
   - `SUPPORT`

### Test Scenarios

#### Scenario 1: Active Admin User (✅ Should Work)
```
User: admin@example.com
is_active: true
user_type: ADMIN
Expected: Access granted to /admin
```

#### Scenario 2: Inactive Admin User (❌ Should Fail)
```
User: admin@example.com
is_active: false
user_type: ADMIN
Expected: Logged out and redirected to login with error message:
- English: "Your account has been deactivated. Please contact support."
- Arabic: "تم تعطيل حسابك. يرجى التواصل مع الدعم الفني."
```

#### Scenario 3: Active Customer User (❌ Should Fail)
```
User: customer@example.com
is_active: true
user_type: CUSTOMER
Expected: Logged out and redirected to login with error message:
- English: "You do not have permission to access the admin panel."
- Arabic: "ليس لديك صلاحية للوصول إلى لوحة التحكم."
```

#### Scenario 4: Active Manager User (✅ Should Work)
```
User: manager@example.com
is_active: true
user_type: MANAGER
Expected: Access granted to /admin
```

#### Scenario 5: Active Support User (✅ Should Work)
```
User: support@example.com
is_active: true
user_type: SUPPORT
Expected: Access granted to /admin
```

### How to Test

1. **Create Test Users** (via Tinker or Seeder):
```php
php artisan tinker

// Test user 1: Active Admin
User::create([
    'name' => 'Admin User',
    'email' => 'admin@test.com',
    'password' => bcrypt('password'),
    'is_active' => true,
    'user_type' => UserType::ADMIN,
]);

// Test user 2: Inactive Admin
User::create([
    'name' => 'Inactive Admin',
    'email' => 'inactive@test.com',
    'password' => bcrypt('password'),
    'is_active' => false,
    'user_type' => UserType::ADMIN,
]);

// Test user 3: Active Customer
User::create([
    'name' => 'Customer User',
    'email' => 'customer@test.com',
    'password' => bcrypt('password'),
    'is_active' => true,
    'user_type' => UserType::CUSTOMER,
]);
```

2. **Test Login**:
   - Visit `http://your-app.test/admin`
   - Try logging in with each test user
   - Verify the expected behavior

3. **Test Deactivation Flow**:
   - Login as active admin
   - While logged in, deactivate the user via database:
     ```sql
     UPDATE users SET is_active = 0 WHERE email = 'admin@test.com';
     ```
   - Try to access any admin page
   - Should be logged out and redirected

### Files Modified

1. **Middleware**: `app/Http/Middleware/EnsureUserIsActiveAdmin.php`
2. **Panel Provider**: `app/Providers/Filament/AdminPanelProvider.php`
3. **Translations**: 
   - `lang/en/filament.php`
   - `lang/ar/filament.php`

### Security Features

✅ Session invalidation on unauthorized access
✅ Token regeneration to prevent session fixation
✅ Proper logout before redirect
✅ Translated error messages
✅ Works with Filament Shield permissions

### Notes

- The middleware runs **after** the `Authenticate` middleware
- Unauthenticated users are handled by Filament's built-in authentication
- Error messages are displayed as flash messages on the login page
- Language-specific error messages based on user's locale preference
