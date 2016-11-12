<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Currency ;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $url = 'http://api.fixer.io/latest?base='.env('APP_CURRENCY');
      $rates = json_decode(file_get_contents($url), true);
      if($rates){
        $currency = Currency::firstOrNew([ 
          'currency'  => env('APP_CURRENCY'),
          'rate'      => '1'
        ]);
        $currency->currency = env('APP_CURRENCY') ;
        $currency->rate = 1 ;
        $currency->save() ;
        foreach($rates['rates'] as $code => $rate){
          $currency = Currency::firstOrNew([ 
            'currency'  => $code
          ]);
          $currency->currency = $code ;
          $currency->rate = $rate ;
          $currency->save() ;
        }
        return $this->line(trans('currencies.currencies').' '.trans('crud.updated')) ;
      } else{
        return $this->error(trans('currencies.currencies').' '.trans('crud.failed')) ;
      }
    }
}
