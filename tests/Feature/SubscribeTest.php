<?php

namespace Tests\Feature;

use App\Services\Unisender\Contracts\Unisender;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscribeTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_subscription_page()
    {
        $this->get(route('subscribe.form'))
            ->assertStatus(200)
            ->assertSee('name="email"')
            ->assertSee('name="name"')
            ->assertSee('type="submit"');
    }

    function test_an_email_is_required()
    {
        $this->post(route('subscribe'), [
            'name' => 'Vasya Pupkin',
        ])->assertSessionHasErrors('email');
    }

    function test_an_email_should_be_corect_email_address()
    {
        $this->post(route('subscribe'), [
            'name' => 'Vasya Pupkin',
            'email' => 'test'
        ])->assertSessionHasErrors('email');
    }

    function test_a_name_is_required()
    {
        $this->post(route('subscribe'), [
            'email' => 'test@site.com',
        ])->assertSessionHasErrors('name');
    }

    function test_success_subscribe()
    {
        $client = $this->mock(Unisender::class);

        $client->shouldReceive('importContacts')->once()->with([
            'field_names' => [
                'Name', 'email', 'email_status'
            ],
            'data' => [
                [
                    'Vasya Pupkin',
                    'test@site.com',
                    'active'
                ]
            ]
        ]);

        $this->post(route('subscribe'), [
            'name' => 'Vasya Pupkin',
            'email' => 'test@site.com',
        ])
            ->assertRedirect(route('subscribe.form'))
            ->assertSessionHas('success', 'Вы успешно подписаны на рассылку новостей');

        $this->assertDatabaseHas('subscriptions', [
            'name' => 'Vasya Pupkin',
            'email' => 'test@site.com',
        ]);
    }
}
