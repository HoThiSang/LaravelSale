<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\Bills;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->check()) {
            $customer_id = Auth()->user()->id;

            $customer = User::getUserById($customer_id);

            // Kiểm tra xem khách hàng có tồn tại hay không
            if (!$customer) {
                $message = 'success';
                return view('pages/checkout', compact('customer', 'message'));
            } else {
                // Chuyển dữ liệu khách hàng vào view
                return view('pages/checkout', compact('customer'));
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {

    //     if (Auth()->check()) {

    //         //     dd(Auth()->check());
    //         if (Session::has('cart')) {
    //             $cart =   Session::get('cart');

    //             if ($request->isMethod('post')) {

    //                 $rules = [
    //                     'user_name' => 'required',
    //                     'gender' => 'required',
    //                     'email' => 'required|email|regex:/^.+@.+$/i',
    //                     'phone' => 'required|regex:/^\d{10}$/',
    //                     'address' => 'required',
    //                 ];
    //                 $messages = [
    //                     'email.required' => 'The email field is must required',
    //                     'email.regex' => 'Invalid email format.',
    //                     'phone.required' => 'The phone field is must required',
    //                     'phone.regex' => 'Phone number must be 10 digits.',
    //                     'address.required' => 'The address field is must required'
    //                 ];

    //                 $validateData = Validator::make($request->all(), $rules, $messages);

    //                 if ($validateData->fails()) {
    //                     return redirect()->back()->withErrors($validateData);
    //                 } else {
    //                     if ($request->payment_method == 'COD') {
    //                         $customer_id = $request->customer_id;
    //                         $billData = [
    //                             'id_customer' => $customer_id,
    //                             'date_order' => now(),
    //                             'total' => $request->totalPrice,
    //                             'payment' => $request->payment_method,
    //                             'note' => $request->note,
    //                             'created_at' => now()

    //                         ];
    //                         $bill = new Bills();
    //                         $bill_id  = $bill->creatNewBill($billData);
    //                         if ($bill) {
    //                             foreach ($cart->items as $key => $value) {
    //                                 $bill_detail = new BillDetail();
    //                                 $bill_detail->id_bill = $bill_id;
    //                                 $bill_detail->id_product = $key;
    //                                 $bill_detail->quantity = $value['qty'];
    //                                 $bill_detail->unit_price = $value['price'] / $value['qty'];
    //                                 $bill_detail->save();
    //                             }
    //                             session()->forget('cart');
    //                             return redirect()->route('show-bill')->with('success', 'Checkout successfully !');
    //                         }
    //                         return redirect()->route('home')->with('error', 'Checkout Failure  !');
    //                     } else {

    //                         if ($request->isMethod('post')) {
    //                             $rules = [
    //                                 'username' => 'required',
    //                                 'email' => 'required|email|regex:/^.+@.+$/i',
    //                                 'phone' => 'required|regex:/^\d{10}$/',
    //                                 'address' => 'required',
    //                             ];
    //                             $messages = [
    //                                 'email.required' => 'The email field is must required',
    //                                 'email.regex' => 'Invalid email format.',
    //                                 'phone.required' => 'The phone field is must required',
    //                                 'phone.regex' => 'Phone number must be 10 digits.',
    //                                 'address.required' => 'The address field is must required'
    //                             ];

    //                             $validateData = Validator::make($request->all(), $rules, $messages);

    //                             if ($validateData->fails()) {
    //                                 return redirect()->back()->withErrors($validateData);
    //                             } else {

    //                                 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //                                     if (auth()->check()) {


    //                                         error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    //                                         date_default_timezone_set('Asia/Ho_Chi_Minh');

    //                                         $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //                                         $vnp_Returnurl = "http://127.0.0.1:8000/is-checkout-success";
    //                                         $vnp_TmnCode = 'X1WL3I2L';
    //                                         $vnp_HashSecret = "SFBDIRUMYOSNUZGWWYKVLQSKEDOSOXWY";

    //                                         $vnp_TxnRef = rand(00, 9999);

    //                                         $vnp_OrderInfo = "Noi dung thanh toan";
    //                                         $vnp_OrderType = "billpayment";
    //                                         $vnp_Amount = $request->totalPrice * 100;
    //                                         $vnp_Locale = "vn";
    //                                         $vnp_BankCode = "NCB";
    //                                         $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //                                         $phone = $request->phone;
    //                                         $email = $request->email;
    //                                         $username = $request->username;
    //                                         $address = $request->address;
    //                                         $vnp_Bill_Mobile = $phone;
    //                                         $vnp_Bill_Email = $email;
    //                                         $vnp_User_Id = $request->user_id;
    //                                         $fullName = trim($username);
    //                                         if (isset($fullName) && trim($fullName) != '') {
    //                                             $name = explode(' ', $fullName);
    //                                             $vnp_Bill_FirstName = array_shift($name);
    //                                             $vnp_Bill_LastName = array_pop($name);
    //                                         }
    //                                         $vnp_address = trim($address);
    //                                         $dataInfor = ['user_id' => $vnp_User_Id, 'username' => $vnp_Bill_FirstName . $vnp_Bill_LastName, 'phone' => $vnp_Bill_Mobile, 'email' => $vnp_Bill_Email, 'address' => $vnp_address];
    //                                         Session::put('user_info', $dataInfor);
    //                                         $inputData = array(
    //                                             "vnp_Version" => "2.1.0",
    //                                             "vnp_Amount" => $vnp_Amount,
    //                                             "vnp_Command" => "pay",
    //                                             "vnp_CreateDate" => date('YmdHis'),
    //                                             "vnp_CurrCode" => "VND",
    //                                             "vnp_IpAddr" => $vnp_IpAddr,
    //                                             "vnp_Locale" => $vnp_Locale,
    //                                             "vnp_OrderInfo" => $vnp_OrderInfo,
    //                                             "vnp_OrderType" => $vnp_OrderType,
    //                                             "vnp_ReturnUrl" => $vnp_Returnurl,
    //                                             "vnp_TmnCode" => $vnp_TmnCode,
    //                                             "vnp_TxnRef" => $vnp_TxnRef,
    //                                             "vnp_Bill_Mobile" => $vnp_Bill_Mobile, // Thêm thông tin khách hàng vào URL
    //                                             "vnp_Bill_Email" => $vnp_Bill_Email,
    //                                             'vnp_Bill_FirstName' => $vnp_Bill_FirstName,
    //                                             'vnp_Bill_LastName' => 'vnp_Bill_LastName'


    //                                         );

    //                                         if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //                                             $inputData['vnp_BankCode'] = $vnp_BankCode;
    //                                         }


    //                                         //var_dump($inputData);
    //                                         ksort($inputData);
    //                                         $query = "";
    //                                         $i = 0;
    //                                         $hashdata = "";
    //                                         foreach ($inputData as $key => $value) {
    //                                             if ($i == 1) {
    //                                                 $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //                                             } else {
    //                                                 $hashdata .= urlencode($key) . "=" . urlencode($value);
    //                                                 $i = 1;
    //                                             }
    //                                             $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //                                         }

    //                                         $vnp_Url = $vnp_Url . "?" . $query;
    //                                         if (isset($vnp_HashSecret)) {
    //                                             $vnpSecureHash =   hash_hmac('sha512', $hashdata, getenv('VNP_HASHSECRET')); //  
    //                                             $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    //                                         }
    //                                         // return response()->json($vnp_Url);
    //                                         $returnData = array(
    //                                             'code' => '00', 'message' => 'success', 'data' => $vnp_Url
    //                                         );
    //                                         if (isset($_POST['redirect'])) {
    //                                             header('Location: ' . $vnp_Url);
    //                                             die();
    //                                         } else {
    //                                             echo json_encode($returnData);
    //                                         }
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return redirect()->route('login')->with('error', 'You are not login !');
    // }

    public function store(Request $request)
    {
  
        if (Auth::check()) {
     
            if (Session::has('cart')) {
                $cart = Session::get('cart');

                if ($request->isMethod('post')) {

                    $rules = [
                        'user_name' => 'required',
                        'gender' => 'required',
                        'email' => 'required|email',
                        'phone' => 'required|regex:/^\d{10}$/',
                        'address' => 'required',
                        'payment_method' => 'required|in:COD,VNPAY' 
                    ];

                    $messages = [
                        'phone.regex' => 'Phone number must be 10 digits.'
                    ];

                    $validator = Validator::make($request->all(), $rules, $messages);

                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $customer_id = Auth::id();
                    $billData = [
                        'id_customer' => $customer_id,
                        'date_order' => now(),
                        'total' => $request->totalPrice,
                        'payment' => $request->payment_method,
                        'note' => $request->note,
                        'created_at' => now()
                    ];

                    $bill = new Bills();
                    $bill_id  = $bill->creatNewBill($billData);

                    if ($bill_id) {
                        foreach ($cart->items as $key => $value) {
                            $bill_detail = new BillDetail();
                            $bill_detail->id_bill = $bill_id;
                            $bill_detail->id_product = $key;
                            $bill_detail->quantity = $value['qty'];
                            $bill_detail->unit_price = $value['price'] / $value['qty'];
                            $bill_detail->save();
                        }

                        Session::forget('cart');
                        return redirect()->route('show-bill')->with('success', 'Checkout successfully !');
                    } else {
                        return redirect()->route('home')->with('error', 'Checkout Failure  !');
                    }
                }
            } else {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You are not logged in.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    public function showBill()
    {
        $check = false;
        if (Auth()->check()) {
            $customer_id = Auth()->user()->id;
            $customerBills = Bills::where('id_customer', $customer_id)->get();
            $check = true;
            return view('pages/bills', compact('customerBills', 'check'));
        } else {
            return view('pages/bills', compact('check'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
