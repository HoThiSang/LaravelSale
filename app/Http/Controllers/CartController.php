<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public $cart;

    public function addToCart(Request $request, $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        $oldCart = Session('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('message', 'Add to cart successfully');
    }


    public function deleteCart(Request $request, $id)
    {
        $product = Products::find($id);
        if ($product) {
            if (Session::has('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $cart->removeItem($id);

                // Kiểm tra xem mục đã được xóa thành công hay không
                if ($cart->items && count($cart->items) > 0) {
                    Session::put('cart', $cart);
                    return redirect()->back()->with('message', 'Delete item from your cart successfully');
                } else {
                    Session::forget('cart');
                    return redirect()->back()->with('error', 'Cannot delete item from your cart successfully');
                }
            } else {
                return redirect()->back()->with('error', 'No items in your cart');
            }
        } else {
            return redirect()->back()->with('error', 'No items in your cart');
        }
    }


    public function checkout(Request $request)
    {
        if (Session::has('cart')) {
            $cart =   Session::get('cart');
          
            if ($request->isMethod('post')) {
                $rules = [
                    'user_name' => 'required',
                    'gender' => 'required',
                    'email' => 'required|email|regex:/^.+@.+$/i',
                    'phone' => 'required|regex:/^\d{10}$/',
                    'address' => 'required',
                ];
                $messages = [
                    'email.required' => 'The email field is must required',
                    'email.regex' => 'Invalid email format.',
                    'phone.required' => 'The phone field is must required',
                    'phone.regex' => 'Phone number must be 10 digits.',
                    'address.required' => 'The address field is must required'
                ];

                $validateData = Validator::make($request->all(), $rules, $messages);

                if ($validateData->fails()) {
                    return redirect()->back()->withErrors($validateData);
                } else {

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                        $vnp_Returnurl = "http://127.0.0.1:8000/is-checkout-success";
                        $vnp_TmnCode = 'X1WL3I2L';
                        $vnp_HashSecret = "SFBDIRUMYOSNUZGWWYKVLQSKEDOSOXWY";
                        $vnp_TxnRef = rand(00, 9999);

                        $vnp_OrderInfo = "Noi dung thanh toan";
                        $vnp_OrderType = "billpayment";
                       
                        $vnp_Amount = $cart->totalPrice;
                        $vnp_Locale = "vn";
                        $vnp_BankCode = "NCB";
                        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                        $phone = $request->phone;
                        $email = $request->email;
                        $username = $request->user_name;
                        $address = $request->address;
                        $vnp_Bill_Mobile = $phone;
                        $vnp_Bill_Email = $email;
                        $vnp_User_Id = $request->user_id;
                        $fullName = trim($username);
                        if (isset($fullName) && trim($fullName) != '') {
                            $name = explode(' ', $fullName);
                            $vnp_Bill_FirstName = array_shift($name);
                            $vnp_Bill_LastName = array_pop($name);
                        }
                        $vnp_address = trim($address);
                        $dataInfor = ['user_id' => $vnp_User_Id, 'username' => $vnp_Bill_FirstName . $vnp_Bill_LastName, 'phone' => $vnp_Bill_Mobile, 'email' => $vnp_Bill_Email, 'address' => $vnp_address];
                        Session::put('user_info', $dataInfor);
                        $inputData = array(
                            "vnp_Version" => "2.1.0",
                            "vnp_Amount" => $vnp_Amount,
                            "vnp_Command" => "pay",
                            "vnp_CreateDate" => date('YmdHis'),
                            "vnp_CurrCode" => "VND",
                            "vnp_IpAddr" => $vnp_IpAddr,
                            "vnp_Locale" => $vnp_Locale,
                            "vnp_OrderInfo" => $vnp_OrderInfo,
                            "vnp_OrderType" => $vnp_OrderType,
                            "vnp_ReturnUrl" => $vnp_Returnurl,
                            "vnp_TmnCode" => $vnp_TmnCode,
                            "vnp_TxnRef" => $vnp_TxnRef,
                            "vnp_Bill_Mobile" => $vnp_Bill_Mobile, // Thêm thông tin khách hàng vào URL
                            "vnp_Bill_Email" => $vnp_Bill_Email,
                            'vnp_Bill_FirstName' => $vnp_Bill_FirstName,
                            'vnp_Bill_LastName' => 'vnp_Bill_LastName'


                        );

                        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                            $inputData['vnp_BankCode'] = $vnp_BankCode;
                        }


                        //var_dump($inputData);
                        ksort($inputData);
                        $query = "";
                        $i = 0;
                        $hashdata = "";
                        foreach ($inputData as $key => $value) {
                            if ($i == 1) {
                                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                            } else {
                                $hashdata .= urlencode($key) . "=" . urlencode($value);
                                $i = 1;
                            }
                            $query .= urlencode($key) . "=" . urlencode($value) . '&';
                        }

                        $vnp_Url = $vnp_Url . "?" . $query;
                        if (isset($vnp_HashSecret)) {
                            $vnpSecureHash =   hash_hmac('sha512', $hashdata, getenv('VNP_HASHSECRET')); //  
                            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                        }
                        // return response()->json($vnp_Url);
                        $returnData = array(
                            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
                        );
                        if (isset($_POST['redirect'])) {
                            header('Location: ' . $vnp_Url);
                            die();
                        } else {
                            echo json_encode($returnData);
                        }
                    }
                }
            }
        }
    }
}
