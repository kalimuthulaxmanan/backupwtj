<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use DB;
use App\Http\Controllers\ImportExcelData;


class DomainStatusCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import excel data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		
		$importdata=DB::table('files_directory')->where('status', 0)->get();
		//print_r(file_get_contents('http://kenhike.com//robots.txt'));
		
		foreach($importdata as $key=>$value)
		{
				
			
				$ImportExcelData=new ImportExcelData();
			$ImportExcelData->importExcel($value->file_path.'/'.$value->file_name);
			
				DB::table('files_directory')->where('id', $value->id)->update(array('status' => 1));
		
			
		}

    }
}
