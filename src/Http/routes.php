<?php

use Illuminate\Support\Facades\Route;

Route::get('latest', 'Stanbridge\VisualException\Http\Controllers\VisualExceptionController@__invoke');
