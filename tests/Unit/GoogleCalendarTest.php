<?php

namespace Ldiazjaramillo\GoogleCalendar\Test\Unit;

use Mockery;
use Google_Service_Calendar;
use Ldiazjaramillo\GoogleCalendar\GoogleCalendar;

class GoogleCalendarTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Mockery\Mock|Google_Service_Calendar */
    protected $googleServiceCalendar;

    /** @var string */
    protected $calendarId;

    /** @var \Ldiazjaramillo\GoogleCalendar\GoogleCalendar */
    protected $googleCalendar;

    public function setUp()
    {
        parent::setUp();

        $this->googleServiceCalendar = Mockery::mock(Google_Service_Calendar::class);

        $this->calendarId = 'abc123';

        $this->googleCalendar = new GoogleCalendar($this->googleServiceCalendar, $this->calendarId);
    }

    /** @test */
    public function it_provides_a_getter_for_calendarId()
    {
        $this->assertEquals($this->calendarId, $this->googleCalendar->getCalendarId());
    }
}
