<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $values = [
            'Dashboard',
            'Leads',
            'Create Lead',
            'Edit Lead',
            'Show Lead',
            'Convert Lead To Quotation',
            'Import Lead',
            'Delete Lead',

            'Defaults',

            'Customers',
            'Create Customer',
            'Edit Customer',
            'Show Customer',
            'Show Statements',
            'Delete Customer',


            'Quotations',
            'Edit Quotation',
            'Show Quotation',
            'Delete Quotation',
            'Quotation Transactions',
            'Quotation Options',
            'Quoted Request',


            'Policies',
            'Policy',
            'Create Policy',
            'Edit Policy',
            'Show Policy',
            'Delete Policy',

            'Dispatch Policies',
            'Fill Dispatch Policy',
            'Edit Dispatch Policy',
            'Show Dispatch Policy',
            'Delete Dispatch Policy',

            'User Management',
            'Users',
            'Online Users',
            'Roles',
            'Permissions',

            'Insurance companies',
            'Create Insurance company',
            'Edit Insurance company',
            'Show Insurance company',
            'Delete Insurance company',

            'Lead Status',
            'Create Lead Status',
            'Edit Lead Status',
            'Show Lead Status',
            'Delete Lead Status',

            'Lead Type',
            'Create Lead Type',
            'Edit Lead Type',
            'Show Lead Type',
            'Delete Lead Type',

            'Courier Company',


            'Lead Source',
            'Create Lead Source',
            'Edit Lead Source',
            'Show Lead Source',
            'Delete Lead Source',

            'Agencies',
            'Create Agency',
            'Edit Agency',
            'Show Agency',
            'Delete Agency',

            'Sales',
            'Receipts',
            'Approve Payment Receipt',

            'Support',
            'Reports',
            'Expenses',
            'Edit Expense',
            'Delete Expense',
            'Show Expense',
            'Delete All Expense',

            'Settings',
            'Change Password Settings',
            'My Account Settings',
            'Company Detail Settings',


            'Expense Categories',
            'Create Expense Category',
            'Show Expense Category',
            'Edit Expense Category',
            'Delete Expense Category',
            'Delete All Expense Category',

            'Renewal Policies',
            'Renewal Delete',

            'Claims',
            'Show Claims',
            'Delete Claims'

        ];

        foreach($values as $value){
            $permission = Permission::create(['name' => $value, 'guard_name' => 'administrator']);
        }

        $permissions    = Permission::all();

        $admin_role     = Role::where('name', 'Admin')->first();
        $admin_role->syncPermissions($permissions);

        $staff_role     = Role::where('name', 'Staff')->first();
        $staff_role->syncPermissions($permissions);

        $team_leader_role = Role::where('name', 'Claim')->first();
        $team_leader_role->syncPermissions($permissions);

        $chardham_role     = Role::where('name', 'Account')->first();
        $chardham_role->syncPermissions($permissions);

        $joinee_role     = Role::where('name', 'Renewal')->first();
        $joinee_role->syncPermissions($permissions);

        $joinee_role     = Role::where('name', 'Sales')->first();
        $joinee_role->syncPermissions($permissions);

        $joinee_role     = Role::where('name', 'Service Executive')->first();
        $joinee_role->syncPermissions($permissions);
    }
}
