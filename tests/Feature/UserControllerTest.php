<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Person;
use App\Models\Company;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Skip tests if the table doesn't exist (e.g. SQLite memory DB)
        if (!Schema::hasTable('user')) {
            $this->markTestSkipped('La tabla "user" no existe en este entorno de base de datos.');
        }
    }

    public function test_admin_can_create_new_person_user()
    {
        $admin = User::where('rol_id', 1)->first();
        if (!$admin) {
            $admin = User::factory()->create(['rol_id' => 1]);
        }

        $email = 'new.user.' . time() . '@talentum.edu.pe';
        $response = $this->actingAs($admin)->postJson('/admin/users', [
            'names' => 'Juan Perez Test',
            'email' => $email,
            'phone' => '987654321',
            'role_id' => 3, // ESTUDIANTE
            'doc_type' => 'DNI',
            'doc_number' => '77889922',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Usuario creado exitosamente.'
                 ]);

        $this->assertDatabaseHas('user', [
            'email' => $email,
            'rol_id' => 3
        ]);

        $this->assertDatabaseHas('person', [
            'names' => 'Juan Perez Test',
            'document_number' => '77889922'
        ]);
    }

    public function test_admin_can_create_new_company_user()
    {
        $admin = User::where('rol_id', 1)->first();
        
        $email = 'company.test.' . time() . '@technova.pe';
        $response = $this->actingAs($admin)->postJson('/admin/users', [
            'names' => 'Tech Test S.A.C.',
            'email' => $email,
            'phone' => '912345678',
            'role_id' => 4, // EMPRESA
            'doc_type' => 'RUC',
            'doc_number' => '20112233445',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Usuario creado exitosamente.'
                 ]);

        $this->assertDatabaseHas('user', [
            'email' => $email,
            'rol_id' => 4
        ]);

        $this->assertDatabaseHas('job_opportunity_company', [
            'name' => 'Tech Test S.A.C.',
            'ruc' => '20112233445'
        ]);
    }

    public function test_admin_can_toggle_user_status()
    {
        $admin = User::where('rol_id', 1)->first();
        $targetUser = User::where('id', '!=', $admin->id)->first();

        if ($targetUser) {
            $initialState = $targetUser->is_active;

            $response = $this->actingAs($admin)->postJson("/admin/users/{$targetUser->id}/toggle-status");

            $response->assertStatus(200)
                     ->assertJson([
                         'success' => true,
                         'is_active' => !$initialState
                     ]);
        }
    }

    public function test_admin_can_change_user_password()
    {
        $admin = User::where('rol_id', 1)->first();
        $targetUser = User::where('id', '!=', $admin->id)->first();

        if ($targetUser) {
            $response = $this->actingAs($admin)->postJson("/admin/users/{$targetUser->id}/change-password", [
                'password' => 'NewPassword2026*'
            ]);

            $response->assertStatus(200)
                     ->assertJson([
                         'success' => true,
                         'message' => 'Contraseña actualizada exitosamente.'
                     ]);

            $targetUser->refresh();
            $this->assertTrue(Hash::check('NewPassword2026*', $targetUser->password));
        }
    }
}
