<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Exception, Setting, DB;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport, App\Exports\ModeratorsExport, App\Exports\AdminVideosExport, App\Exports\UserPaymentsExport, App\Exports\PayPerViewExport;

class AdminExportController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');  
    }
    
    /**
	 * Function Name: users_export()
	 *
	 * @usage used export the users details into the selected format
	 *
	 * @created Vidhya R
	 *
	 * @edited Vidhya R
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function users_export(Request $request) {

    	try {

    		$formats = [ 'xlsx' => '.xlsx', 'csv' => '.csv', 'xls' => '.xls', 'pdf' => '.pdf'];

        	$file_format = isset($formats[$request->format]) ? $formats[$request->format] : '.xlsx';

        	$filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid().$file_format;

        	return Excel::download(new UsersExport($request), $filename);



		} catch(\Exception $e) {

            return redirect()->route('admin.users.index')->with('flash_error' , $e->getMessage());

        }

    }

    /**
	 * Function Name: moderators_export()
	 *
	 * @usage used export the moderators details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function moderators_export(Request $request) {

    	try {

    		$formats = [ 'xlsx' => '.xlsx', 'csv' => '.csv', 'xls' => '.xls', 'pdf' => '.pdf'];

        	$file_format = isset($formats[$request->format]) ? $formats[$request->format] : '.xlsx';

        	$filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid().$file_format;

        	return Excel::download(new ModeratorsExport, $filename);

		} catch(\Exception $e) {

            return redirect()->route('admin.moderators.index')->with('flash_error' , $e->getMessage());

        }

    }

    /**
	 * Function Name: videos_export()
	 *
	 * @usage used export the videos details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function videos_export(Request $request) {

    	try {

    		$formats = [ 'xlsx' => '.xlsx', 'csv' => '.csv', 'xls' => '.xls', 'pdf' => '.pdf'];

        	$file_format = isset($formats[$request->format]) ? $formats[$request->format] : '.xlsx';

        	$filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid().$file_format;

        	return Excel::download(new AdminVideosExport($request), $filename);

		} catch(\Exception $e) {

            return redirect()->route('admin.videos')->with('flash_error' , $e->getMessage());

        }

    }

    /**
	 * Function Name: subscription_export()
	 *
	 * @usage used export the subscription details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function subscription_export(Request $request) {

    	try {

    		$formats = [ 'xlsx' => '.xlsx', 'csv' => '.csv', 'xls' => '.xls', 'pdf' => '.pdf'];

        	$file_format = isset($formats[$request->format]) ? $formats[$request->format] : '.xlsx';

        	$filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid().$file_format;

        	return Excel::download(new UserPaymentsExport, $filename);

		} catch(\Exception $e) {

            return redirect()->route('admin.user.payments')->with('flash_error' , $e->getMessage());

        }

    }

    /**
	 * Function Name: payperview_export()
	 *
	 * @usage used export the video payperview details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function payperview_export(Request $request) {

    	try {

    		$formats = [ 'xlsx' => '.xlsx', 'csv' => '.csv', 'xls' => '.xls', 'pdf' => '.pdf'];

        	$file_format = isset($formats[$request->format]) ? $formats[$request->format] : '.xlsx';

        	$filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid().$file_format;

        	return Excel::download(new PayPerViewExport, $filename);

		} catch(\Exception $e) {

            return redirect()->route('admin.user.video-payments')->with('flash_error' , $e->getMessage());

        }

    }
}
