<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Booking
            'booking.view', 'booking.create', 'booking.edit', 'booking.delete',
            'booking.confirm', 'booking.cancel', 'booking.reschedule', 'booking.assign-artist',

            // Calendar & Slots
            'slots.manage', 'slots.block',

            // Customers
            'customer.view', 'customer.edit', 'customer.delete', 'customer.notes',

            // Artists
            'artist.view', 'artist.create', 'artist.edit', 'artist.delete',

            // Portfolio
            'portfolio.view', 'portfolio.create', 'portfolio.edit', 'portfolio.delete', 'portfolio.publish',

            // Content (Blog, FAQ, Testimonials)
            'content.view', 'content.create', 'content.edit', 'content.delete', 'content.publish',

            // Invoices & Payments
            'invoice.view', 'invoice.create', 'invoice.edit', 'invoice.delete', 'invoice.send',
            'payment.view', 'payment.process', 'payment.refund',

            // Reports & Analytics
            'reports.view', 'reports.export',

            // Inventory
            'inventory.view', 'inventory.create', 'inventory.edit', 'inventory.delete',

            // CRM
            'crm.view', 'crm.create', 'crm.edit', 'crm.delete',

            // Settings
            'settings.view', 'settings.edit',

            // Admin
            'admin.access', 'admin.roles', 'admin.branches',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // ── ROLES ──

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'booking.view','booking.create','booking.edit','booking.confirm','booking.cancel',
            'booking.reschedule','booking.assign-artist','slots.manage','slots.block',
            'customer.view','customer.edit','customer.notes',
            'artist.view','artist.create','artist.edit',
            'portfolio.view','portfolio.create','portfolio.edit','portfolio.publish',
            'content.view','content.create','content.edit','content.publish',
            'invoice.view','invoice.create','invoice.edit','invoice.send',
            'payment.view','payment.process','payment.refund',
            'reports.view','reports.export',
            'inventory.view','inventory.create','inventory.edit',
            'crm.view','crm.create','crm.edit',
            'settings.view','admin.access',
        ]);

        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);
        $manager->syncPermissions([
            'booking.view','booking.create','booking.edit','booking.confirm','booking.cancel','booking.reschedule',
            'slots.manage','slots.block',
            'customer.view','customer.edit','customer.notes',
            'artist.view',
            'portfolio.view','portfolio.create','portfolio.edit',
            'content.view',
            'invoice.view','invoice.create','invoice.send',
            'payment.view',
            'reports.view',
            'inventory.view','inventory.edit',
            'crm.view','crm.create','crm.edit',
            'admin.access',
        ]);

        $artist = Role::firstOrCreate(['name' => 'artist', 'guard_name' => 'web']);
        $artist->syncPermissions([
            'booking.view',
            'portfolio.view','portfolio.create','portfolio.edit',
            'customer.view',
            'invoice.view',
            'admin.access',
        ]);

        $receptionist = Role::firstOrCreate(['name' => 'receptionist', 'guard_name' => 'web']);
        $receptionist->syncPermissions([
            'booking.view','booking.create','booking.edit','booking.confirm','booking.cancel',
            'slots.manage',
            'customer.view','customer.notes',
            'invoice.view','invoice.create',
            'payment.view','payment.process',
            'crm.view','crm.create',
            'admin.access',
        ]);

        $customer = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);
        // Customers don't need admin permissions

        echo "✅ Roles and permissions seeded.\n";
    }
}
