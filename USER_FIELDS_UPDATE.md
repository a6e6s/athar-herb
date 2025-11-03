# User Fields Update - is_active & user_type

## Overview
This document describes the addition of two new fields to the users table: `is_active` (boolean) and `user_type` (enum).

## Changes Made

### 1. Database Schema

#### Migration
- **File**: `database/migrations/2025_11_03_180757_add_is_active_and_user_type_to_users_table.php`
- **Columns Added**:
  - `is_active` (boolean): Default `true`, placed after `password` column
  - `user_type` (string): Default `'customer'`, placed after `is_active` column

#### Running Migration
```bash
php artisan migrate
```

### 2. UserType Enum

#### File
- **Location**: `app/Enums/UserType.php`
- **Purpose**: Define user type categories with Filament integration

#### Enum Cases
```php
enum UserType: string implements HasLabel, HasColor, HasIcon
{
    case CUSTOMER = 'customer';
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case SUPPORT = 'support';
}
```

#### Features
- **Labels**: Localized using `__('filament.resources.users.user_types.*')`
  - Customer: عميل
  - Admin: مدير
  - Manager: مشرف
  - Support: دعم فني

- **Colors**:
  - Customer: Gray
  - Admin: Danger (Red)
  - Manager: Warning (Orange)
  - Support: Info (Blue)

- **Icons**:
  - Customer: `heroicon-o-user`
  - Admin: `heroicon-o-shield-check`
  - Manager: `heroicon-o-user-group`
  - Support: `heroicon-o-lifebuoy`

### 3. User Model Updates

#### File
- **Location**: `app/Models/User.php`

#### Changes
- **Fillable Array**: Added `'is_active'` and `'user_type'`
- **Casts Array**: 
  - `'is_active' => 'boolean'`
  - `'user_type' => UserType::class`

### 4. Filament User Resource Updates

#### A. UserForm.php
- **Location**: `app/Filament/Resources/Users/Schemas/UserForm.php`

**New Form Fields** (in Basic Info tab, Account Details section):
```php
Select::make('user_type')
    ->label(__('filament.resources.users.fields.user_type'))
    ->options(UserType::class)
    ->default(UserType::CUSTOMER->value)
    ->required()
    ->native(false)
    ->prefixIcon('heroicon-o-user-group')
    ->helperText(__('filament.resources.users.helpers.user_type'))
    ->columnSpan(1),

Toggle::make('is_active')
    ->label(__('filament.resources.users.fields.is_active'))
    ->default(true)
    ->inline(false)
    ->helperText(__('filament.resources.users.helpers.is_active'))
    ->columnSpan(1),
```

#### B. UsersTable.php
- **Location**: `app/Filament/Resources/Users/Tables/UsersTable.php`

**New Table Columns**:
```php
TextColumn::make('user_type')
    ->label(__('filament.resources.users.fields.user_type'))
    ->badge()  // Automatically uses enum colors
    ->sortable()
    ->searchable()
    ->toggleable(),

IconColumn::make('is_active')
    ->label(__('filament.resources.users.fields.is_active'))
    ->boolean()
    ->sortable()
    ->toggleable(),
```

**New Filters**:
```php
SelectFilter::make('user_type')
    ->label(__('filament.resources.users.filters.user_type'))
    ->options([
        'customer' => __('filament.resources.users.user_types.customer'),
        'admin' => __('filament.resources.users.user_types.admin'),
        'manager' => __('filament.resources.users.user_types.manager'),
        'support' => __('filament.resources.users.user_types.support'),
    ])
    ->native(false),

SelectFilter::make('is_active')
    ->label(__('filament.resources.users.filters.status'))
    ->options([
        '1' => __('filament.resources.users.badges.active'),
        '0' => __('filament.resources.users.badges.inactive'),
    ])
    ->native(false),
```

#### C. UserInfolist.php
- **Location**: `app/Filament/Resources/Users/Schemas/UserInfolist.php`

**New Infolist Entries** (in Account Information section):
```php
TextEntry::make('user_type')
    ->label(__('filament.resources.users.fields.user_type'))
    ->badge()  // Uses enum colors automatically
    ->icon('heroicon-m-user-group')
    ->columnSpan(1),

IconEntry::make('is_active')
    ->label(__('filament.resources.users.fields.is_active'))
    ->boolean()
    ->trueIcon('heroicon-o-check-circle')
    ->falseIcon('heroicon-o-x-circle')
    ->trueColor('success')
    ->falseColor('danger')
    ->columnSpan(1),
```

### 5. Arabic Translations

#### File
- **Location**: `lang/ar/filament.php`

#### New Translations Added

**Fields**:
```php
'is_active' => 'نشط',
'user_type' => 'نوع المستخدم',
```

**User Types**:
```php
'user_types' => [
    'customer' => 'عميل',
    'admin' => 'مدير',
    'manager' => 'مشرف',
    'support' => 'دعم فني',
],
```

**Helpers**:
```php
'is_active' => 'إذا كان غير نشط، لن يتمكن المستخدم من تسجيل الدخول إلى النظام.',
'user_type' => 'حدد دور المستخدم ونوع حسابه في النظام.',
```

**Filters**:
```php
'user_type' => 'نوع المستخدم',
'status' => 'حالة الحساب',
```

**Badges**:
```php
'active' => 'نشط',
'inactive' => 'غير نشط',
```

### 6. Database Seeder Updates

#### File
- **Location**: `database/seeders/DatabaseSeeder.php`

#### Changes
- Added `use App\Enums\UserType;` import
- Updated user creation to include `is_active` and `user_type` fields

#### Sample Data
```php
// Admin User
[
    'email' => 'admin@athar-herb.com',
    'user_type' => UserType::ADMIN,
    'is_active' => true,
]

// Sample Users
[
    ['email' => 'ahmed@example.com', 'user_type' => UserType::CUSTOMER, 'is_active' => true],
    ['email' => 'fatima@example.com', 'user_type' => UserType::CUSTOMER, 'is_active' => true],
    ['email' => 'mohammed@example.com', 'user_type' => UserType::MANAGER, 'is_active' => true],
    ['email' => 'sarah@example.com', 'user_type' => UserType::SUPPORT, 'is_active' => true],
    ['email' => 'omar@example.com', 'user_type' => UserType::CUSTOMER, 'is_active' => false],
]
```

## Features

### Form (Create/Edit User)
- **User Type Select**: Dropdown with 4 options, showing localized labels
- **Active Toggle**: Switch to enable/disable user account
- **Helper Text**: Contextual guidance in Arabic for both fields
- **Default Values**: 
  - `user_type`: CUSTOMER
  - `is_active`: true

### Table (List Users)
- **User Type Column**: Badge with color coding (gray/red/orange/blue)
- **Active Status Column**: Boolean icon (check/x circle)
- **Filters**: 
  - Filter by user type (4 options)
  - Filter by active status (active/inactive)
- **Sortable**: Both columns are sortable
- **Searchable**: User type is searchable

### Infolist (View User)
- **User Type Entry**: Badge with icon and color
- **Active Status Entry**: Boolean icon with success/danger colors
- **Positioned**: Both entries in "Account Information" section
- **Layout**: Displayed side-by-side with email verification status

### Database
- **is_active**: 
  - Type: Boolean (TINYINT)
  - Default: 1 (true)
  - Nullable: No
  
- **user_type**: 
  - Type: String (VARCHAR)
  - Default: 'customer'
  - Nullable: No
  - Values: 'customer', 'admin', 'manager', 'support'

## Usage Examples

### Creating a User
```php
User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => bcrypt('password'),
    'user_type' => UserType::ADMIN,
    'is_active' => true,
]);
```

### Updating User Status
```php
$user->update(['is_active' => false]);
```

### Querying Users
```php
// Get all active admins
User::where('is_active', true)
    ->where('user_type', UserType::ADMIN)
    ->get();

// Get inactive customers
User::where('is_active', false)
    ->where('user_type', UserType::CUSTOMER)
    ->get();
```

### Using in Middleware (Example)
```php
if (!auth()->user()->is_active) {
    abort(403, 'Your account has been deactivated.');
}

if (auth()->user()->user_type === UserType::ADMIN) {
    // Admin-specific logic
}
```

## Testing

After implementing these changes:

1. **Clear Cache**:
```bash
php artisan cache:clear
php artisan filament:optimize
```

2. **Run Migration**:
```bash
php artisan migrate
```

3. **Update Existing Data**:
```bash
php artisan tinker --execute="DB::table('users')->update(['is_active' => true, 'user_type' => 'customer']);"
```

4. **Verify in Filament**:
   - Navigate to Users resource
   - Check table columns display correctly
   - Test filters work as expected
   - Create/edit a user to verify form fields
   - View a user to check infolist display

## Files Modified Summary

1. ✅ `app/Enums/UserType.php` - Created
2. ✅ `database/migrations/2025_11_03_180757_add_is_active_and_user_type_to_users_table.php` - Created
3. ✅ `app/Models/User.php` - Updated fillable and casts
4. ✅ `app/Filament/Resources/Users/Schemas/UserForm.php` - Added form fields
5. ✅ `app/Filament/Resources/Users/Tables/UsersTable.php` - Added columns and filters
6. ✅ `app/Filament/Resources/Users/Schemas/UserInfolist.php` - Added infolist entries
7. ✅ `lang/ar/filament.php` - Added Arabic translations
8. ✅ `database/seeders/DatabaseSeeder.php` - Updated to include new fields

## Benefits

1. **User Management**: Better control over user account status
2. **Role Categorization**: Clear distinction between user types
3. **Visual Feedback**: Color-coded badges and icons for quick identification
4. **Filtering**: Easy filtering by user type and active status
5. **Localization**: Complete Arabic support for all new elements
6. **Type Safety**: Enum ensures only valid user types are used
7. **Filament Integration**: Seamless integration with Filament v4 features

## Notes

- All existing users have been updated with default values (`is_active = true`, `user_type = 'customer'`)
- The enum uses string backing values for database compatibility
- Colors and icons are automatically applied through Filament's enum interfaces
- Translations are centralized in the Arabic language file
- The implementation follows Filament v4 best practices
