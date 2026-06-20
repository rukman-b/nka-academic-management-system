<?php

use App\Models\SkillCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('SkillCategoryManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create(['email' => 'admin@example.com']);

        Permission::findOrCreate('view skillcategories');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view skillcategories');

        $this->actingAs($user);
    });

    it('renders the skill category manager component successfully', function () {
        $this->get('/admin/skill-categories')
            ->assertSee('Add New Skill Category')
            ->assertSee('Existing Skill Categories');
    });

    it('can create a new skill category', function () {
        Livewire::test('admin.skill-categories.skill-category-manager')
            ->set('name', 'Innovation')
            ->call('create');

        expect(SkillCategory::where('name', 'Innovation')->exists())->toBeTrue();
    });

    it('can update an existing skill category', function () {
        $category = SkillCategory::factory()->create(['name' => 'Old Name']);

        Livewire::test('admin.skill-categories.skill-category-manager')
            ->call('edit', $category->id)
            ->set('name', 'Updated Category')
            ->call('update');

        expect(SkillCategory::find($category->id)->name)->toBe('Updated Category');
    });

    it('can delete a skill category', function () {
        $category = SkillCategory::factory()->create();

        Livewire::test('admin.skill-categories.skill-category-manager')
            ->call('delete', $category->id);

        expect(SkillCategory::find($category->id))->toBeNull();
    });
});
