<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kelas;
use App\Models\UserModel;
use App\Models\MataKuliah;

class CrudUpdateDeleteTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (Kelas::count() === 0) {
            Kelas::create(['nama_kelas' => 'A']);
            Kelas::create(['nama_kelas' => 'B']);
        }
    }

    /** Test Mata Kuliah CRUD: Index & Create form */
    public function test_mata_kuliah_index_and_create_page(): void
    {
        $response = $this->get('/mata-kuliah');
        $response->assertStatus(200);
        $response->assertSee('Daftar Mata Kuliah');

        $responseCreate = $this->get('/mata-kuliah/create');
        $responseCreate->assertStatus(200);
        $responseCreate->assertSee('Buat Mata Kuliah Baru');
    }

    /** Test Mata Kuliah Store, Edit, Update, and Delete */
    public function test_mata_kuliah_crud_operations(): void
    {
        // 1. Store
        $responseStore = $this->post('/mata-kuliah', [
            'nama_mk' => 'Praktikum Web Lanjut',
            'sks' => 3,
        ]);
        $responseStore->assertRedirect('/mata-kuliah');
        $responseStore->assertSessionHas('success');

        $mk = MataKuliah::where('nama_mk', 'Praktikum Web Lanjut')->first();
        $this->assertNotNull($mk);
        $this->assertNotEmpty($mk->id); // UUID

        // 2. Edit Page
        $responseEdit = $this->get('/mata-kuliah/' . $mk->id . '/edit');
        $responseEdit->assertStatus(200);
        $responseEdit->assertSee('Edit Mata Kuliah');
        $responseEdit->assertSee($mk->nama_mk);

        // 3. Update
        $responseUpdate = $this->put('/mata-kuliah/' . $mk->id, [
            'nama_mk' => 'Praktikum Web Lanjut Updated',
            'sks' => 4,
        ]);
        $responseUpdate->assertRedirect('/mata-kuliah');
        $responseUpdate->assertSessionHas('success');

        $mk->refresh();
        $this->assertEquals('Praktikum Web Lanjut Updated', $mk->nama_mk);
        $this->assertEquals(4, $mk->sks);

        // 4. Delete
        $responseDelete = $this->delete('/mata-kuliah/' . $mk->id);
        $responseDelete->assertRedirect('/mata-kuliah');
        $responseDelete->assertSessionHas('success');

        $this->assertNull(MataKuliah::find($mk->id));
    }

    /** Test User CRUD: Index & Create page */
    public function test_user_index_and_create_page(): void
    {
        $response = $this->get('/user');
        $response->assertStatus(200);
        $response->assertSee('Daftar Pengguna');

        $responseCreate = $this->get('/user/create');
        $responseCreate->assertStatus(200);
        $responseCreate->assertSee('Buat Pengguna Baru');
    }

    /** Test User Store, Edit, Update, and Delete */
    public function test_user_crud_operations(): void
    {
        $kelas = Kelas::first();

        // 1. Store
        $responseStore = $this->post('/user', [
            'nama' => 'Muhammad Sultan Chaniago',
            'npm' => '2457051003',
            'kelas_id' => $kelas->id,
        ]);
        $responseStore->assertRedirect('/user');
        $responseStore->assertSessionHas('success');

        $user = UserModel::where('nim', '2457051003')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Muhammad Sultan Chaniago', $user->nama);

        // 2. Edit Page
        $responseEdit = $this->get('/user/' . $user->id . '/edit');
        $responseEdit->assertStatus(200);
        $responseEdit->assertSee('Edit Data Mahasiswa');
        $responseEdit->assertSee($user->nama);

        // 3. Update
        $responseUpdate = $this->put('/user/' . $user->id, [
            'nama' => 'Muhammad Sultan Chaniago Updated',
            'npm' => '2457051003',
            'kelas_id' => $kelas->id,
        ]);
        $responseUpdate->assertRedirect('/user');
        $responseUpdate->assertSessionHas('success');

        $user->refresh();
        $this->assertEquals('Muhammad Sultan Chaniago Updated', $user->nama);

        // 4. Delete
        $responseDelete = $this->delete('/user/' . $user->id);
        $responseDelete->assertRedirect('/user');
        $responseDelete->assertSessionHas('success');

        $this->assertNull(UserModel::find($user->id));
    }
}
