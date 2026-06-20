<?php

// use App\Models\Batch;
// use App\Models\Level;
// use App\Models\Module;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Support\Facades\DB;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
// use function Livewire\Livewire;

// uses(RefreshDatabase::class);

// describe('BatchModuleAssigner Component', function () {
//     beforeEach(function () {
//         $user = \App\Models\User::factory()->create();

//         Permission::findOrCreate('assign modules to batches');
//         Role::findOrCreate('admin');
//         $user->assignRole('admin');
//         $user->givePermissionTo('assign modules to batches');

//         $this->actingAs($user);
//     });

//     it('renders the component with available batches and modules', function () {
//         $level = Level::factory()->create();
//         Batch::factory()->create(['level_id' => $level->id]);
//         Module::factory()->create(['global_level_id' => null]);

//         $this->get('/admin/batch-module-assigner')
//             ->assertSee('Assign Modules to Batch');
//     });

//     it('assigns modules correctly for flexible modules', function () {
//         $level = Level::factory()->create();
//         $batch = Batch::factory()->create(['level_id' => $level->id]);
//         $modules = Module::factory()->count(2)->create(['global_level_id' => null]);

//         Livewire::test('admin.batches.batch-module-assigner')
//             ->set('batch_id', $batch->id)
//             ->set('selected_modules', $modules->pluck('id')->toArray())
//             ->call('save');

//         foreach ($modules as $module) {
//             $this->assertDatabaseHas('batch_level_module', [
//                 'batch_id' => $batch->id,
//                 'level_id' => $level->id,
//                 'module_id' => $module->id,
//             ]);
//         }
//     });

//     it('assigns modules only if level matches global_level_id', function () {
//         // $level = Level::factory()->create();
//         // $batch = Batch::factory()->create(['level_id' => $level->id]);
//         // $validModule = Module::factory()->create(['global_level_id' => $level->id]);
//         // $invalidModule = Module::factory()->create(['global_level_id' => $level->id + 1]);

//         $validLevel = Level::factory()->create();
//         $invalidLevel = Level::factory()->create(); // ensure it's a real level

//         $batch = Batch::factory()->create(['level_id' => $validLevel->id]);

//         $validModule = Module::factory()->create(['global_level_id' => $validLevel->id]);
//         $invalidModule = Module::factory()->create(['global_level_id' => $invalidLevel->id]); 


//         Livewire::test('admin.batches.batch-module-assigner')
//             ->set('batch_id', $batch->id)
//             ->set('selected_modules', [$validModule->id])
//             ->call('save');

//         // $this->assertDatabaseHas('batch_level_module', [
//         //     'batch_id' => $batch->id,
//         //     'level_id' => $level->id,
//         //     'module_id' => $validModule->id,
//         // ]);

//         $this->assertDatabaseHas('batch_level_module', [
//             'batch_id' => $batch->id,
//             'level_id' => $validLevel->id, //correct variable
//             'module_id' => $validModule->id,
//         ]);
        

//         $this->assertDatabaseMissing('batch_level_module', [
//             'module_id' => $invalidModule->id,
//         ]);
//     });
// });
