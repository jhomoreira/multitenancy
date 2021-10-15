<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ManagerTenant
{
    public function setConnection(Company $company)
    {
        DB::purge('tenant');

        Config::set('database.defaults', 'tenant');
        Config::set('database.connections.tenant.host', $company->db_hostname);
        Config::set('database.connections.tenant.database', $company->db_database);
        Config::set('database.connections.tenant.username', $company->db_username);
        Config::set('database.connections.tenant.password', $company->db_password);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();

    }
}