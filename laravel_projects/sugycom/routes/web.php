<?php

use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ResearcherController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\CrudexampleController;
use App\Http\Controllers\Trigger_planController;
use App\Http\Controllers\OndutyController;
use App\Http\Controllers\SpecialeventController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/note', NoteController::class);
    
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('setting', [SettingController::class, 'update'])->name('setting.update');
    Route::get('setting/store/{param?}', [SettingController::class, 'store'])->name('setting.store');
    Route::get('setting/show/{param?}', [SettingController::class, 'show'])->name('setting.show');
    
    Route::get('trigger/{starttime?}/{endtime?}', [Trigger_planController::class, 'index'])->name('trigger.index');
    Route::post('trigger', [Trigger_planController::class, 'trigger'])->name('trigger.trigger');
    Route::post('compress', [Trigger_planController::class, 'compress'])->name('trigger.compress');
    Route::get('sender/{param?}', [Trigger_planController::class, 'sender'])->name('trigger.sender');
    Route::get('select/{data_item?}', [Trigger_planController::class, 'select'])->name('trigger.select');
    Route::get('table/{param?}/{data_item?}', [Trigger_planController::class, 'table'])->name('trigger.table');
    
    Route::resource('/crudexample', CrudexampleController::class    );
    Route::post(    'crudexample/export',                       [CrudexampleController::class,  'export'                ])->name('crudexample.db_options.export'    );
    Route::post(    'crudexample/import',                       [CrudexampleController::class,  'import'                ])->name('crudexample.db_options.import'    );
    Route::get(     'crudexample/step/{param?}',                [CrudexampleController::class,  'step'                  ])->name('crudexample.db_options.step'      );
    Route::get(     'crudexample/show_rows/{param?}',           [CrudexampleController::class,  'show_rows'             ])->name('crudexample.db_options.show_rows' );
    Route::post(    'crudexample/send-message/{crudexample?}',  [CrudexampleController::class,  'sendTelegramMessage'   ])->name('crudexample.sendTelegramMessage'  );
    Route::post(    'crudexample/mailme/{crudexample?}',        [CrudexampleController::class,  'mailme'                ])->name('crudexample.mailme'               );
    
    Route::resource('/priority', PriorityController::class          );
    Route::post(    'priority/export',                          [PriorityController::class,     'export'                ])->name('priority.db_options.export'       );
    Route::post(    'priority/import',                          [PriorityController::class,     'import'                ])->name('priority.db_options.import'       );
    Route::get(     'priority/step/{param?}',                   [PriorityController::class,     'step'                  ])->name('priority.db_options.step'         );
    Route::get(     'priority/show_rows/{param?}',              [PriorityController::class,     'show_rows'             ])->name('priority.db_options.show_rows'    );
    Route::post(    'priority/send-message/{priority?}',        [PriorityController::class,     'sendTelegramMessage'   ])->name('priority.sendTelegramMessage'     );
    
    Route::resource('/researcher', ResearcherController::class      );
    Route::post(    'researcher/export',                        [ResearcherController::class,   'export'                ])->name('researcher.db_options.export'     );
    Route::post(    'researcher/import',                        [ResearcherController::class,   'import'                ])->name('researcher.db_options.import'     );
    Route::get(     'researcher/step/{param?}',                 [ResearcherController::class,   'step'                  ])->name('researcher.db_options.step'       );
    Route::get(     'researcher/show_rows/{param?}',            [ResearcherController::class,   'show_rows'             ])->name('researcher.db_options.show_rows'  );
    Route::post(    'researcher/send-message/{researcher?}',    [ResearcherController::class,   'sendTelegramMessage'   ])->name('researcher.sendTelegramMessage'   );
    
    Route::resource('/onduty', OndutyController::class              );
    Route::post(    'onduty/export',                            [OndutyController::class,   'export'                    ])->name('onduty.db_options.export'         );
    Route::post(    'onduty/import',                            [OndutyController::class,   'import'                    ])->name('onduty.db_options.import'         );
    Route::get(     'onduty/step/{param?}',                     [OndutyController::class,   'step'                      ])->name('onduty.db_options.step'           );
    Route::get(     'onduty/show_rows/{param?}',                [OndutyController::class,   'show_rows'                 ])->name('onduty.db_options.show_rows'      );
    Route::post(    'onduty/send-message/{onduty?}',            [OndutyController::class,   'sendTelegramMessage'       ])->name('onduty.sendTelegramMessage'       );  
    
    Route::resource('/specialevent', SpecialeventController::class              );
    Route::post(    'specialevent/export',                              [SpecialeventController::class,   'export'                    ])->name('specialevent.db_options.export'         );
    Route::post(    'specialevent/import',                              [SpecialeventController::class,   'import'                    ])->name('specialevent.db_options.import'         );
    Route::get(     'specialevent/step/{param?}',                       [SpecialeventController::class,   'step'                      ])->name('specialevent.db_options.step'           );
    Route::get(     'specialevent/show_rows/{param?}',                  [SpecialeventController::class,   'show_rows'                 ])->name('specialevent.db_options.show_rows'      );
    Route::post(    'specialevent/send-message/{specialevent?}',        [SpecialeventController::class,   'sendTelegramMessage'       ])->name('specialevent.sendTelegramMessage'       );  
    
});

require __DIR__.'/auth.php';
