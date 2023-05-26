<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\DashboardController;
use App\Services\Api\WondeApi;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Mockery;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{

    private function getDashboardController()
    {
        $client = Mockery::mock(WondeApi::class, function ($mock) {
            $mock->shouldReceive('getEmployees')->andReturn($this->loadTestData('employee_data.json')['data']);
            $mock->shouldReceive('getClass')->andReturn($this->loadTestData('class_data.json')['data']);
        });

        return new DashboardController($client);
    }

    private function getRequestMock()
    {
        $request = Mockery::mock(Request::class);
        $request->shouldReceive('validate')->once()->with([
            'employeeId' => ['string', 'nullable'],
            'date' => ['date', 'nullable']
        ]);
        return $request;
    }

    public function testShowMethodReturnsResponse()
    {
        $controller = $this->getDashboardController();

        $request = $this->getRequestMock();
        $request->shouldReceive('has')->with('employeeId')->andReturn(false);
        $request->shouldReceive('get')->with('date')->andReturn(null);

        $response = $controller->show($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShowMethodAcceptsValidEmployeeId()
    {
        $controller = $this->getDashboardController();

        
        $request = $this->getRequestMock();
        $request->shouldReceive('has')->with('employeeId')->andReturn(true);
        $request->shouldReceive('get')->with('employeeId')->andReturn('A2082387062');
        $request->shouldReceive('get')->with('date')->andReturn(null);

        $response = $controller->show($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShowMethodHandlesInvalidEmployeeId()
    {
        $controller = $this->getDashboardController();

        
        $request = $this->getRequestMock();
        $request->shouldReceive('has')->with('employeeId')->andReturn(true);
        $request->shouldReceive('get')->with('employeeId')->andReturn('INVALID');
        $request->shouldReceive('get')->with('date')->andReturn(null);

        $response = $controller->show($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShowMethodAcceptsValidDate()
    {
        $controller = $this->getDashboardController();

        
        $request = $this->getRequestMock();
        $request->shouldReceive('has')->with('employeeId')->andReturn(false);
        $request->shouldReceive('get')->with('date')->andReturn('2023-5-26');

        $response = $controller->show($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testShowMethodHandlesInvalidDate()
    {
        $this->expectException(InvalidFormatException::class);
        $controller = $this->getDashboardController();

        
        $request = $this->getRequestMock();
        $request->shouldReceive('has')->with('employeeId')->andReturn(false);
        $request->shouldReceive('get')->with('date')->andReturn('INVALID');

        $controller->show($request);
    }

    public function testShowMethodAcceptsValidInputs()
    {
        $controller = $this->getDashboardController();

        
        $request = $this->getRequestMock();
        $request->shouldReceive('has')->with('employeeId')->andReturn(true);
        $request->shouldReceive('get')->with('employeeId')->andReturn('A2082387062');
        $request->shouldReceive('get')->with('date')->andReturn('2023-5-26');

        $response = $controller->show($request);

        $this->assertInstanceOf(Response::class, $response);
    }
}
