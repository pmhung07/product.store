<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Channel;

class ChannelController extends Controller
{
    public function getCreate(){
    	return view('admin.channel.create');
    }

    public function postCreate(Request $request){
    	$this->validate($request,
            [
				'channel_name' => 'required|unique:channel,name',
	        ],
            [
				'channel_name.required' => 'Vui lòng nhập tên kênh bán hàng!',
				'channel_name.unique' => 'Kênh khách hàng này đã tồn tại trên hệ thống!'
            ]
        );
    	$channel = new Channel();
    	$channel->name = $request->channel_name;
    	$channel->link = $request->channel_link;
    	$channel->save();
    	return redirect()->route('admin.channel.index')->with(['flash_message' => 'Tạo kênh bán hàng thành công!']);
    }
    
    public function getIndex(Request $request){
    	$sort='id';
		$order='desc';
		$rows = new Channel();

		$data=$rows->orderBy($sort,$order)->paginate(20);//->with('category', 'brand')->paginate(10);
		return view('admin.channel.index',['rows' => $data]);//, ['rows' => $data]);
    }

    public function getUpdate($id){

    	$channel = Channel::find($id)->toArray();
        return view('admin.channel.update',compact('channel'));
    }

    public function postUpdate(Request $request,$id){
        $this->validate($request,
            [
				'channel_name' => 'required',
	        ],
            [
				'channel_name.required' => 'Vui lòng nhập tên kênh bán hàng!'
            ]
        );
        $channel = new Channel();
        $channel = Channel::find($id);
    	$channel->name = $request->channel_name;;
    	$channel->link = $request->channel_link;
    	$channel->save();
        return redirect()->route('admin.channel.index')->with(['flash_message' => 'Cập nhật thông tin kênh bán hàng thành công!']);
    }

    public function getDelete($id){
        $data = Channel::find($id);
        $data->delete($id);
        return redirect()->route('admin.channel.index')->with(['flash_message' => 'Xoá kênh bán hàng thành công!']);    
    }
}
