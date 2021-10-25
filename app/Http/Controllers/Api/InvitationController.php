<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use App\Models\Invitation; 
use App\Models\ImagesWedding; 
use App\Models\InvitationDetails; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class InvitationController extends Controller
{
    //
    public $successStatus = 200;

    public function create_invitation(Request $request)
    {  
        // dd($request->all());
        try{
            $validator = Validator::make($request->all(), [
                'cd_invitation' => 'required|max:25',
                'valid_from' => 'required',
                'valid_to' => 'required',
                'nama_mempelai_pria' => 'required',
                'nama_mempelai_wanita' => 'required',
                'nama_ibu_mempelai_pria' => 'required',
                'nama_ibu_mempelai_wanita' => 'required',
                'nama_ayah_mempelai_wanita' => 'required',
                'nama_ayah_mempelai_pria' => 'required',
                'instagram_account_pria' => 'required',
                'instagram_account_wanita' => 'required',
                'tgl_resepsi' => 'required',
                'no_telp_client' => 'required',
                'created_by' =>'required',
            ]);
            if ($validator->fails()) {
                // return response gagal
                $response = [
                    'status' => false,
                    'code' => 400 ,
                    'message' => $validator->errors()->first(),
                ];
                return response()->json($response, 200);
            }
            // dd($request->all());
            $check_code_invitation = Invitation::where('cd_invitation',$request['cd_invitation'])->first();
            // dd($check_code_invitation);
            if($check_code_invitation != null){
                // dd($check_promo['valid_to']);
                $response = [
                    'status' => false,
                    'code' => 400 ,
                    'message' => 'domain sudah ada',
                ];
                return response()->json($response, 200);
            }

            $create_invitation= Invitation::create_invitation($request->all());
                if($create_invitation){
                    $data[] = $request->all();
                    $data = $data[0];
                    $data['id_invitation'] = $create_invitation['id'];
                    $create_detail_invitation = InvitationDetails::create_detail_invitation($data);
                    if($create_detail_invitation){
                        $dataInvitation = ['invitation' => $create_invitation,
                                            'detail' => $create_detail_invitation];
                        $response = [
                            'status' => true,
                            'message' =>'success save data',
                            'code' => 200,
                            'data' => $dataInvitation, 
                            ];
                        return response()->json($response, 200);
                    }
                }
                $response = [
                            'status' => false,
                            'message' =>'failed_save_data',
                            'code' => 400,
                            'data' => null, 
                            ];
                return response()->json($response, 200);
        }
        catch (Throwable $e) {
            report($e);
            $response = [
                'status' => false,
                'message' => __('message.internal_erorr'),
                'code' => 500,
                'data' => null, 
            ];
            return response()->json($response, 500);
        }
    }

    public function get_invitation_by_code(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'cd_invitation' => 'required|max:25',
            ]);
            if ($validator->fails()) {
                // return response gagal
                $response = [
                    'status' => false,
                    'code' => 400 ,
                    'message' => $validator->errors()->first(),
                ];
                return response()->json($response, 200);
            }

            $get_data_invite_master = Invitation::where('cd_invitation',$request['cd_invitation'])
                                                ->first();
            if($get_data_invite_master != null){
                $get_data_detail = InvitationDetails::where('id_invitation',$get_data_invite_master['id'])
                                                    ->first();
                if($get_data_detail != null){
                    $dataInvitation = ['invitation' => $get_data_invite_master,
                                        'detail' => $get_data_detail];
                    $response = [
                        'status' => true,
                        'message' =>'data found',
                        'code' => 200,
                        'data' => $dataInvitation, 
                        ];
                    return response()->json($response, 200);
                }
            }
            $response = [
                'status' => false,
                'message' =>'Data not Found',
                'code' => 400,
                'data' => null, 
                ];
            return response()->json($response, 200);

        }catch (Throwable $e) {
            report($e);
            $response = [
                'status' => false,
                'message' => __('message.internal_erorr'),
                'code' => 500,
                'data' => null, 
            ];
            return response()->json($response, 500);
        }

    }

    public function get_invitation_all(Request $request)
    {
        try{
            
            $data = Invitation::latest()->get();
                if(!empty($data) && count($data) != 0){
                        $response = [
                            'status' => true,
                            'message' =>'data found',
                            'code' => 200,
                            'data' => $data, 
                            ];
                        return response()->json($response, 200);
                    }
            
            $response = [
                'status' => false,
                'message' =>'Data not Found',
                'code' => 400,
                'data' => null, 
                ];
            return response()->json($response, 200);

        }catch (Throwable $e) {
            report($e);
            $response = [
                'status' => false,
                'message' => __('message.internal_erorr'),
                'code' => 500,
                'data' => null, 
            ];
            return response()->json($response, 500);
        }

    }

    public function add_galery(Request $request)
    {
        // dd($request->all());
        try{
            $validator = Validator::make($request->all(), [
                'images' => 'image:jpeg,png,jpg,gif,svg|max:2560',
                'id_invitation' => 'required',
            ]);
            if($validator->fails()) {
                // return response gagal
                $response = [
                    'status' => false,
                    'code' => 400,
                    'message' => $validator->errors()->first(), 
                    'data' =>null,
                ];
                return response()->json($response, 200);
            }
            $check_id = Invitation::where('id',$request['id_invitation'])
                                                ->first();
            if($check_id != null){
                $images = $request->file('images');
                // dd($images);
                $fileName = time().'.'.$images->extension();  
                $loc = public_path('images_wedding');
                $loct = $images->move($loc, $fileName);
                $data = [
                    'id_invitation' => $request['id_invitation'],
                    'images' =>'images_wedding/'.$fileName
                ];
                
                $save = ImagesWedding::add_images($data);
                if($save){
                    $response = [
                        'status' => true,
                        'message' =>'data found',
                        'code' => 200,
                        'data' => $data, 
                        ];
                    return response()->json($response, 200);
                }
                $response = [
                    'status' => false,
                    'message' =>'Data not Found',
                    'code' => 400,
                    'data' => null, 
                    ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'status' => false,
                    'message' =>'Failed to save',
                    'code' => 400,
                    'data' => null, 
                    ];
                return response()->json($response, 200);
            }            

        }catch (Throwable $e) {
            report($e);
            $response = [
                'status' => false,
                'message' => __('message.internal_erorr'),
                'code' => 500,
                'data' => null, 
            ];
            return response()->json($response, 500);
        }

    }

    public function delete_image(Request $request)
    {
        // dd($request->all());
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);
            if($validator->fails()) {
                // return response gagal
                $response = [
                    'status' => false,
                    'code' => 400,
                    'message' => $validator->errors()->first(), 
                    'data' =>null,
                ];
                return response()->json($response, 200);
            }
            $deleted = ImagesWedding::where('id', $request->id)->delete();
                if($deleted){
                    $response = [
                        'status' => true,
                        'message' =>'delete Success',
                        'code' => 200,
                        ];
                    return response()->json($response, 200);
                }
                $response = [
                    'status' => false,
                    'message' =>'failed delete',
                    'code' => 400,
                    ];
                return response()->json($response, 200);
            
        }catch (Throwable $e) {
            report($e);
            $response = [
                'status' => false,
                'message' => __('message.internal_erorr'),
                'code' => 500,
                'data' => null, 
            ];
            return response()->json($response, 500);
        }

    }
    
}
