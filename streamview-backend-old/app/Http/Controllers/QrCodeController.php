<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\UserPayment;
use App\PayPerView;
use App\Cods;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Jobs\SendEmailJob;
use DB;
DB:: enableQueryLog();
class QrCodeController extends Controller
{
    public function index(Request $request)
    {   
        date_default_timezone_set("Asia/Kolkata");
        

        $admin_details = UserPayment::where('payment_mode', COD)->where('payment_id', '=',685000360522203)->where('QR_Expiry_date', '>=', date('Y-m-d : h:i:s A'))->first();
        if($admin_details)
        {
            $update_userpayment = UserPayment::where('payment_id', '=', 685000360522203)->update(array('status' => 1));
            if($update_userpayment)
            {
                //send Email
            }
        }
        
        

        $useremail = User::where('id',$admin_details->user_id)->first();
        
        $email = $useremail->email;
        $user_details = $useremail->name . ' & TransactionId :'. $request->transaction_id;
      
       
        $transaction_id = $admin_details->payment_id;
        $amount = $admin_details->amount;
        //$details = 'UserEmail: '.$email.' Transaction_id: '.$transaction_id.' Amount: ' . $admin_details->amount;

        $user_email = $email;
        $Transactionid = $transaction_id; 
        $amount = $admin_details->amount;
        //dd($Transactionid);
        if($request->payment_id != '')
        {
            $update_payperview = PayPerView::where('payment_id', '=', 224047507919733)->update(array('status' => 1));
            if($update_payperview)
            {
                if($request->payment_id == '') {

                    $email_data['subject'] = tr('user_welcome_title').' '.Setting::get('site_name');
    
                    $email_data['page'] = "emails.admin_user_welcome";
    
                    $email_data['data'] = $user_details;
                    
                    $email_data['email'] = $useremail->email;
    
                    $email_data['password'] = $new_password;
    
                    $email_data['content'] = Helper::get_email_content(COD_PAYMENT_SUCCESS,$email_data);
    
                    $this->dispatch(new SendEmailJob($email_data));
    
                    // Check the default subscription and save the user type for new user 
                    user_type_check($user_details->id);
    
                }
            }
        }
      
                    
                    
        return view('admin.sub_admins.qrcode')->with([
            'user_email' => $user_email,'Transactionid' =>$Transactionid,'amount' => $amount
        ]);
    }


    public function qrcode(Request $req)
    {
        $admin_details = UserPayment::where('payment_id', $req->payment_id)->first();
        $email = $admin_details->email;
        $transaction_id = $req->payment_id;
        $amount = $admin_details->amount;
        $details = 'UserEmail: '.$email.' Transaction_id: '.$transaction_id.' Amount: ' . 25;
                    
        return view('admin')->with('admin_details1' ,$details);
    }

    

        
    
}
