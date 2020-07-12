<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Visitor;

class ApiController extends Controller
{
    //

    public function VisitorLogIn(Request $request)
    {

        //Validate Inputs
        $validate = Validator::make(request()->all(), [
            'VisMailI'=>"required",
            'VisPassI'=>'required'
        ]);
        if ($validate->fails()) {
            return response()->json(['err',['err'=>'1','message'=>'ValidationErr']],400);
        }

        //Authenticate By Mail
        if (!$token = Auth::guard('api')->attempt(array('email'=>$request->input('VisMailI'),'password'=>$request->input('VisPassI')))) 
        {
                 
            return response()->json(['err',['err'=>'0','message' => 'UnauthorizedErr']], 401);

        }
        else{

            //get Visitor 
            $getVisitor=Auth::guard('api')->user();
            return response()->json(['Visitor'=>$getVisitor,'token' => $token,'expires' => auth('api')->factory()->getTTL() * 60,]);
            
        }   

    }



    public function VisitorRegister(Request $request)
    {
        
        
        //Validate inputs 
        $validate = Validator::make(request()->all(), [
            'VisNameI'=>"required",
            'VisLastNameI'=>'required',
            'VisMailI'=>'required',
            'VisUserNameI'=>'required',
            'VisPassI'=>'required',
            'VisPass2I'=>'required',
            'VisPhoneI'=>'required',
            'VisCityI'=>'required',
            'VisAddressI'=>'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['err',['err'=>'1','message'=>'ValidationErr']],400);
        }

        //Check If Visitor  Username Available
        $CheckVisUser=Visitor::where('vis_username',$request->input('VisUserNameI'))->count();
        if($CheckVisUser > 0){
    
            return 'UserName Is already In Use';
        }

        //Check If Visitor Email Available
        $CheckVisMail=Visitor::where('email',$request->input('VisMailI'))->count();
        if($CheckVisMail > 0){
    
            return 'Email Is already In Use';
        }

        //Check If Password Match
        if(! $request->input('VisPassI') == $request->input('VisPass2I') ){

            return 'Password Not Match';
        }

        //generate RestPass And Activation Token
        $RestPassToken= md5(rand(1, 10) . microtime());
        $ActivationToken=md5(rand(1, 12) . microtime());

        //Save Visitor 
        $SaveVis=new Visitor([
            'vis_name'=>$request->input('VisNameI'),
            'vis_last_name'=>$request->input('VisLastNameI'),
            'email'=>$request->input('VisMailI'),
            'vis_username'=>$request->input('VisUserNameI'),
            'vis_password'=>bcrypt($request->input('VisPassI')),
            'vis_Status'=>0,
            'vis_phone'=>$request->input('VisPhoneI'),
            'vis_city'=>$request->input('VisCityI'),
            'vis_address'=>$request->input('VisAddressI'),
            'vis_restpass_token'=>$RestPassToken,
            'vis_activation_token'=>$ActivationToken,
            'role'=>0,
        ]);
        $SaveVis->save();
        
        return 'Saved';

    }



    public function VisitorInfo()
    {
        
       //get Visitor
       $Visitor=Auth::guard('api')->user();

       return response()->json(['Visitor'=>$Visitor], 200);

    }

    public function VisitorUpdate(Request $request)
    {

        //Validate inputs 
        $validate = Validator::make(request()->all(), [
            'VisNameI'=>"required",
            'VisLastNameI'=>'required',
            'VisMailI'=>'required',
            'VisUserNameI'=>'required',
            'VisPhoneI'=>'required',
            'VisCityI'=>'required',
            'VisAddressI'=>'required',
        ]);
        if ($validate->fails()) {
            return response()->json(['err',['err'=>'1','message'=>'ValidationErr']],400);
        }

        
        //get Visitor Info 
        $Visitor=Auth::guard('api')->user();
        $VisitorId=$Visitor['id'];

        //Find Visitor On DB
        $getVisitor=Visitor::find($VisitorId);
        if(empty($getVisitor)){
            
           return 'Somthing Wrong';
        }

        //Update Visitor
        $UpdateVisitor=$getVisitor->update([
            'vis_name'=>$request->input('VisNameI'),
            'vis_last_name'=>$request->input('VisLastNameI'),
            'email'=>$request->input('VisMailI'),
            'vis_username'=>$request->input('VisUserNameI'),
            'vis_phone'=>$request->input('VisPhoneI'),
            'vis_city'=>$request->input('VisCityI'),
            'vis_address'=>$request->input('VisAddressI')
        ]);
        
        return 'Updated';

    }

    public function VisitorLogOut()
    {
        
        //Destroy Token
        Auth::guard('api')->logout();

        return response(200);

    }



}
