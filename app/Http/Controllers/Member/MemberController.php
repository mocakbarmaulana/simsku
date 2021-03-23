<?php

namespace App\Http\Controllers\Member;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class MemberController extends Controller
{
    public function getOrderAll(Request $request){
        $active = 'Order';
        $id = Auth::guard('member')->id();
        $status = null;
        // $q = (is_null($request->q)) ? '1' : $request->q;
        if(!is_null($request->q)){
            $status = ($request->q == 1) ? '1' : '0';
        }

        if($request->q != ''){
            $orders = Order::where('student_id', $id)
                            ->where('status', $status)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);
            $status = ($status == 0) ? '3': '1';

        } else {
            $orders = Order::where('student_id', $id)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);
        }


        return view('member.order', compact('active', 'orders', 'status'));
    }

    public function setOrder(Request $request, $id){
        $user = Student::find(Auth::guard('member')->id());

        $order = new Order();
        $order->invoice = Str::random(5) . '-' . time();
        $order->student_id = Auth::guard('member')->id();
        $order->course_id = $id;
        $order->student_name = $user->name;
        $order->student_address = $user->address;
        $order->subtotal = $request->price;
        $order->status = false;
        $order->save();

        return redirect(route('member.getorder'));
    }

    public function getOrderDetail($id){
        $active = 'Order';
        $order = Order::find($id);

        return view('member.detailorder', compact('active', 'order') );
    }

    public function payment(Request $request){
        $this->validate($request, [
            'name' => 'required|string',
            'number_bank' => 'required|integer',
            'name_bank' => 'required|string',
            'amount' => 'required|integer',
            'date_transfer' => 'required|date',
            'image' => 'required|image|mimes:png,jpg|max:2048',
        ]);

        $imageName = Helper::uploadImage($request->image, null, 'payment');

        $payment = new Payment();
        $payment->order_id = $request->id;
        $payment->name_transfer = $request->name;
        $payment->name_banktransfer = $request->name_bank;
        $payment->number_bank = $request->number_bank;
        $payment->transfer_date = $request->date_transfer;
        $payment->amount = $request->amount;
        $payment->image_transfer = $imageName;
        $payment->status = true;
        $payment->save();

        return redirect()->back()->with('success', 'Silakan tunggu untuk beberapa saat');

    }

    public function getCourseAll(){
        $active = 'Course';
        $id = Auth::guard('member')->id();

        $courses = Order::where('student_id', $id)->where('status', 1)->get();


        return view('member.course', compact('active', 'courses'));
    }

    public function getDetailCourse($id){
        $active = 'Course';
        $course = Order::where('status', 1)
                        ->where('course_id', $id)
                        ->where('student_id', Auth::guard('member')->id())
                        ->first();

        if(is_null($course)){
            return redirect()->back();
        }

        return view('member.detailcourse', compact('active', 'course'));
    }

    public function getAccount(){
        $active = 'Account';
        $account = Student::find(Auth::guard('member')->id());

        return view('member.account', compact('active', 'account'));
    }

    public function setUpdateAccount(Request $request,$id){
        $this->validate($request, [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:students,email,'.$id,
            'phone_number' => 'required|integer',
            'address' => 'required|max:255',
        ]);

        $account = Student::find($id);
        $account->name = $request->name;
        $account->email = $request->email;
        $account->phone_number = $request->phone_number;
        $account->address = $request->address;
        $account->save();

        return redirect()->back()->with('success', 'Account berhasil diupdate');
    }
}