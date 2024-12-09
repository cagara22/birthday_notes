<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:send-greeting')->dailyAt('14:11')->timezone('Asia/Manila');
