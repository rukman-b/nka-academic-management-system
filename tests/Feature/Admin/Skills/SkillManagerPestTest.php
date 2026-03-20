<?php

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Livewire\Livewire;

uses(RefreshDatabase::class);

describe('SkillManager Component', function () {
    beforeEach(function () {
        $user = \App\Models\User::factory()->create(['email' => 'admin@example.com']);

        Permission::findOrCreate('view skills');
        Role::findOrCreate('admin');
        $user->assignRole('admin');
        $user->givePermissionTo('view skills');

        $this->actingAs($user);
    });

    it('renders the skill manager component successfully', function () {
        $this->get('/admin/skills')
            ->assertSee('Add New Skill')
            ->assertSee('Existing Skills');
    });

    it('can create a new skill', function () {
        $category = SkillCategory::factory()->create();

        Livewire::test('admin.skills.skill-manager')
            ->set('name', 'Team Leadership')
            ->set('skill_category_id', $category->id)
            ->call('create');

        expect(Skill::where('name', 'Team Leadership')->exists())->toBeTrue();
    });

    it('can update an existing skill', function () {
        $skill = Skill::factory()->create();
        $category = SkillCategory::factory()->create();

        Livewire::test('admin.skills.skill-manager')
            ->call('edit', $skill->id)
            ->set('name', 'Updated Skill')
            ->set('skill_category_id', $category->id)
            ->call('update');

        expect(Skill::find($skill->id)->name)->toBe('Updated Skill');
    });

    it('can delete a skill', function () {
        $skill = Skill::factory()->create();

        Livewire::test('admin.skills.skill-manager')
            ->call('delete', $skill->id);

        expect(Skill::find($skill->id))->toBeNull();
    });
});
