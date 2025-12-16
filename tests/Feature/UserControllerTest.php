<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Http\Controllers\UserController;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $userController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userController = new UserController();
    }

    public function test_store()
    {
        // Prepare the CreateUserRequest with valid data
        $data = [
            'username' => $this->faker->userName,
            'email' => $this->faker->safeEmail,
            'name' => $this->faker->name,
            'branche_id' => 1,
            // Add other required fields here
        ];

        $request = CreateUserRequest::create('/store', 'POST', $data);

        // Mock the CreateUserRequest object
        // $mockRequest = $this->createMock(CreateUserRequest::class);
        // $mockRequest->method('all')->willReturn($data);

        // Execute the store method with the mocked request
        $response = $this->userController->store($request);

        // Assert that a user has been created with the expected attributes
        $this->assertDatabaseHas('users', [
            'username' => $data['username'],
            'email' => $data['email'],
            // Add other required fields here
            'branch_id' => 1,
            'pass_need_to_be_changed' => 1,
        ]);

        // Assert that the password has been hashed
        $createdUser = User::where('username', $data['username'])->first();
        $this->assertTrue(Hash::check($data['username'] . '@demo', $createdUser->password));

        // Assert that a RedirectResponse is returned and user is redirected to the expected route
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('users.index'), $response->headers->get('location'));
    }
}