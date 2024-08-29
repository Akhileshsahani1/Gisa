<?php

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use App\Models\SupportChat;
use App\Models\Customer;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\Quotation;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;


class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:administrator');
    }

    public function index(Request $request)
    {
        Support::with('department')->where('seen',0)->update(['seen'=>1]);
        $filter_date_from       = $request->input('filter_date_from');
        $filter_date_to         = $request->input('filter_date_to');
        $filter_status          = $request->input('filter_status');

        $tickets = Support::with('chats');

        if (isset($filter_date_from)) {
            $tickets = $tickets->whereDate('created_at','>=', Carbon::parse($filter_date_from)->format('Y-m-d'));
        }
        if (isset($filter_date_to)) {
            $tickets = $tickets->whereDate('created_at','<=', Carbon::parse($filter_date_to)->format('Y-m-d'));
        }
        if (isset($filter_status)) {
            $tickets = $tickets->where('status',$filter_status);
        }

        $tickets = $tickets->groupBy('role_id', 'subject')->latest()->paginate(20);

        $open_ticket_count = $tickets->where('status','0')->count();
        $closed_ticket_count = $tickets->where('status','1')->count();

        return view('admin.supports.list', compact('tickets','open_ticket_count','closed_ticket_count','filter_date_from','filter_date_to','filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
         $customers = Customer::select("id", \DB::raw("CONCAT(firstname, ' ', lastname) as name"))->get();
         $roles = Role::latest()->get(["id", "name"]);

         return view('admin.supports.create', compact('customers', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject'       => 'required',
            'description'   => 'required',
            'customer_id' => 'required',
            'priority'      => 'required'
        ]);

        $ticket                 = new Support();
        $ticket->customer_id    = $request->customer_id;
        $ticket->subject        = $request->subject;
        $ticket->description    = $request->description;
        $ticket->priority       = $request->priority;
        $ticket->subject        = $request->subject;
        $ticket->role_id     = $request->role_id;
        $ticket->user_id        = Auth::user()->id;

        if ($request->hasfile('attachment')) {
            $attachment         = $request->file('attachment');
            $name               = $attachment->getClientOriginalName();
            $attachment->storeAs('uploads/customers/tickets/'.$request->customer_id, $name, 'public');

            $ticket->attachment        = $name;
        }
        $ticket->save();
        UserActivity::create([
            'user_id' => Auth::user()->id,
            'type'    => 'ticket added',
            'comment' => 'A Support Ticket has been generated for <a href="'.route('admin.grievance.show', $ticket->id).'">Ticket No. '.$ticket->id.'</a>'
        ]);              

        if (isset($request->customer_id) && !empty($request->customer_id)) {
            $customer = Customer::where('id',$request->customer_id)->first();
            
          
            $to =  $customer->email;
            $subject = "testing mail";
            $from = env('MAIL_FROM_ADDRESS');
            $senderName = "Akhileshsahani";
            
            Mail::send('admin.emails.supports', $customer->toArray(), function ($message) use ($to, $subject, $from, $senderName) {
                $message->from($from, $senderName);
                $message->subject($subject);
                $message->to($to);
            });
        }

       return redirect()->route('admin.grievance.index')->with('success', 'Ticket generated successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $ticket = Support::with('chats')->find($id);
        SupportChat::where('support_id', $id)->where('sender', 'customer')->where('seen', 0)->update(['seen' => true]);
        return view('admin.supports.chat', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Support::find($id);
        return view('admin.supports.edit', compact('ticket'));
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
        $customerId = Support::find($id);
        $clientData = Customer::where('id',$customerId->customer_id)->get()->toArray();
        // dd($clientData);
        $ticketIds = $customerId->id;

        $currentDate = Carbon::now();
        $createdAtDate = Carbon::parse($customerId->created_at);
        $daysDifference = $currentDate->diffInDays($createdAtDate);

        if($request->status=='1'){
            $this->validate($request, [
                'closeStatus' => 'required'
            ]);

            if($request->closeStatus=='1'){
                Mail::send('admin.emails.support4', ['issue' => $customerId->subject, 'ticketId' => $customerId->id, 'name' => $clientData[0]['firstname']], function($message) use($request, $clientData, $ticketIds){
                    $message->from('no-reply@junglesafariindia.in', 'GISA');
                    $message->to($clientData[0]['email']);
                    $message->subject('GISA- Support || Ticket Id '. $ticketIds);
                });
            }else{
                Mail::send('admin.emails.support5', ['issue' => $customerId->subject, 'ticketId' => $customerId->id, 'name' => $clientData[0]['firstname'], 'days' => $daysDifference], function($message) use($request, $clientData, $ticketIds){
                    $message->from('no-reply@junglesafariindia.in', 'GISA');
                    $message->to($clientData[0]['email']);
                    $message->subject('GISA- Support || Ticket Id '. $ticketIds);
                });
            }

        }
        $this->validate($request, [
            'status' => 'required'
        ]);

        $ticket                 = Support::find($id);        
        $ticket->status         = $request->status;
        $ticket->save();
        UserActivity::create([
            'user_id' => Auth::user()->id,
            'type'    => 'ticket updated',
            'comment' => 'A Support Ticket has been updated for <a href="'.route('admin.grievance.show', $id).'">Ticket No. '.$id.'</a>'
        ]);

        // This line code for when we not action to acknowledge request #### start here 
        Support::where('id', $id)->where('customer_id', $clientData[0]['id'])->where('take_action',0)->update(['take_action'=>1]);
         // This line code for when we not action to acknowledge request #### end here
        return redirect()->route('admin.grievance.index')->with('success', 'Ticket updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Support::find($id)->delete();
        UserActivity::create([
            'user_id' => Auth::user()->id,
            'type'    => 'ticket updated',
            'comment' => 'A Support Ticket has been deleted.'
        ]);
        return redirect()->route('admin.grievance.index')->with('success', 'Ticket deleted successfully !');
    }

    public function sendMessage(Request $request, $id){

        $customerId = Support::where('id', $id)->first()->customer_id;

        $this->validate($request, [
            'message' => 'required',
        ]);
        SupportChat::create([
            'customer_id' => $customerId,
            'support_id' => $id,
            'sender' => 'admin',
            'message' => $request->message,
        ]);

        // This line code for when we not action to acknowledge request #### start here 
        Support::where('id', $id)->where('customer_id', $customerId)->where('take_action',0)->update(['take_action'=>1]);
        // This line code for when we not action to acknowledge request #### end here
        return redirect()->route('admin.grievance.show', $id)->with('success', 'Message sent successfully !');
    }
}
